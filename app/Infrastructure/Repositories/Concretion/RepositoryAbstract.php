<?php

namespace App\Infrastructure\Repositories\Concretion;

use App\Infrastructure\Repositories\Abstraction\IRepositoryAbstraction;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;

abstract class RepositoryAbstract implements IRepositoryAbstraction
{
    /**
     * @author Mohamed Ahmed
     * @var Eloquent|Model
     */
    protected $model;

    /**
     * @author Mohamed Ahmed
     * @var Eloquent | Model
     */
    protected $originalModel;

    /**
     * RepositoriesAbstract constructor.
     * @author Mohamed Ahmed
     * @param Model|Eloquent $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->originalModel = $model;
    }

    /**
     * @author Mohamed Ahmed
     * @return Eloquent|Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @author Mohamed Ahmed
     * @return $this|RepositoriesAbstract
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @author Mohamed Ahmed
     * @return string
     */
    public function getTable()
    {
        return $this->model->getTable();
    }

    /**
     * @param int $id
     * @param array $with
     * @author Mohamed Ahmed
     * @return Builder|Model|mixed|object|null
     */
    public function findById($id, array $with = [])
    {
        $data = $this->make($with)->where('id', $id);
        $data = $data->first();
        $this->resetModel();
        return $data;
    }

    /**
     * @param array $with
     * @author Mohamed Ahmed
     * @return Eloquent|Builder|Model
     */
    public function make(array $with = [])
    {
        if (!empty($with)) {
            $this->model = $this->model->with($with);
        }
        return $this->model;
    }

    /**
     * @author Mohamed Ahmed
     * @return $this
     */
    public function resetModel()
    {
        $this->model = new $this->originalModel;
        return $this;
    }

    /**
     * @param int $id
     * @param array $with
     * @author Mohamed Ahmed
     * @return Builder|Model|mixed|object
     */
    public function findOrFail($id, array $with = [])
    {
        $data = $this->make($with)->where('id', $id);
        $result = $data->first();
        $this->resetModel();
        if (!empty($result)) {
            return $result;
        }
        throw (new ModelNotFoundException)->setModel(
            get_class($this->originalModel), $id
        );
    }

    /**
     * @param array $with
     * @author Mohamed Ahmed
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function all(array $with = [])
    {
        return $this->make($with)->get();
    }

    /**
     * @param string $column
     * @param null $key
     * @param array $condition
     * @author Mohamed Ahmed
     * @return array
     */
    public function pluck($column, $key = null, array $condition = [])
    {
        $this->applyConditions($condition);
        $select = [$column];
        if (!empty($key)) {
            $select = [$column, $key];
        }
        return $this->model->select($select)->pluck($column, $key)->all();
    }

