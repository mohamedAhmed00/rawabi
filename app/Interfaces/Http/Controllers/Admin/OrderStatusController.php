<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\OrderStatusRequest;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrderStatus;
use App\Domain\Order\DTOs\OrderStatusDTO;
use App\Interfaces\Http\Controllers\Controller;

class OrderStatusController extends Controller
{

    /**
     * @var IRepositoryOrderStatus
     */
    private $_orderStatusRepository;

    /**
     * OrderStatusController constructor.
     * @param IRepositoryOrderStatus $_orderStatusRepository
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositoryOrderStatus $_orderStatusRepository)
    {
        $this->_orderStatusRepository = $_orderStatusRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $orderStatus = $this->_orderStatusRepository->allBy([]);
        return view('admin.pages.order_status.index' ,compact('orderStatus'));
    }

    /**
     * @param OrderStatusRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(OrderStatusRequest $request)
    {
        $this->_orderStatusRepository->create((array)OrderStatusDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم اضافه الحالة بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit($id)
    {
        $orderStatus = $this->_orderStatusRepository->getFirstBy(['id' => $id]);
        return view('admin.pages.order_status.templates.edit' ,compact('orderStatus'));
    }

    /**
     * @param OrderStatusRequest $request
     * @param $id
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function update(OrderStatusRequest $request , $id)
    {
        $this->_orderStatusRepository->update(['id' => $id], (array)OrderStatusDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم تعديل بيانات الحالة بنجاح'];
    }

    /**
     * @param $slug
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->_orderStatusRepository->deleteBy(['id' => $id]);
        return redirect()->back();
    }
}
