<?php
namespace App\Interfaces\Http\Controllers\Api;

use App\Application\Requests\Site\CheckoutRequest;
use App\Domain\Cart\Repositories\Abstraction\IRepositoryCart;
use App\Domain\Order\DTOs\CheckoutDTO;
use App\Domain\Order\Services\Abstraction\IServiceOrder;
use Illuminate\Http\Request;
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
     * @var IRepositoryCart
     */
    private $_cartRepository;

    /**
     * @author Mohamed Ahmed
     * @var $_userId
     */
    private $_userId;

    /**
     * CheckoutController constructor.
     * @author Mohamed Ahmed
     * @param IServiceOrder $_orderService
     * @param IRepositoryCart $_cartRepository
     * @param IServiceOrder $_orderService
     */
    public function __construct(IServiceOrder $_orderService,IRepositoryCart $_cartRepository)
    {
        $this->_orderService = $_orderService;
        $this->_cartRepository = $_cartRepository;
        $this->_userId = auth('sanctum')->user()->id;
    }

    /**
     * @param Request $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(CheckoutRequest $request)
    {
        $cart =  $this->_cartRepository->getCartInfoByUserId($this->_userId);
        $total = getTotalCart($cart);
        $tax = $total * ((int)getSiteSettings()['tax'] / 100);
        $request->request->set('total',$total + $tax);
        $request->request->set('tax',$tax);
        $products = productsCartParserApi($this->_cartRepository->getCartInfoByUserId($this->_userId));
        if(sizeof($products) < 1){
            return ['status' => 'error','title' => 'لا يوجد منتجات لاكمال عمليه الدفع !'];
        }
        $checkout = $this->_orderService->checkout(CheckoutDTO::fromRequest($request),$products);
        $this->_cartRepository->deleteBy(['user_id' => $this->_userId]);
        return response()->json(['data' => 'تم بنجاح اتمام العمليه ورقمها :  '.$checkout->id]);
    }
}
