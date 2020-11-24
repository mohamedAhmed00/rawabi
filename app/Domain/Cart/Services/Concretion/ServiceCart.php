<?php
namespace App\Domain\Cart\Services\Concretion;

use App\Domain\Cart\Services\Abstraction\IServiceCart;
use App\Infrastructure\Services\Concretion\ServiceAbstract;
use Gloudemans\Shoppingcart\Facades\Cart;

final class ServiceCart extends ServiceAbstract implements IServiceCart
{
    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View|mixed
     */
    public function index(){
        $products = Cart::content();
        return view('site.pages.cart.index' ,compact(['products']));
    }

    /**
     * @param $request
     * @param $product
     * @author Mohamed Ahmed
     * @return array|mixed|string[]
     * @throws \Throwable
     */
    public function addToCart($request ,$product){
        if(!$request->type){
            return ['status' => 'error' ,'data' => 'يجب ان تقوم باختيار نوع الذبح'];
        }
        Cart::add([
            'id' => $product->id,
            'name' => $product->name ,
            'qty' => $request->qty ?  : 1,
            'price' => $request->price ? : $product->categories()->get(['price'])->min('price'),
            'weight' => $request->weight ? : 0,
            'options' => [
                'image' => $product->image,
                'kind' => $request->kind ? : 'غير معروف',
                'type' => $request->type ? : 'غير معروف',
                'cutting' => $request->cutting ? : 'غير معروف',
                'slug' => $product->slug,
                'packing' => $request->packing ? : 'غير معروف',
                'head' => $request->head ? : 'غير معروف',
                'comments' => $request->comments ? : 'غير معروف',
                'minced' => $request->minced
            ]
        ]);
        return ['status' => 'success' ,'data' => 'تم اضافه المنتج لعربه الشراء بنجاح' ,'html' => view('site.layouts.cart')->render()];
    }

    /**
     * @param $request
     * @param $rowId
     * @author Mohamed Ahmed
     * @return array|mixed
     */
    public function updateToCart($request , $rowId){
        Cart::update($rowId , $request->qty);
        $item = Cart::get($rowId);
        return ['status' => 'success' , 'subTotal' => Cart::subtotal() ,'rowTotal' =>  $item->qty * $item->price ,'tax' => Cart::tax() ,'totalPrice' => Cart::total()];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function remove($id){
        Cart::remove($id);
        return redirect()->back();
    }

    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function cartContent(){
        return \Gloudemans\Shoppingcart\Facades\Cart::content();
    }

    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function cartTotal(){
        return \Gloudemans\Shoppingcart\Facades\Cart::subtotal();
    }

    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function cartTax(){
        return \Gloudemans\Shoppingcart\Facades\Cart::tax();
    }

    /**
     * @author Mohamed Ahmed
     * @return void
     */
    public function cartDestroy(){
        Cart::destroy();
    }
}
