<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\CityRequest;
use App\Domain\City\DTOs\CityDTO;
use App\Domain\City\Repositories\Abstraction\IRepositoryCity;
use App\Interfaces\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * @author Mohamed Ahmed
     * @var IRepositoryCity
     */
    private $_cityRepository;

    /**
     * ServiceOrder constructor.
     * @param IRepositoryCity $_cityRepository
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositoryCity $_cityRepository)
    {
        $this->_cityRepository = $_cityRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $cities = $this->_cityRepository->all();
        return view('admin.pages.cities.index' ,compact('cities'));
    }

    /**
     * @param CityRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(CityRequest $request)
    {
        $this->_cityRepository->create((array)CityDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم اضافه المدينه بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit($id)
    {
        $city = $this->_cityRepository->getFirstBy(['id' => $id]);
        return view('admin.pages.cities.templates.edit' ,compact('city'));
    }

    /**
     * @param CityRequest $request
     * @param $id
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function update(CityRequest $request , $id)
    {
        $this->_cityRepository->update(['id'=>$id],(array)CityDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم تعديل بيانات المدينه بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->_cityRepository->deleteBy(['id' => $id]);
        return redirect()->back();
    }
}
