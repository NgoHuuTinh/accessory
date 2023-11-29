<?php 

namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Implement get products list
     * @param string $sort
     * @param string $direction
     * @param int $limit
     * @param array $searchs
     * @return mixed
     */
    public function getProductsList(string $sort, string $direction, int $limit, array $searchs = []);
}
