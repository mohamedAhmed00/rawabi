<?php
namespace App\Domain\Cart\Repositories\Concretion;

use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Repositories\Abstraction\IRepositoryCart;
use App\Infrastructure\Repositories\Concretion\RepositoryAbstract;

final class RepositoryCart extends RepositoryAbstract implements IRepositoryCart
{

    /**
     * @param $userId
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function getCartInfoByUserId($userId){

        return Cart::where('user_id' , $userId )->get();
    }
}
