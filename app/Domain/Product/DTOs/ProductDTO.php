<?php
namespace App\Domain\Product\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;
use Illuminate\Support\Str;

class ProductDTO extends DataTransferObject
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $cutting;

    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $active;

    /**
     * @var integer
     */
    public $order;

    /**
     * @param $request
     * @return ProductDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        $image = uploadFile('uploads/products',$request->file('image'));
        $response = [
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'cutting' => implode(',', $request->get('cutting')),
            'active' => $request->get('active'),
            'order' => $request->get('order')
        ];
        if ($image){
            $response['image'] = $image;
        }
        return $response;
    }

    /**
     * @param array $params
     * @return ProductDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'name' => $params['name'],
            'slug' => $params['slug'],
            'cutting' => $params['cutting'],
            'image' => $params['image'],
            'active' => $params['active'],
            'order' => $params['order']
        ]);

    }
}
