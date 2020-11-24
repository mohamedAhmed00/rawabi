<?php
namespace App\Domain\Order\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;


class OrderHistoryDTO extends DataTransferObject
{

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $comment;

    /**
     * @param $request
     * @return OrderHistoryDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        return new self([
            'status' => $request->get('status'),
            'comment' => $request->get('comment')
        ]);
    }

    /**
     * @param array $params
     * @return OrderHistoryDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'status' => $params['status'],
            'comment' => $params['comment']
        ]);
    }
}
