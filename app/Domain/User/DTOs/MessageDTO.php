<?php
namespace App\Domain\User\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class MessageDTO extends DataTransferObject
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var integer
     */
    public $message;

    /**
     * @param $request
     * @return MessageDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        return new self([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'message' => $request->get('message'),
            'email' => $request->get('email')
        ]);
    }

    /**
     * @param array $params
     * @return MessageDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'name' => $params['name'],
            'phone' => $params['phone'],
            'message' => $params['message'],
            'email' => $params['email']
        ]);
    }
}
