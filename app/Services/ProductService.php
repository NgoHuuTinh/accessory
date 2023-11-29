<?php

namespace App\Services;

use App\Repositories\Product\ProductRepositoryInterface;

class ProductService
{
    /** @var ProductRepositoryInterface */
    private $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    /**
     * findById
     * @param $id
     * @return mixed
     */
    public function findById(int $id) 
    {
        return $this->productRepositoryInterface->find($id);
    }

    /**
     * getProductsList
     * @param array $data
     * @return array
     */
    public function getProductsList(array $data)
    {
        $sort = $data['sort'] ?? 'updated_at';
        $direction = $data['direction'] ?? 'desc';
        $limit = $data['limit'] ?? 20;
        $searchs = [];
        $records = [];
        $stores = [];

        isset($data['name']) ? $records[] = ['key' => 'name', 'filter' => ['name', 'LIKE', '%' . $data['name'] . '%']] : '';

        foreach ($records as $record) {
            $searchs[] = $record['filter'];
            $stores[$record['key']] = $data[$record['key']];
        }
        // store value search
        session()->put('searchParams', $stores);
        return $this->productRepositoryInterface->getProductsList($sort, $direction, $limit, $searchs);
    }

    /**
     * create
     * @param Request $request
     * @return mixed
     */
    public function create(array $data) {
        return $this->productRepositoryInterface->create($data);
    }

    /**
     * update
     * @param Request $request
     * @return mixed
     */
    public function update(int $id, array $data) {
        return $this->productRepositoryInterface->update($id, $data);
    }

    /**
     * delete
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->productRepositoryInterface->delete($id);
    }

}
