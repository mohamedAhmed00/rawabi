<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\FeatureRequest;
use App\Domain\Features\DTOs\FeatureDTO;
use App\Domain\Features\Repositories\Abstraction\IRepositoryFeatures;
use App\Interfaces\Http\Controllers\Controller;

class FeatureController extends Controller
{
    /**
     * @var IRepositoryFeatures
     */
    private $_featureRepository;

    /**
     * FeatureController constructor.
     * @param IRepositoryFeatures $_featureRepository
     */
    public function __construct(IRepositoryFeatures $_featureRepository)
    {
        $this->_featureRepository = $_featureRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $features = $this->_featureRepository->all();
        return view('admin.pages.features.index' ,compact('features'));
    }

    /**
     * @param FeatureRequest $request
     * @param $id
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function update(FeatureRequest $request , $id)
    {
        $this->_featureRepository->update(['id'=> $id],(array)FeatureDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم تحديث الميزه بنجاح'];
    }
}
