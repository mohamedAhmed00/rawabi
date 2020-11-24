<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\OrderHistoryRequest;
use App\Domain\Order\DTOs\OrderHistoryDTO;
use App\Domain\Order\Repositories\Abstraction\IRepositoryCheckout;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrderHistory;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrderStatus;
use App\Interfaces\Http\Controllers\Controller;

class CheckoutController extends Controller
{

    /**
     * @var IRepositoryCheckout
     * @author Mohamed Ahmed
     */
    private $_checkoutRepository;

    /**
     * @var IRepositoryOrderStatus
     * @author Mohamed Ahmed
     */
    private $_orderStatusRepository;

    /**
     * @var IRepositoryOrderHistory
     * @author Mohamed Ahmed
     */
    private $_orderHistoryRepository;

    /**
     * CheckoutController constructor.
     * @param IRepositoryCheckout $_checkoutRepository
     * @param IRepositoryOrderStatus $_orderStatusRepository
     * @param IRepositoryOrderHistory $_orderHistoryRepository
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositoryCheckout $_checkoutRepository,IRepositoryOrderStatus $_orderStatusRepository,IRepositoryOrderHistory $_orderHistoryRepository)
    {
        $this->_checkoutRepository = $_checkoutRepository;
        $this->_orderStatusRepository = $_orderStatusRepository;
        $this->_orderHistoryRepository = $_orderHistoryRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $checkouts = $this->_checkoutRepository->advancedGet(['order_by' => ['id'=>'DESC'],'paginate' => ['per_page' => 30]]);
        return view('admin.pages.checkouts.index' ,compact('checkouts'));
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show($id)
    {
        $checkout = $this->_checkoutRepository->getFirstBy(['id' => $id],['*'],['orders','histories']);
        $orderStatus = $this->_orderStatusRepository->allBy([]);
        return view('admin.pages.checkouts.single' ,compact(['checkout','orderStatus']));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function invoice($id){
        $checkout = $this->_checkoutRepository->getFirstBy(['id' => $id],['*'],['orders']);
        return view('admin.pages.checkouts.invoice' ,compact('checkout'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function downloadInvoice($id){
        $checkout = $this->_checkoutRepository->getFirstBy(['id' => $id],['*'],['orders']);
        get_invoice($id,$checkout);
        $file = storage_path('app/public/uploads/pdf/' . $id . '.pdf');
        return response()->download($file);
    }

    /**
     * @param OrderHistoryRequest $historyRequest
     * @param $checkoutId
     * @return string[]
     * @throws \ReflectionException
     */
    public function addHistory(OrderHistoryRequest $historyRequest,$checkoutId){
        $this->_orderHistoryRepository->create(array_merge((array)OrderHistoryDTO::fromRequest($historyRequest),['checkout_id' => $checkoutId]));
        return ['status' => 'success' ,'data' => 'تم اضافه الحالة بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $checkout = $this->_checkoutRepository->getFirstBy(['id' => $id]);
        $checkout->orders()->delete();
        $checkout->delete();
        return redirect()->back();
    }
}
