<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    public $model;

    /**
     * construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     */
    abstract public function getModel();

    /**
     * set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * get all
     * @param string $sort
     * @param string $direction
     * @param int $limit
     */
    public function getAll(string $sort, string $direction, int $limit)
    {
        return $this->model->orderBy($sort, $direction)->paginate($limit);
    }

    /**
     * Get all
     * 
     * @return mixed
     */
    public function getList()
    {
        return $this->model->get();
    }

    /**
     * find by id
     * 
     * @param int $id
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param array $attributes   
     * @return mixed|bool
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes      
     * @return bool|mixed
     */
    public function update(int $id, array $attributes)
    {
        $model = $this->find($id);
        if ($model) {
            return $model->update($attributes);
        }
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $model = $this->find($id);
        if ($model) {
            return $model->delete();
        }
        return false;
    }

    /**
     * @return array
     */
    private function availableOperators()
    {
        return ['<', '>', '=', '<=', '>=', '<>', 'LIKE', 'IS_NULL', 'IS_NOT_NULL', 'IN', 'BETWEEN'];
    }

    /**
     * check valid operator
     * 
     * @param $operator
     * @return mixed|bool
     */
    private function isValidOperator($operator)
    {
        if (!in_array($operator, $this->availableOperators())) {
            throw new \Exception("Invalid operator: $operator");
        }
        return true;
    }

    /**
     * get query
     * 
     * @param object $query
     * @param array $attribute
     * @param string $relation
     * @param bool $isRelation
     * @return mixed|bool
     */
    public function getQuery(object &$query, array $attributes, string $relation = null, bool $isRelation = false)
    {
        list($field, $operator, $value) = $attributes;

        $this->isValidOperator($operator);
        switch ($operator) {
            case 'IS_NULL':
                if ($isRelation) {
                    $query->whereHas($relation, function ($query) use ($field) {
                        $query->whereNull($field);
                    });
                } else {
                    $query->whereNull($field);
                }
                break;
            case 'IS_NOT_NULL':
                if ($isRelation) {
                    $query->whereHas($relation, function ($query) use ($field) {
                        $query->whereNotNull($field);
                    });
                } else {
                    $query->whereNotNull($field);
                }
                break;
            case 'IN':
                if (!$value) break;
                if ($isRelation) {
                    $query->whereHas($relation, function ($query) use ($field, $value) {
                        $query->whereIn($field, $value);
                    });
                } else {
                    $query->whereIn($field, $value);
                }
                break;
            case 'BETWEEN':
                if (!$value) break;
                if ($isRelation) {
                    $query->whereHas($relation, function ($query) use ($field, $value) {
                        $query->whereBetween($field, $value);
                    });
                } else {
                    $query->whereBetween($field, $value);
                }
                break;
            default:
                if ($value === null) break;
                if ($isRelation) {
                    $query->whereHas($relation, function ($query) use ($field, $operator, $value) {
                        $query->where($field, $operator, $value);
                    });
                } else {
                    $query->where($field, $operator, $value);
                }
                break;
        }
        return true;
    }


    /**
     * Implement get advanced search
     * @param object $query
     * @param array $searchable
     * @param string $searchString
     * @return Builder
     */
    private function advancedSearch(object $query, array $searchable = [], string $searchString)
    {
        $query->where(function ($query) use ($searchable, $searchString) {
            foreach ($searchable as $key => $column) {
                if (is_array($column)) {
                    $concat = implode(", ' ', ", $column);
                    $query->orWhereRaw("CONCAT($concat) LIKE ?", "%$searchString%");
                } else {
                    $query->orWhere($searchable, 'LIKE', "%$searchString%");
                }
            }
        });
        return $query;
    }

    /**
     * Implement get value search from multiple columns
     * @param object $query
     * @param array $attributes
     * @return Builder
     */
    private function getSearchMultiple(object $query, array $attributes)
    {
        $query->where(function ($query) use ($attributes) {
            if (is_array($attributes['columns'])) {
                foreach ($attributes['columns'] as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $attributes['data'] . '%');
                }
            } else {
                $query->orWhere($attributes['columns'], 'LIKE', '%' . $attributes['data'] . '%');
            }
        });
        return $query;
    }

    /**
     * Implement get search list by search conditions
     * @param string $sort
     * @param string $direction
     * @param int $limit
     * @param array $searchs @example ['field_name', '=', 'filter_value']
     * @param array $searchsRelation @example ['relation' => ['relation_column', '=', 'filter_value']]
     * @param array $with
     * @param array $seachable @example ['field_name', '=', 'filter_value']
     * @param array $searchString @example ['field_name', '=', 'filter_value']
     * @param array $searchMultiple @example ['column' => ['field_column'], 'data' => 'field_value']]
     * @param mixed
     */
    public function getSearchConditions(string $sort, string $direction, int $limit, array $searchs = [], array $searchsRelation = [], array $with = [], array $seachable = [], array $searchString = [], array $searchMultiple = [])
    {
        $query = $this->model->newQuery();

        $query = $query->with($with);

        foreach ($searchs as $attributes) {
            if (!$this->getQuery($query, $attributes)) continue;
        }
        foreach ($searchsRelation as $relation => $attributes) {
            if (!$this->getQuery($query, $attributes, $relation, true)) continue;
        }

        foreach ($searchString as $attributes) {
            if (!$this->advancedSearch($query, $seachable, $attributes)) continue;
        }
        // search string at multiple columns
        foreach ($searchMultiple as $attributes) {
            if (!$this->getSearchMultiple($query, $attributes)) continue;
        }
        return $query->orderBy($sort, $direction)->paginate($limit);
    }

    /**
     * Implement get list by conditions
     * @param array $attributes
     * @param array $columns
     * @return mixed
     */
    public function getListByConditions(array $attributes, array $columns = ['*'])
    {
        $query = $this->model->newQuery();
        foreach ($attributes as $attribute) {
            if (!$this->getQuery($query, $attribute)) continue;
        }
        return $query->get($columns);
    }
}
