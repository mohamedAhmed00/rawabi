<?php
namespace App\Domain\Order\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;


class OrderStatusDTO extends DataTransferObject
{

    /**
     * @var string
     */
    public $name;

    /**
     * @param $request
     * @return OrderStatusDTO
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
     * @return OrderStatusDTO
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
