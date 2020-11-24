<?php
namespace App\Domain\User\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;
use Illuminate\Support\Facades\Hash;

class RegisterUserDTO extends DataTransferObject
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
    public $password;

    /**
     * @param $request
     * @return RegisterUserDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        return new self([
            'name' => 'user',
            'email' => request()->ip() . '@rawabey-alqasim.com',
            'password' => Hash::make('secret')
        ]);
    }

    /**
     * @param array $params
     * @return RegisterUserDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password']
        ]);

    }
}
