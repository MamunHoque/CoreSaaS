<?php

namespace App\Helper;

use App\Models\Driver;


class Push
{

    public function routeApproved(Driver $driver)
    {
        if(!empty($driver) && isset($driver->user->device_token)){
            Firebase::sendToUser($driver->user->device_token, 'Your New Route Approved', 'New works');
        }

        return true;
    }

}
