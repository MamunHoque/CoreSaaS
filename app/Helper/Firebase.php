<?php

namespace App\Helper;

use GuzzleHttp\Client;

class Firebase
{

    public static function sendToUser($to, $message, $headline = null)
    {
        if(! empty($to)) {
            $data = [
                "to" => $to,
                "notification" => [
                    "type" => 'generic',
                    "title" => empty($headline)?$message:$headline,
                    "body" => $message,

                ],
                'data' =>
                    [
                        "request_id" => 0,
                        "type" => 'generic',
                        "title" => empty($headline)?$message:$headline,
                        "body" => $message,
                    ]
            ];
            try {
                return self::sendPushNotification($data);
            } catch (\Exception $ex) {}
        }
    }

    /**
     * POST request to firebase servers
     *
     * @param $fields
     *
     * @return mixed
     */
    private static function sendPushNotification($fields)
    {

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $client = new Client();

        $result = $client->post($url, [
            'json' =>
                $fields
            ,
            'headers' => [
                'Authorization' => 'key=AAAABXei07E:APA91bG5Gi_uu0XHU6rP3o6CFK8d8Iftf3NEsgCGM0yoxSFCYM5F-vDq_PfvdC-zuQvyEKKQjs-yoD7Q848KDo9fDNA7Eha8pgrEr2Kw-3L3ZX9K-aOzmXdm_owtaxCZOzuQjaOpcOZe',
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($result->getBody(), true);
    }
}
