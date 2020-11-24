<?php
namespace App\Domain\Order\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class CheckoutDTO extends DataTransferObject
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $receive;

    /**
     * @var string
     */
    public $payment;

    /**
     * @var string
     */
    public $price;

    /**
     * @var float
     */
    public $tax;

    /**
     * @var string
     */
    public $location;

    /**
     * @param $request
     * @return CheckoutDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        return new self([
            'name' => $request->get('name'),
            'city' => $request->get('city'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'receive' => $request->get('receive'),
            'payment' => $request->get('payment'),
            'location' => $request->get('location'),
            'price' => $request->get('total'),
            'tax' => $request->get('tax')
        ]);
    }

    /**
     * @param array $params
     * @return CheckoutDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'name' => $params['name'],
            'city' => $params['city'],
            'phone' => $params['phone'],
            'address' => $params['address'],
            'receive' => $params['receive'],
            'payment' => $params['payment'],
            'location' => $params['location'],
            'price' => $params['total']
        ]);

    }
}
