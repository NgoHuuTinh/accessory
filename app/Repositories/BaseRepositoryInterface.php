<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    /**
     * Implement get list
     * @param string $sort
     * @param string $direction
     * @param int $limit
     * @return mixed
     */
    public function getAll(string $sort, string $direction, int $limit);

    /**
     * Implement get model by id
     * @param $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Implement create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Implement update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);

    /**
     * Implement delete
     * @param $id
     * @return bool
     */
    public function delete(int $id);

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
    public function getSearchConditions(string $sort, string $direction, int $limit, array $searchs = [], array $searchsRelation = [], array $with = [], array $seachable = [], array $searchString = [], array $searchMultiple = []
    );
}
