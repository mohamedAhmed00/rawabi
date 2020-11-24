<?php
namespace App\Interfaces\Http\Controllers\Api;

use App\Application\Requests\Site\UpdateCartRequest;
use App\Application\Resources\CartResource;
use App\Domain\Cart\DTOs\CartDTO;
use App\Domain\Cart\Repositories\Abstraction\IRepositoryCart;
use App\Domain\Product\Repositories\Abstraction\IRepositoryProduct;
use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @author Mohamed Ahmed
     * @var IRepositoryCart
     */
    private $_cartRepository;

    /**
     * @author Mohamed Ahmed
     * @var IRepositoryProduct
     */
    private $_productRepository;

    /**
     * @author Mohamed Ahmed
     * @var $_userId
     */
    private $_userId;

    /**
     * CartController constructor.
     * @author Mohamed Ahmed
     * @param IRepositoryCart $_cartRepository
     */
    public function __construct(IRepositoryCart $_cartRepository,IRepositoryProduct $_productRepository)
    {
        $this->_cartRepository = $_cartRepository;
        $this->_productRepository = $_productRepository;
        if(auth('sanctum')->check()){
            $this->_userId = auth('sanctum')->user()->id;
        }
    }

    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function index()
    {
        return $this->_getCartInfo();
    }

    /**
     * @param $slug
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function store(Request $request , $slug )
    {
        $product = $this->_productRepository->getFirstBy(['slug' => $slug]);
        $request->request->add(['product' => $product]);
        $data = array_merge((array)CartDTO::fromRequest($request),['user_id' => $this->_userId]);
        if ($cart = $this->_cartRepository->getFirstBy(['key' => $data['key']])){
            $content = json_decode($cart->content);
            $content->qty += $request->qty;
            $cart->content = json_encode($content);
            $this->_cartRepository->update(['key' => $data['key']],['content' => json_encode($content)]);

        } else {
            $this->_cartRepository->create($data);
        }
        return $this->_getCartInfo();
    }

    /**
     * @param Request $request
     * @param $key
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function update(UpdateCartRequest $request , $key)
    {
        if ($cart = $this->_cartRepository->getFirstBy(['key' => $key])){
            $content = json_decode($cart->content);
            $content->qty = $request->qty;
            $cart->content = json_encode($content);
            $this->_cartRepository->update(['key' => $key],['content' => json_encode($content)]);
        }else{
            return $this->index();
        }
        return $this->_getCartInfo();
    }

    /**
     * @param $key
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function delete($key)
    {
        $this->_cartRepository->deleteBy(['key' => $key]);
        return $this->_getCartInfo();
    }

    /**
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function clear()
    {
        $this->_cartRepository->deleteBy(['user_id' => $this->_userId]);
        return response()->json(['data' => 'تم تفريغ السلة بنجاح']);
    }

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    private function _getCartInfo(){
        return CartResource::collection($this->_cartRepository->getCartInfoByUserId($this->_userId));
    }
}
