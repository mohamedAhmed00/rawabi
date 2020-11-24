<?php
namespace App\Domain\User\Repositories\Concretion;

use App\Domain\User\Repositories\Abstraction\IRepositoryUser;
use App\Infrastructure\Repositories\Concretion\RepositoryAbstract;

final class RepositoryUser extends RepositoryAbstract implements IRepositoryUser
{

    /**
     * @param array $params
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function getUserByUsernameOrEmail(array $params){
        return $this->model->Where('email' , $params['email'])->where('super_user' , 0)->first();
    }

    /**
     * @param array $params
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function getUserByUsernameOrEmailForAdminLogin(array $params){
        return $this->model->where(function ($query) use ($params) {
            $query->where('name',  $params['email'])->where('super_user', 1);
        })->orWhere(function($query) use ($params) {
            $query->where('email', $params['email'])->where('super_user', 1);
        })->first();
    }
}
