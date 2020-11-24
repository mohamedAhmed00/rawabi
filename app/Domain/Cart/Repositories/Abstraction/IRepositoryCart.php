<?php
namespace App\Domain\Cart\Repositories\Abstraction;

interface IRepositoryCart
{
    /**
     * @param $userId
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function getCartInfoByUserId($userId);
}
