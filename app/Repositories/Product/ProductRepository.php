<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    /**
     * Implement get products list
     * @param string $sort
     * @param string $direction
     * @param int $limit
     * @param array $searchs
     * @return mixed
     */
    public function getProductsList(string $sort, string $direction, int $limit, array $searchs = [])
    {
        $query = $this->model->newQuery();
        foreach ($searchs as $attributes) {
            if (!$this->getQuery($query, $attributes)) continue;
        }
        return $query->orderBy($sort, $direction)->paginate($limit);
    }
}
