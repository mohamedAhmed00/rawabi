<?php

namespace App\Infrastructure\Repositories\Abstraction;

use App\Infrastructure\Repositories\Concretion\RepositoriesAbstract;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

interface IRepositoryAbstraction
{
    /**
     * @author Mohamed Ahmed
     * @return Eloquent|Model
     */
    public function getModel();

    /**
     * @param string $model
     * @author Mohamed Ahmed
     * @return $this|RepositoriesAbstract
     */
    public function setModel($model);

    /**
     * @author Mohamed Ahmed
     * @return string
     */
    public function getTable();

    /**
     * @param int $id
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     *@author Mohamed Ahmed
     */
    public function findById($id, array $with = []);

    /**
     * @param array $with
     * @author Mohamed Ahmed
     * @return Eloquent|Builder|Model
     */
    public function make(array $with = []);

    /**
     * @author Mohamed Ahmed
     * @return $this
     */
    public function resetModel();

    /**
     * @param int $id
     * @param array $with
     * @author Mohamed Ahmed
     * @return Builder|Model|mixed|object
     */
    public function findOrFail($id, array $with = []);

    /**
     * @param array $with
     * @author Mohamed Ahmed
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function all(array $with = []);

    /**
     * @param string $column
     * @param null $key
     * @param array $condition
     * @author Mohamed Ahmed
     * @return array
     */
    public function pluck($column, $key = null, array $condition = []);

    /**
     * @param array $condition
     * @param array $with
     * @param array|string[] $select
     * @author Mohamed Ahmed
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function allBy(array $condition, array $with = [], array $select = ['*']);

    /**
     * @param array $data
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array|Model $data
     * @param array $condition
     * @author Mohamed Ahmed
     * @return false|Model
     */
    public function createOrUpdate($data, array $condition = []);

    /**
     * @param array $condition
     * @param array|string[] $select
     * @param array $with
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function getFirstBy(array $condition = [], array $select = ['*'], array $with = []);

    /**
     * @param Model $model
     * @return bool|null
     * @author Mohamed Ahmed
     * @throws \Exception
     */
    public function delete(Model $model);

    /**
     * @param array $data
     * @param array $with
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function firstOrCreate(array $data, array $with = []);

    /**
     * @param array $condition
     * @param array $data
     * @author Mohamed Ahmed
     * @return bool|mixed
     */
    public function update(array $condition, array $data);

    /**
     * @param array|string[] $select
     * @param array $condition
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function select(array $select = ['*'], array $condition = []);

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     * @return bool|mixed
     */
    public function deleteBy(array $condition = []);

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     * @return int
     */
    public function count(array $condition = []);

    /**
     * @param $column
     * @param array $value
     * @param array $args
     * @author Mohamed Ahmed
     * @return RepositoriesAbstract[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByWhereIn($column, array $value = [], array $args = []);

    /**
     * @param array $params
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function advancedGet(array $params = []);

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     */
    public function forceDelete(array $condition = []);

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     * @return mixed|void
     */
    public function restoreBy(array $condition = []);

    /**
     * @param array $condition
     * @param array $select
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function getFirstByWithTrash(array $condition = [], array $select = []);

    /**
     * @param array $data
     * @author Mohamed Ahmed
     * @return bool
     */
    public function insert(array $data);

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function firstOrNew(array $condition);
}
