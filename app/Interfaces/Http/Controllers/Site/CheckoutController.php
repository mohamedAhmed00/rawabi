<?php
namespace App\Interfaces\Http\Controllers\Site;

use App\Application\Requests\Site\CheckoutRequest;
use App\Domain\Cart\Services\Abstraction\IServiceCart;
use App\Domain\Order\DTOs\CheckoutDTO;
use App\Domain\Order\Services\Abstraction\IServiceOrder;
use App\Interfaces\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * @author Mohamed Ahmed
     * @var IServiceOrder
     */
    private $_orderService;

    /**
     * @author Mohamed Ahmed
     * @var IServiceCart
     */
    private $_cartService;

    /**
     * CheckoutController constructor.
     * @author Mohamed Ahmed
     * @param IServiceOrder $_orderService
     * @param IServiceCart $_cartService
     */
    public function __construct(IServiceOrder $_orderService,IServiceCart $_cartService)
    {
        $this->_orderService = $_orderService;
        $this->_cartService = $_cartService;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return $this->_orderService->index();
    }

    /**
     * @param CheckoutRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(CheckoutRequest $request)
    {
        $request->request->set('total',$this->_cartService->cartTotal());
        $request->request->set('tax',$this->_cartService->cartTax());
        $products = $this->_cartService->cartContent();
        if(sizeof($products) < 1){
            return ['status' => 'error','title' => 'لا يوجد منتجات لاكمال عمليه الدفع !'];
        }
        $checkout = $this->_orderService->checkout(CheckoutDTO::fromRequest($request),$products);
        $this->_cartService->cartDestroy();
        return ['status' => 'success','title' => 'تم بنجاح اتمام العمليه ورقمها :  '.$checkout->id ,'url' => route('site.index')];
    }
}
