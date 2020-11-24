<?php
namespace App\Interfaces\Http\Controllers\Site;

use App\Domain\Product\Repositories\Abstraction\IRepositoryProduct;
use App\Interfaces\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * @author Mohamed Ahmed
     * @var IRepositoryProduct
     */
    private $_productRepository;

    /**
     * OrderController constructor.
     * @author Mohamed Ahmed
     * @param IRepositoryProduct $_productRepository
     */
    public function __construct(IRepositoryProduct $_productRepository)
    {
        $this->_productRepository = $_productRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->_productRepository->advancedGet(['condition' => ['active' => 1],'order_by'=> ['order'=>'ASC']]);
        return view('site.pages.orders.index' ,compact(['products']));
    }

    /**
     * @param $productId
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show($productId)
    {
        $product = $this->_productRepository->getFirstBy(['slug' => $productId]);
        return view('site.pages.orders.single' ,compact(['product']));
    }
}
