<?php
namespace App\Interfaces\Http\Controllers\Site;

use App\Application\Requests\Site\SubscribeRequest;
use App\Domain\HomeSection\Repositories\Abstraction\IRepositoryHomeSection;
use App\Domain\Product\Repositories\Abstraction\IRepositoryProduct;
use App\Domain\User\Repositories\Abstraction\IRepositorySubscribe;
use App\Interfaces\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * @var IRepositoryHomeSection
     */
    private $_homeSectionRepository;

    /**
     * @var IRepositoryProduct
     */
    private $_productRepository;

    /**
     * @var IRepositorySubscribe
     */
    private $_subscribeRepository;

    /**
     * HomeController constructor.
     * @param IRepositoryHomeSection $_homeSectionRepository
     * @param IRepositoryProduct $_productRepository
     * @param IRepositorySubscribe $_subscribeRepository
     */
    public function __construct(IRepositoryHomeSection $_homeSectionRepository,IRepositoryProduct $_productRepository,IRepositorySubscribe $_subscribeRepository)
    {
        $this->_homeSectionRepository =  $_homeSectionRepository;
        $this->_productRepository = $_productRepository;
        $this->_subscribeRepository = $_subscribeRepository;
    }

    /**
     * @return void
     */
    public function index()
    {
        $products = $this->_productRepository->advancedGet(['condition' => ['active' => 1],'order_by'=> ['order'=>'ASC']]);
        $sections = $this->_homeSectionRepository->all();
        return view('site.pages.index' ,compact(['sections' ,'products']));
    }

    /**
     * @param SubscribeRequest $request
     * @return string[]
     */
    public function storeSubscribe(SubscribeRequest $request)
    {
        try {
            $this->_subscribeRepository->create(['email' => $request->email]);
            return ['status' => 'success' ,'data' => 'شكرا لك علي التواصل معنا'];
        } catch (\Exception $e){
            return ['status' => 'success' ,'data' => 'شكرا لك علي التواصل معنا'];
        }
    }
}
