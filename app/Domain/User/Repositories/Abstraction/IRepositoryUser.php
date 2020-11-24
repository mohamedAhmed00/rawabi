<?php
namespace App\Domain\User\Repositories\Abstraction;

interface IRepositoryUser
{
    /**
     * @param array $params
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function getUserByUsernameOrEmail(array $params);
}
