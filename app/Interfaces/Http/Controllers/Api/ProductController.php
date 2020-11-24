<?php
namespace App\Interfaces\Http\Controllers\Api;

use App\Application\Resources\ProductResource;
use App\Application\Resources\ProductsResource;
use App\Domain\Product\Repositories\Abstraction\IRepositoryProduct;
use App\Interfaces\Http\Controllers\Controller;

class ProductController extends Controller
{

    /**
     * @var IRepositoryProduct
     */
    private $_productRepository;

    /**
     * HomeController constructor.
     * @author Mohamed Ahmed
     * @param IRepositoryProduct $_productRepository
     */
    public function __construct(IRepositoryProduct $_productRepository)
    {
        $this->_productRepository = $_productRepository;
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getProducts()
    {
        $products = $this->_productRepository->advancedGet(['condition' => ['active' => 1],'order_by'=> ['order'=>'ASC'],'with' => ['categories']]);
        return ProductsResource::collection($products);
    }

    /**
     * @param $slug
     * @author Mohamed Ahmed
     * @return ProductResource
     */
    public function getProduct($slug)
    {
        $product = $this->_productRepository->getFirstBy(['slug' => $slug,'active' => 1],['*'],['categories']);
        return new ProductResource($product);
    }

}
