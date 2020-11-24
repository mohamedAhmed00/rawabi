<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\TestimonialRequest;
use App\Domain\Testimonial\DTOs\TestimonialDTO;
use App\Domain\Testimonial\Repositories\Abstraction\IRepositoryTestimonial;
use App\Interfaces\Http\Controllers\Controller;

class TestimonialController extends Controller
{

    /**
     * @var IRepositoryTestimonial
     * @author Mohamed Ahmed
     */
    private $_testimonialRepository;

    /**
     * TestimonialController constructor.
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositoryTestimonial $_testimonialRepository)
    {
        $this->_testimonialRepository = $_testimonialRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $members = $this->_testimonialRepository->all();
        return view('admin.pages.testimonials.index' ,compact('members'));
    }

    /**
     * @param TestimonialRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(TestimonialRequest $request)
    {
        $this->_testimonialRepository->create((array)TestimonialDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم ادخال راي العميل بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit($id)
    {
        $member = $this->_testimonialRepository->getFirstBy(['id' => $id]);
        return view('admin.pages.testimonials.templates.edit' ,compact('member'));
    }

    /**
     * @param TestimonialRequest $request
     * @param $id
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function update(TestimonialRequest $request , $id)
    {
        $this->_testimonialRepository->update(['id' => $id],(array)TestimonialDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم تعديل راي العميل بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->_testimonialRepository->deleteBy(['id' => $id]);
        return redirect()->back();
    }
}