    /**
     * @param array $condition
     * @param array $with
     * @param array|string[] $select
     * @author Mohamed Ahmed
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function allBy(array $condition, array $with = [], array $select = ['*'])
    {
        $this->applyConditions($condition);
        return $this->make($with)->select($select)->get();
    }

    /**
     * @param array $where
     * @param null $model
     * @author Mohamed Ahmed
     */
    protected function applyConditions(array $where, &$model = null)
    {
        if (!$model) {
            $newModel = $this->model;
        } else {
            $newModel = $model;
        }
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                [$field, $condition, $val] = $value;
                switch (strtoupper($condition)) {
                    case 'IN':
                        $newModel = $newModel->whereIn($field, $val);
                        break;
                    case 'NOT_IN':
                        $newModel = $newModel->whereNotIn($field, $val);
                        break;
                    default:
                        $newModel = $newModel->where($field, $condition, $val);
                        break;
                }
            } else {
                $newModel = $newModel->where($field, $value);
            }
        }
        if (!$model) {
            $this->model = $newModel;
        } else {
            $model = $newModel;
        }
    }

    /**
     * @param array $data
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function create(array $data)
    {
        $data = $this->model->create($data);
        $this->resetModel();
        return $data;
    }

    /**
     * @param array|Model $data
     * @param array $condition
     * @author Mohamed Ahmed
     * @return false|Model
     */
    public function createOrUpdate($data, array $condition = [])
    {
        if (is_array($data)) {
            if (empty($condition)) {
                $item = new $this->model;
            } else {
                $item = $this->getFirstBy($condition);
            }
            if (empty($item)) {
                $item = new $this->model;
            }
            $item = $item->fill($data);
        } elseif ($data instanceof Model) {
            $item = $data;
        } else {
            return false;
        }
        if ($item->save()) {
            $this->resetModel();
            return $item;
        }
        $this->resetModel();
        return false;
    }

    /**
     * @param array $condition
     * @param array|string[] $select
     * @param array $with
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function getFirstBy(array $condition = [], array $select = ['*'], array $with = [])
    {
        $this->make($with);
        $this->applyConditions($condition);
        if (!empty($select)) {
            $data = $this->model->select($select);
        } else {
            $data = $this->model->select('*');
        }
        return $data->first();
    }

    /**
     * @param Model $model
     * @return bool|null
     * @author Mohamed Ahmed
     * @throws \Exception
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }

    /**
     * @param array $data
     * @param array $with
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function firstOrCreate(array $data, array $with = [])
    {
        $data = $this->model->firstOrCreate($data, $with);
        $this->resetModel();
        return $data;
    }

    /**
     * @param array $condition
     * @param array $data
     * @author Mohamed Ahmed
     * @return bool|mixed
     */
    public function update(array $condition, array $data)
    {
        $this->applyConditions($condition);
        $data = $this->model->update($data);
        $this->resetModel();
        return $data;
    }

    /**
     * @param array|string[] $select
     * @param array $condition
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function select(array $select = ['*'], array $condition = [])
    {
        $this->applyConditions($condition);
        return $this->model->select($select);
    }

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     * @return bool|mixed
     */
    public function deleteBy(array $condition = [])
    {
        $this->applyConditions($condition);
        $data = $this->model->get();
        if (empty($data)) {
            return false;
        }
        foreach ($data as $item) {
            $item->delete();
        }
        $this->resetModel();
        return true;
    }

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     * @return int
     */
    public function count(array $condition = [])
    {
        $this->applyConditions($condition);
        $data = $this->model->count();
        $this->resetModel();
        return $data;
    }

    /**
     * @param $column
     * @param array $value
     * @param array $args
     * @author Mohamed Ahmed
     * @return RepositoriesAbstract[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByWhereIn($column, array $value = [], array $args = [])
    {
        $data = $this->model->whereIn($column, $value);
        if (!empty(Arr::get($args, 'where'))) {
            $this->applyConditions($args['where']);
        }
        if (!empty(Arr::get($args, 'paginate'))) {
            return $data->paginate((int)$args['paginate']);
        } elseif (!empty(Arr::get($args, 'limit'))) {
            return $data->limit((int)$args['limit']);
        }
        return $data->get();
    }

    /**
     * @param array $params
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function advancedGet(array $params = [])
    {
        $params = array_merge([
            'condition' => [],
            'order_by'  => [],
            'take'      => null,
            'paginate'  => [
                'per_page'      => null,
                'current_paged' => 1,
            ],
            'select'    => ['*'],
            'with'      => [],
        ], $params);
        $this->applyConditions($params['condition']);
        $data = $this->model;
        if ($params['select']) {
            $data = $data->select($params['select']);
        }
        foreach ($params['order_by'] as $column => $direction) {
            if (!in_array(strtolower($direction), ['asc', 'desc'])) {
                continue;
            }
            if ($direction !== null) {
                $data = $data->orderBy($column, $direction);
            }
        }
        if (!empty($params['with'])) {
            $data = $data->with($params['with']);
        }
        if (!empty($params['withCount'])) {
            $data = $data->withCount($params['withCount']);
        }
        if ($params['take'] == 1) {
            $result = $data->first();
        } elseif ($params['take']) {
            $result = $data->take((int)$params['take'])->get();
        } elseif ($params['paginate']['per_page']) {
            $paginateType = 'paginate';
            if (Arr::get($params, 'paginate.type') && method_exists($data, Arr::get($params, 'paginate.type'))) {
                $paginateType = Arr::get($params, 'paginate.type');
            }
            $result = $data
                ->$paginateType(
                    (int)Arr::get($params, 'paginate.per_page', 10),
                    [$this->originalModel->getTable() . '.' . $this->originalModel->getKeyName()],
                    'page',
                    (int)Arr::get($params, 'paginate.current_paged', 1)
                );
        } else {
            $result = $data->get();
        }

        return $result;
    }

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     */
    public function forceDelete(array $condition = [])
    {
        $this->applyConditions($condition);
        $item = $this->model->withTrashed()->first();
        if (!empty($item)) {
            $item->forceDelete();
        }
    }

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     * @return mixed|void
     */
    public function restoreBy(array $condition = [])
    {
        $this->applyConditions($condition);
        $item = $this->model->withTrashed()->first();
        if (!empty($item)) {
            $item->restore();
        }
    }

    /**
     * @param array $condition
     * @param array $select
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function getFirstByWithTrash(array $condition = [], array $select = [])
    {
        $this->applyConditions($condition);
        $query = $this->model->withTrashed();
        if (!empty($select)) {
            return $query->select($select)->first();
        }
        return $query->first();
    }

    /**
     * @param array $data
     * @author Mohamed Ahmed
     * @return bool
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param array $condition
     * @author Mohamed Ahmed
     * @return mixed
     */
    public function firstOrNew(array $condition)
    {
        $this->applyConditions($condition);
        $result = $this->model->first() ?: new $this->originalModel;
        $this->resetModel();
        return $result;
    }
}
