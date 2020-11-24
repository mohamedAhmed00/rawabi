<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Domain\User\Repositories\Abstraction\IRepositoryMessage;
use App\Interfaces\Http\Controllers\Controller;

class MessageController extends Controller
{

    /**
     * @author Mohamed Ahmed
     * @var IRepositoryMessage
     */
    private $_messageRepository;

    /**
     * MessageController constructor.
     * @author Mohamed Ahmed
     * @param IRepositoryMessage $_messageRepository
     */
    public function __construct(IRepositoryMessage $_messageRepository)
    {
        $this->_messageRepository = $_messageRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $messages = $this->_messageRepository->all();
        return view('admin.pages.messages.index' ,compact('messages'));
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->_messageRepository->deleteBy(['id'=>$id]);
        return redirect()->back();
    }
}
