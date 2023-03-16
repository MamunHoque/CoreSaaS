<?php

namespace App\Helper\Traits;

/**
 * Common DataSet Traits
 */
trait CommonHandler
{
	/**
	 * Default week days
	 *
	 * @var array
	 */
	protected static $weekDays = [
		'monday' => 'Monday',
		'tuesday' => 'Tuesday',
		'wednesday' => 'Wednesday',
		'thursday' => 'Thursday',
		'friday' => 'Friday',
		'saturday' => 'Saturday',
		'sunday' => 'Sunday'
	];

	/**
	 * Default permissions dataSet
	 *
	 * @var array
	 */
	protected static $status = [
		'active' => 'Active',
		'inactive' => 'Inactive'
	];

    /**
     * Default permissions dataSet
     *
     * @var array
     */
    protected static $routeStatus = [
        'pending' => 'Afwachting',
        'declined' => 'Afgewezen',
        'approved' => 'Goedgekeurd',
        'completed' => 'Voltooid'
    ];

    /**
     * Default permissions dataSet
     *
     * @var array
     */
    protected static $routeStatusDe = [
        'pending' => 'Afwachting',
        'declined' => 'Afgewezen',
        'approved' => 'Goedgekeurd',
        'completed' => 'Voltooid'
    ];

    /**
     * Default permissions dataSet
     *
     * @var array
     */
    protected static $orderStatus = [
        'pending' => 'Afwachting',
        'accepted' => 'Geaccepteerd',
        'declined' => 'Afgewezen',
        'approved' => 'Goedgekeurd',
        'on_the_way' => 'Begonnen',
        'picked' => 'Opgehaald',
        'delivered' => 'Bezorgd',
        'completed' => 'Voltooid'
    ];

    /**
     * Default permissions dataSet
     *
     * @var array
     */
    protected static $orderStatusDe = [
        'pending' => 'Afwachting',
        'accepted' => 'Geaccepteerd',
        'declined' => 'Afgewezen',
        'approved' => 'Goedgekeurd',
        'on_the_way' => 'Begonnen',
        'picked' => 'Opgehaald',
        'delivered' => 'Bezorgd',
        'completed' => 'Voltooid'
    ];

	/**
	 * Service type dataSet
	 *
	 * @var array
	 */
	protected static $serviceType = [
		'pickup' => 'Pickup',
		'delivery' => 'Delivery'
	];

	/**
	 * Service type dataSet
	 *
	 * @var array
	 */
	protected static $deliveryType = [
		'normal' => 'Normal',
		'speed' => 'Speed'
	];

	/**
	 * Service type dataSet
	 *
	 * @var array
	 */
	protected static $deliveryTypeDe = [
		'normal' => 'Normaal',
		'speed' => 'Spoed'
	];

	/**
	 * Service type dataSet
	 *
	 * @var array
	 */
	protected static $requiredCheck = [
		'signature' => 'Handtekening',
		'delivery_photo' => 'Factuur',
		'receipt_photo' => 'Foto'
	];

	/**
	 * Service type dataSet
	 *
	 * @var array
	 */
	protected static $itemType = [
		'pallet' => 'Pallet',
		'packet' => 'Packet'
	];

	/**
	 * Flag List
	 *
	 * @var array
	 */
	protected static $flag = [
		"", "Yellow", "Red"
	];

	/**
	 * Flag List
	 *
	 * @var array
	 */
	protected static $flagColor = [
		"", "text-warning", "text-danger"
	];

	public static $avatar = "avatar.jpg";

	public static $logo = "logo.png";

	public static $photo = "photo.png";
}
