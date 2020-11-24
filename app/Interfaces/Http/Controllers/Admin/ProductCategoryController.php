<?php
namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Requests\Admin\ProductCategoryRequest;
use App\Domain\Product\Repositories\Abstraction\IRepositoryProductCategory;
use App\Domain\Product\DTOs\ProductCategoryDTO;
use App\Interfaces\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{

    /**
     * @var IRepositoryProductCategory
     */
    private $_productCategoryRepository;

    /**
     * ProductCategoryController constructor.
     * @param IRepositoryProductCategory $_productCategoryRepository
     * @author Mohamed Ahmed
     */
    public function __construct(IRepositoryProductCategory $_productCategoryRepository)
    {
        $this->_productCategoryRepository = $_productCategoryRepository;
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index($id)
    {
        $categories = $this->_productCategoryRepository->allBy(['product_id' => $id]);
        return view('admin.pages.products.categories.index' ,compact('categories' ,'id'));
    }

    /**
     * @param ProductCategoryRequest $request
     * @param $id
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function store(ProductCategoryRequest $request , $id)
    {
        $this->_productCategoryRepository->create(array_merge((array)ProductCategoryDTO::fromRequest($request),['product_id' => $id]));
        return ['status' => 'success' ,'data' => 'تم اضافه الحجم بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->_productCategoryRepository->findById($id);
        return view('admin.pages.products.categories.templates.edit' ,compact('category'));
    }

    /**
     * @param ProductCategoryRequest $request
     * @param $id
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function update(ProductCategoryRequest $request , $id)
    {
        $category = $this->_productCategoryRepository->findById($id);
        $this->_productCategoryRepository->update(['id' => $id],array_merge((array)ProductCategoryDTO::fromRequest($request),['product_id' => $category->product_id]));
        return ['status' => 'success' ,'data' => 'تم تعديل الحجم بنجاح'];
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->_productCategoryRepository->deleteBy(['id' => $id]);
        return redirect()->back();
    }
}
