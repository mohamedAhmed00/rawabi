<?php
namespace App\Interfaces\Http\Controllers\Api;

use App\Domain\User\DTOs\RegisterUserDTO;
use App\Domain\User\Repositories\Abstraction\IRepositoryUser;
use App\Interfaces\Http\Controllers\Controller;

class ApiManagementController extends Controller
{
    /**
     * @var IRepositoryUser
     */
    private $_userRepository;

    /**
     * ApiManagementController constructor.
     * @param IRepositoryUser $_userRepository
     */
    public function __construct(IRepositoryUser $_userRepository)
    {
        $this->_userRepository =  $_userRepository;
    }

    /**
     * ApiManagementController constructor.
     */
    public function ping(){
        $user = $this->_userRepository->getUserByUsernameOrEmail(array('email' => request()->ip() . '@rawabey-alqasim.com'));
        if (is_null($user))
        {
            $user = $this->_userRepository->create((array)RegisterUserDTO::fromRequest(request()));
        }
        return response()->json(['status' => 'success','data' => $user->createToken('token-for-'.request()->ip())->plainTextToken]);
    }
}
