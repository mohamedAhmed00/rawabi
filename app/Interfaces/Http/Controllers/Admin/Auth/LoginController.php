<?php
namespace App\Interfaces\Http\Controllers\Admin\Auth;

use App\Domain\User\DTOs\UserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\Abstraction\IRepositoryUser;
use App\Interfaces\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;

class LoginController extends Controller {

    /**
     * @var IRepositoryUser
     * @author Mohamed Ahmed
     */
    private $_userRepository;

    /**
     * LoginController constructor.
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositoryUser $_userRepository)
    {
        $this->_userRepository = $_userRepository;
        $this->middleware('guest', ['except' => 'logout' ]);
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index() {
        return view('admin.auth.login');
    }

    /**
     * @param Request $request
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        $return = $this->successResponse();
        $admin = $this->_userRepository->getUserByUsernameOrEmailForAdminLogin((array)UserDTO::fromRequest($request));

        if ($admin && Hash::check($request->get('password'), $admin->password)) {
            Auth::guard()->login($admin, $request->has('remember'));
        } else {
            $return = $this->failResponse();
        }
        return response()->json($return);
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        Auth::guard()->logout();
        return redirect('/admin/login');
    }

    /**
     * @author Mohamed Ahmed
     * @return string[]
     */
    private function successResponse(){
        return [
            'response' => 'success',
            'message' => 'تم تسجيل الدخول بنجاح',
            'url' => 'admin/'
        ];
    }

    /**
     * @author Mohamed Ahmed
     * @return string[]
     */
    private function failResponse(){
        return [
            'response' => 'error',
            'message' => 'البيانات المستخدمه خاطئه'
        ];
    }

}
