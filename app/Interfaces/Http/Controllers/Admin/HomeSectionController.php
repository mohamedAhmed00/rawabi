<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\HomeSectionRequest;
use App\Domain\HomeSection\DTOs\HomeSectionDTO;
use App\Domain\HomeSection\Repositories\Abstraction\IRepositoryHomeSection;
use App\Interfaces\Http\Controllers\Controller;

class HomeSectionController extends Controller
{
    /**
     * @var IRepositoryHomeSection
     * @author Mohamed Ahmed
     */
    private $_homeSectionRepository;

    /**
     * HomeSectionController constructor.
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositoryHomeSection $_homeSectionRepository)
    {
        $this->_homeSectionRepository = $_homeSectionRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $sections = $this->_homeSectionRepository->all();
        return view('admin.pages.home.index' ,compact('sections'));
    }

    /**
     * @param HomeSectionRequest $request
     * @param $id
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function update(HomeSectionRequest $request , $id)
    {
        $this->_homeSectionRepository->update(['id'=> $id],(array)HomeSectionDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم تحديث البيانات بنجاح'];
    }
}
