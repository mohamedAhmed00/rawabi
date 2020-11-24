<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Domain\Order\Repositories\Abstraction\IRepositoryCheckout;
use App\Domain\Product\Repositories\Abstraction\IRepositoryProduct;
use App\Domain\User\Repositories\Abstraction\IRepositoryMessage;
use App\Interfaces\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * @var IRepositoryCheckout
     */
    private $_checkoutRepository;

    /**
     * @var IRepositoryProduct
     */
    private $_productRepository;

    /**
     * @var IRepositoryMessage
     */
    private $_messageRepository;

    /**
     * DashboardController constructor.
     * @param IRepositoryCheckout $_checkoutRepository
     * @param IRepositoryProduct $_productRepository
     * @param IRepositoryMessage $_messageRepository
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositoryMessage $_messageRepository,IRepositoryProduct $_productRepository,IRepositoryCheckout $_checkoutRepository)
    {
        $this->_messageRepository =  $_messageRepository;
        $this->_productRepository = $_productRepository;
        $this->_checkoutRepository = $_checkoutRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $messageCount = $this->_messageRepository->count();
        $productCount = $this->_productRepository->count();
        $checkoutCount = $this->_checkoutRepository->count();
        return view('admin.pages.index',compact(['messageCount','productCount','checkoutCount']));
    }
}
