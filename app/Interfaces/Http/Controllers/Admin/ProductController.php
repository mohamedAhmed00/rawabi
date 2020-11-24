<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\ProductRequest;
use App\Domain\Product\Repositories\Abstraction\IRepositoryProduct;
use App\Domain\Product\DTOs\ProductDTO;
use App\Interfaces\Http\Controllers\Controller;

class ProductController extends Controller
{

    /**
     * @var IRepositoryProduct
     */
    private $_productRepository;


    /**
     * ProductController constructor.
     * @param IRepositoryProduct $_productRepository
     * @author Mohamed Ahmed
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
        $products = $this->_productRepository->advancedGet(['order_by'=> ['order'=>'ASC']]);
        return view('admin.pages.products.index' ,compact('products'));
    }

    /**
     * @param ProductRequest $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(ProductRequest $request)
    {
        $this->_productRepository->create((array)ProductDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم اضافه المنتج بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $product = $this->_productRepository->getFirstBy(['slug' => $slug]);
        return view('admin.pages.products.templates.edit' ,compact('product'));
    }

    /**
     * @param ProductRequest $request
     * @param $id
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function update(ProductRequest $request , $slug)
    {
        $this->_productRepository->update(['slug' => $slug], (array)ProductDTO::fromRequest($request));
        return ['status' => 'success' ,'data' => 'تم تعديل بيانات المنتج بنجاح'];
    }

    /**
     * @param $slug
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($slug)
    {
        $product = $this->_productRepository->getFirstBy(['slug' => $slug]);
        $product->categories()->delete();
        $this->_productRepository->deleteBy(['slug' => $slug]);
        return redirect()->back();
    }
}
