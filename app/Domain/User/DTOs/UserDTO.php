<?php
namespace App\Domain\User\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class UserDTO extends DataTransferObject
{
    /**
     * @var string
     */
    public $email;

    /**
     * @param $request
     * @return MessageDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        return new self([
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
            'email' => $params['email']
        ]);

    }
}
