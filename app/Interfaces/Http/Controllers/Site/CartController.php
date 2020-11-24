<?php
namespace App\Interfaces\Http\Controllers\Site;

use App\Domain\Cart\Services\Abstraction\IServiceCart;
use App\Domain\Product\Entities\Product;
use Illuminate\Http\Request;
use App\Interfaces\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * @author Mohamed Ahmed
     * @var IServiceCart
     */
    private $_cartService;

    /**
     * CartController constructor.
     * @author Mohamed Ahmed
     * @param IServiceCart $_cartService
     */
    public function __construct(IServiceCart $_cartService)
    {
        $this->_cartService = $_cartService;
    }

    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function index()
    {
        return $this->_cartService->index();
    }

    /**
     * @param Request $request
     * @param Product $product
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function store(Request $request , Product $product)
    {
        return $this->_cartService->addToCart($request,$product);
    }

    /**
     * @param Request $request
     * @param $rowId
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function update(Request $request , $rowId)
    {
        return $this->_cartService->updateToCart($request,$rowId);
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function delete($id)
    {
        return $this->_cartService->remove($id);
    }
}
