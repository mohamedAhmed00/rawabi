<?php
namespace App\Domain\Order\Services\Abstraction;

interface IServiceOrder
{
    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index();

    /**
     * @param $request
     * @param $products
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function checkout($request,$products);
}
