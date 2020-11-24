<?php
namespace App\Domain\Cart\Services\Abstraction;

interface IServiceCart
{
    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function index();

    /**
     * @param $request
     * @param $product
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function addToCart($request ,$product);

    /**
     * @param $request
     * @param $rowId
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function updateToCart($request , $rowId);

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function remove($id);

    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function cartContent();

    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function cartTax();

    /**
     * @author Mohamed Ahmed
     * @return void
     */
    public function cartDestroy();

    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function cartTotal();
}
