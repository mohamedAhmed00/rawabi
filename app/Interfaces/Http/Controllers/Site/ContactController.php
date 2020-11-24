<?php
namespace App\Interfaces\Http\Controllers\Site;

use App\Application\Requests\Site\ContactRequest;
use App\Domain\User\DTOs\MessageDTO;
use App\Domain\User\Services\Abstraction\IServiceMessage;
use App\Interfaces\Http\Controllers\Controller;

class ContactController extends Controller
{

    /**
     * @author Mohamed Ahmed
     * @var IServiceMessage
     */
    private $_contactService;

    /**
     * ContactController constructor.
     * @author Mohamed Ahmed
     * @param IServiceMessage $_contactService
     */
    public function __construct(IServiceMessage $_contactService)
    {
        $this->_contactService = $_contactService;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        return view('site.pages.contact.index');
    }

    /**
     * @param ContactRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(ContactRequest $request)
    {
        return $this->_contactService->sendMessage((array)MessageDTO::fromRequest($request));
    }
}
