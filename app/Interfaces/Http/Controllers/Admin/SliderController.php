<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\SliderRequest;
use App\Domain\Slider\Repositories\Abstraction\IRepositorySlider;
use App\Domain\Slider\DTOs\SliderDTO;
use App\Interfaces\Http\Controllers\Controller;

class SliderController extends Controller
{

    /**
     * @var IRepositorySlider
     */
    private $_sliderRepository;

    /**
     * SliderController constructor.
     * @param IRepositorySlider $_sliderRepository
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositorySlider $_sliderRepository)
    {
        $this->_sliderRepository = $_sliderRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $sliders = $this->_sliderRepository->advancedGet(['order_by'=> ['order'=>'ASC']]);
        return view('admin.pages.sliders.index' ,compact('sliders'));
    }

    /**
     * @param SliderRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(SliderRequest $request)
    {
        $this->_sliderRepository->create((array)SliderDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم اضافه الاسليدر بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit($id)
    {
        $slider = $this->_sliderRepository->getFirstBy(['id' => $id]);
        return view('admin.pages.sliders.templates.edit' ,compact('slider'));
    }

    /**
     * @param SliderRequest $request
     * @param $id
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function update(SliderRequest $request , $id)
    {
        $this->_sliderRepository->update(['id' => $id], (array)SliderDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم تعديل بيانات الاسليدر بنجاح'];
    }

    /**
     * @param $slug
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->_sliderRepository->deleteBy(['id' => $id]);
        return redirect()->back();
    }
}
