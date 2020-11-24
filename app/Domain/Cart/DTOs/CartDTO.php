<?php
namespace App\Domain\Cart\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;
use Illuminate\Support\Facades\Storage;

class CartDTO extends DataTransferObject
{

    /**
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $content;

    /**
     * @param $request
     * @return CartDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        $cartData = $key = array(
            'id' => $request->get('product')->id,
            'name' => $request->get('product')->name ,
            'qty' => $request->qty ?  : 1,
            'price' => $request->price ? : $request->get('product')->categories()->get(['price'])->min('price'),
            'weight' => $request->weight ? : 0,
            'options' => [
                'image' => Storage::url($request->get('product')->image),
                'kind' => $request->kind ? : 'غير معروف',
                'type' => $request->type ? : 'غير معروف',
                'cutting' => $request->cutting ? : 'غير معروف',
                'slug' => $request->get('product')->slug,
                'packing' => $request->packing ? : 'غير معروف',
                'head' => $request->head ? : 'غير معروف',
                'comments' => $request->comments ? : 'غير معروف',
                'minced' => $request->minced
            ]
        );
        unset($key['qty']);
        return new self([
            'key' => md5(json_encode($key)),
            'content' => json_encode($cartData)
        ]);
    }

    /**
     * @param array $params
     * @return CartDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'key' => ''
        ]);

    }
}
