<?php
namespace App\Domain\City\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class CityDTO extends DataTransferObject
{

    /**
     * @var string
     */
    public $name;

    /**
     * @param $request
     * @return CityDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        return new self([
            'name' => $request->get('name')
        ]);
    }

    /**
     * @param array $params
     * @return CityDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'name' => $params['name']
        ]);

    }
}
