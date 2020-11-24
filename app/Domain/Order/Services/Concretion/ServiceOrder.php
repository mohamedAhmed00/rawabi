<?php
namespace App\Domain\Order\Services\Concretion;

use App\Domain\Cart\Services\Abstraction\IServiceCart;
use App\Domain\City\Repositories\Abstraction\IRepositoryCity;
use App\Domain\Order\Mail\CheckoutMail;
use App\Domain\Order\Repositories\Abstraction\IRepositoryCheckout;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrder;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrderHistory;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrderStatus;
use App\Domain\Order\Services\Abstraction\IServiceOrder;
use App\Domain\Setting\Repositories\Abstraction\IRepositorySetting;
use App\Infrastructure\Services\Concretion\ServiceAbstract;
use Illuminate\Support\Facades\Mail;

final class ServiceOrder extends ServiceAbstract implements IServiceOrder
{
    /**
     * @author Mohamed Ahmed
     * @var IRepositoryCity
     */
    private $_cityRepository;

    /**
     * @author Mohamed Ahmed
     * @var IRepositoryCheckout
     */
    private $_checkoutRepository;

    /**
     * @author Mohamed Ahmed
     * @var IRepositoryOrder
     */
    private $_orderRepository;

    /**
     * @author Mohamed Ahmed
     * @var IServiceCart
     */
    private $_cartService;

    /**
     * @author Mohamed Ahmed
     * @var IRepositoryOrderHistory
     */
    private $_orderHistoryRepository;

    /**
     * @author Mohamed Ahmed
     * @var IRepositoryOrderStatus
     */
    private $_orderStatusRepository;

    /**
     * ServiceOrder constructor.
     * @param IRepositoryOrder $_orderRepository
     * @param IRepositoryOrderHistory $_orderHistoryRepository
     * @param IRepositoryOrderStatus $_orderStatusRepository
     * @param IRepositoryCity $_cityRepository
     * @param IRepositoryCheckout $_checkoutRepository
     * @param IServiceCart $_cartService
     */
    public function __construct(IRepositoryCity $_cityRepository,IRepositoryOrderHistory $_orderHistoryRepository,IRepositoryOrderStatus $_orderStatusRepository,IRepositoryOrder $_orderRepository,IRepositoryCheckout $_checkoutRepository,IServiceCart $_cartService)
    {
        $this->_cityRepository = $_cityRepository;
        $this->_orderRepository = $_orderRepository;
        $this->_orderHistoryRepository = $_orderHistoryRepository;
        $this->_orderStatusRepository = $_orderStatusRepository;
        $this->_checkoutRepository = $_checkoutRepository;
        $this->_cartService = $_cartService;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $products = $this->_cartService->cartContent();
        $cities = $this->_cityRepository->all();
        return view('site.pages.checkout.index' ,compact(['products' ,'cities']));
    }

    /**
     * @param $request
     * @param $products
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function checkout($request,$products){
        $checkout = $this->_checkoutRepository->create((array)$request);
        foreach ($products as $product) {
            $this->_orderRepository->create([
                'name' => $product->name, 'qty' => $product->qty, 'price' => $product->price, 'kind' => $product->options['kind'],
                'type' => $product->options['type'], 'cutting' => $product->options['cutting'], 'packing' => $product->options['packing'],
                'minced' => $product->options['minced'], 'weight' => $product->weight, 'head' => $product->options['head'],
                'comments' => $product->options['comments'], 'total' => ($product->qty * $product->price), 'checkout_id' => $checkout->id,
            ]);
        }
        $request->id = $checkout->id;
        $this->sendEmail($request,$products);

        $status = $this->_orderStatusRepository->getFirstBy(['id' => getSiteSettings()['order_status']]);
        if (empty($status)){
            $status = $this->_orderStatusRepository->getFirstBy();
        }
        $this->_orderHistoryRepository->create(['checkout_id' => $checkout->id,'status' => $status->name]);
        return $checkout;
    }

    /**
     * @param $request
     * @param $products
     * @author Mohamed Ahmed
     */
    public function sendEmail($request,$products){
        Mail::to(env('MESSAGE_SEND_TO'))->send(new CheckoutMail($request,$products,getSiteSettings()));
        if (!empty($request->email)){
            Mail::to($request->email)->send(new CheckoutMail($request,$products,getSiteSettings()));
        }
    }
}
