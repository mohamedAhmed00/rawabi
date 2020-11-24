<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\AboutRequest;
use App\Domain\About\Repositories\Abstraction\IRepositoryAbout;
use App\Domain\About\DTOs\AboutDTO;
use App\Interfaces\Http\Controllers\Controller;

class AboutController extends Controller
{

    /**
     * @var IRepositoryAbout
     * @author Mohamed Ahmed
     */
    private $_aboutRepository;

    /**
     * AboutController constructor.
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositoryAbout $_aboutRepository)
    {
        $this->_aboutRepository = $_aboutRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $about = $this->_aboutRepository->firstOrNew([]);
        return view('admin.pages.about.index' ,compact('about'));
    }

    /**
     * @param AboutRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(AboutRequest $request)
    {
        $about = $this->_aboutRepository->firstOrNew([]);
        $this->_aboutRepository->update(['id'=> $about->id],(array)AboutDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم تحديث بيانات من نحن بنجاح'];
    }
}
