<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Domain\User\Repositories\Abstraction\IRepositorySubscribe;
use App\Interfaces\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    /**
     * @var IRepositorySubscribe
     */
    private $_subscribeRepository;

    /**
     * SubscriberController constructor.
     * @param IRepositorySubscribe $_subscribeRepository
     */
    public function __construct(IRepositorySubscribe $_subscribeRepository)
    {
        $this->_subscribeRepository = $_subscribeRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $subscribers = $this->_subscribeRepository->all();
        return view('admin.pages.subscribers.index' ,compact('subscribers'));
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->_subscribeRepository->deleteBy(['id' => $id]);
        return redirect()->back();
    }
}
