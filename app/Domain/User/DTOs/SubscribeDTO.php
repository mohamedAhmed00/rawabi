<?php
namespace App\Domain\User\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class SubscribeDTO extends DataTransferObject
{

    /**
     * @var string
     */
    public $email;

    /**
     * @param $request
     * @return SubscribeDTO
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
     * @return SubscribeDTO
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
