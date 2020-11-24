<?php
namespace App\Interfaces\Http\Controllers\Site;

use App\Domain\About\Repositories\Abstraction\IRepositoryAbout;
use App\Domain\Features\Repositories\Abstraction\IRepositoryFeatures;
use App\Domain\Testimonial\Repositories\Abstraction\IRepositoryTestimonial;
use App\Interfaces\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
     * @var IRepositoryAbout
     */
    private $_aboutRepository;

    /**
     * @var IRepositoryFeatures
     */
    private $_featureRepository;

    /**
     * @var IRepositoryTestimonial
     */
    private $_testimonialRepository;

    /**
     * AboutController constructor.
     * @param IRepositoryAbout $_aboutRepository
     * @param IRepositoryFeatures $_featureRepository
     * @param IRepositoryTestimonial $_testimonialRepository
     */
    public function __construct(IRepositoryAbout $_aboutRepository,IRepositoryFeatures $_featureRepository,IRepositoryTestimonial $_testimonialRepository)
    {
        $this->_aboutRepository = $_aboutRepository;
        $this->_featureRepository = $_featureRepository;
        $this->_testimonialRepository = $_testimonialRepository;
    }

    public function index()
    {
        $about = $this->_aboutRepository->firstOrNew([]);
        $features = $this->_featureRepository->all();
        $testimonials = $this->_testimonialRepository->all();
        return view('site.pages.about.index' ,compact(['about' ,'features' ,'testimonials']));
    }
}
