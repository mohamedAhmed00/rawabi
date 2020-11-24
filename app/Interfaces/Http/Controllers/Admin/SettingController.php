<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\SettingRequest;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrderStatus;
use App\Domain\Setting\DTOs\SettingDTO;
use App\Domain\Setting\Repositories\Abstraction\IRepositorySetting;
use App\Interfaces\Http\Controllers\Controller;
use Complex\Exception;

class SettingController extends Controller
{
    /**
     * @author Mohamed Ahmed
     * @var IRepositorySetting
     */
    private $_settingRepository;

    /**
     * @author Mohamed Ahmed
     * @var IRepositoryOrderStatus
     */
    private $_orderStatusRepository;

    /**
     * SettingController constructor.
     * @param IRepositorySetting $_settingRepository
     * @param IRepositoryOrderStatus $_orderStatusRepository
     */
    public function __construct(IRepositorySetting $_settingRepository,IRepositoryOrderStatus $_orderStatusRepository)
    {
        $this->_settingRepository = $_settingRepository;
        $this->_orderStatusRepository = $_orderStatusRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $settings = parseSettings($this->_settingRepository->allBy([])->toArray());
        $orderStatus = $this->_orderStatusRepository->allBy([]);
        return view('admin.pages.settings.index' ,compact(['settings','orderStatus']));
    }

    /**
     * @param SettingRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(SettingRequest $request)
    {
        try {
            $this->_settingRepository->truncate();
            $this->_settingRepository->storeSettings(((array)SettingDTO::fromRequest($request))['settings']);
            return ['status' => 'success' ,'data' => 'تم تعديل بيانات الموقع بنجاح'];
        } catch (\Exception $exception){
            dd($exception);
            return ['status' => 'error' ,'data' => $exception->getMessage()];
        }

    }
}
