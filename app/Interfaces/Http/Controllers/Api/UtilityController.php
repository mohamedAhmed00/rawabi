<?php
namespace App\Interfaces\Http\Controllers\Api;

use App\Application\Requests\Site\ContactRequest;
use App\Application\Requests\Site\SubscribeRequest;
use App\Application\Resources\CityResource;
use App\Application\Resources\SettingResource;
use App\Application\Resources\SliderResource;
use App\Domain\City\Repositories\Abstraction\IRepositoryCity;
use App\Domain\Product\Repositories\Abstraction\IRepositoryProduct;
use App\Domain\Setting\Repositories\Abstraction\IRepositorySetting;
use App\Domain\Slider\Repositories\Abstraction\IRepositorySlider;
use App\Domain\User\DTOs\MessageDTO;
use App\Domain\User\DTOs\SubscribeDTO;
use App\Domain\User\Repositories\Abstraction\IRepositorySubscribe;
use App\Domain\User\Services\Abstraction\IServiceMessage;
use App\Interfaces\Http\Controllers\Controller;

class UtilityController extends Controller
{

    /**
     * @var IRepositoryProduct
     */
    private $_productRepository;

    /**
     * @var IRepositorySlider
     */
    private $_sliderRepository;

    /**
     * @var IRepositorySetting
     */
    private $_settingRepository;

    /**
     * @var IRepositoryCity
     */
    private $_cityRepository;

    /**
     * @var IRepositorySubscribe
     */
    private $_subscribeRepository;

    /**
     * @var IServiceMessage
     */
    private $_contactService;

    /**
     * HomeController constructor.
     * @author Mohamed Ahmed
     * @param IRepositoryProduct $_productRepository
     */
    public function __construct(IRepositoryProduct $_productRepository,IRepositorySlider $_sliderRepository,IRepositorySetting $_settingRepository,IRepositoryCity $_cityRepository,IServiceMessage $_contactService,IRepositorySubscribe $_subscribeRepository)
    {
        $this->_productRepository = $_productRepository;
        $this->_sliderRepository = $_sliderRepository;
        $this->_settingRepository = $_settingRepository;
        $this->_cityRepository = $_cityRepository;
        $this->_contactService = $_contactService;
        $this->_subscribeRepository = $_subscribeRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getSliders()
    {
        $sliders = $this->_sliderRepository->advancedGet(['condition' => ['status' => 1],'order_by'=> ['order'=>'ASC']]);
        return SliderResource::collection($sliders);
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getSettings()
    {
        return json_encode(parseSettings($this->_settingRepository->allBy([])->toArray()),JSON_UNESCAPED_UNICODE);
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getCities()
    {
        $cities = $this->_cityRepository->allBy([]);
        return CityResource::collection($cities);
    }

    /**
     * @param ContactRequest $request
     * @author Mohamed Ahmed
     * @return mixed
     * @throws \ReflectionException
     */
    public function contacts(ContactRequest $request)
    {
        $this->_contactService->sendMessage((array)MessageDTO::fromRequest($request));
        return json_encode(['data'=>'تم ارسال الرساله بنجاح'],JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param SubscribeRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function subscribe(SubscribeRequest $request)
    {
        $this->_subscribeRepository->create((array)SubscribeDTO::fromRequest($request));
        return json_encode(['data'=> "شكرا لك علي التواصل معنا"],JSON_UNESCAPED_UNICODE);
    }
}
