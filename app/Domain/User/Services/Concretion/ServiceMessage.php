<?php
namespace App\Domain\User\Services\Concretion;

use App\Domain\User\Mail\ContactUsMail;
use App\Domain\User\Repositories\Abstraction\IRepositoryMessage;
use App\Domain\User\Services\Abstraction\IServiceMessage;
use App\Infrastructure\Services\Concretion\ServiceAbstract;
use Illuminate\Support\Facades\Mail;

final class ServiceMessage extends ServiceAbstract implements IServiceMessage
{
    /**
     * @author Mohamed Ahmed
     * @var IRepositoryMessage
     */
    private $_messageRepository;

    /**
     * ServiceMessage constructor.
     * @author Mohamed Ahmed
     * @param IRepositoryMessage $_messageRepository
     */
    public function __construct(IRepositoryMessage $_messageRepository)
    {
        $this->_messageRepository = $_messageRepository;
    }

    /**
     * @param $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function sendMessage($request){
        Mail::to(env('MESSAGE_SEND_TO'))->send(new ContactUsMail($request['name'] , $request['email'] , $request['phone']));
        $this->_messageRepository->create($request);
        return ['status' => 'success' ,'data' => 'تم ارسال رسالتك بنجاح وسيتم التواصل معاك لاحقا'];
    }
}
