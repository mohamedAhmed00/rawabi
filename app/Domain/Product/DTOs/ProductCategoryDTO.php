<?php
namespace App\Domain\Product\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class ProductCategoryDTO extends DataTransferObject
{
    /**
     * @var integer
     */
    public $product_id;
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $price;

    /**
     * @param $request
     * @return ProductCategoryDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        return new self([
            'name' => $request->get('name'),
            'product_id' => $request->get('product_id'),
            'price' => $request->get('price')
        ]);
    }

    /**
     * @param array $params
     * @return ProductCategoryDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'name' => $params['name'],
            'product_id' => $params['product_id'],
            'price' => $params['price']
        ]);

    }
}
