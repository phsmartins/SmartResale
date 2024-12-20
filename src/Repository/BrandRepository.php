<?php

namespace Smart\Resale\Repository;

use Smart\Resale\Entity\Brand;

readonly class BrandRepository
{
    public function __construct(
        private \PDO $pdo,
    )
    {}

    public function addBrand(Brand $brand): bool
    {
        $querySql = "
            INSERT INTO brands (
                name, description, user_id
            ) VALUES (
                :brand_name, :description, :user_id        
            );
        ";

        $statement = $this->pdo->prepare($querySql);

        $statement->bindValue(":brand_name", $brand->getBrandName());
        $statement->bindValue(":description", $brand->getDescription());
        $statement->bindValue(":user_id", $brand->getUserId());

        $resultAddBrand = $statement->execute();

        $id = $this->pdo->lastInsertId();
        $brand->setId($id);

        return $resultAddBrand;
    }

    public function updateBrand(Brand $brand): int
    {
        $querySql = "
            UPDATE brands SET
                name = :brand_name,
                description = :description
            WHERE id = :id AND user_id = :user_id;
        ";

        $statement = $this->pdo->prepare($querySql);

        $statement->bindValue(":brand_name", $brand->getBrandName());
        $statement->bindValue(":description", $brand->getDescription());
        $statement->bindValue(":id", $brand->getId());
        $statement->bindValue(":user_id", $brand->getUserId());

        if (!$statement->execute()) {
            return -1;
        }

        return $statement->rowCount();
    }

    public function removeBrand(int $id, int $userId): int
    {
        $querySql = "DELETE FROM brands WHERE id = :id AND user_id = :user_id";

        $statement = $this->pdo->prepare($querySql);

        $statement->bindValue(":id", $id);
        $statement->bindValue(":user_id", $userId);

        if (!$statement->execute()) {
            return -1;
        }

        return $statement->rowCount();
    }

    public function findBrandsByUserId(int $userId, int $page, int $limit, string $filter, int $order = 0): ?array
    {
        $allowedFilters = ['name', 'invoicing', 'profit', 'quantity_products_sold', 'number_registered_products'];
        $filter = in_array($filter, $allowedFilters) ? $filter : 'id';

        $order = ($order === 1) ? 'DESC' : '';

        $startOfPagination = ($page * $limit) - $limit;

        $querySql = "
            SELECT * FROM brands 
            WHERE user_id = :user_id 
            ORDER BY {$filter} {$order}
            LIMIT :start_pagination, :limit
        ";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":user_id", $userId);
        $statement->bindValue(":start_pagination", $startOfPagination);
        $statement->bindValue(":limit", $limit);

        if (!$statement->execute()) {
            return null;
        }

        $brandsList = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(
            $this->hydrateBrand(...),
            $brandsList
        );
    }

    public function countAllBrands(int $userId): ?array
    {
        $querySql = "SELECT COUNT(id) AS result_brands_count FROM brands WHERE user_id = :user_id";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":user_id", $userId);

        if (!$statement->execute()) {
            return null;
        }

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function findBrandById(int $brandId): ?Brand
    {
        $querySql = "SELECT * FROM brands WHERE id = :brand_id";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":brand_id", $brandId);

        if (!$statement->execute()) {
            return null;
        }

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return null;
        }

        return $this->hydrateBrand($result);
    }

    private function hydrateBrand(array $brandData): Brand
    {
        $brand = new Brand(
            $brandData['user_id'],
            $brandData['name'],
            $brandData['description'],
        );

        $brand->setId($brandData['id']);
        $brand->setInvoicing($brandData['invoicing']);
        $brand->setProfit($brandData['profit']);
        $brand->setQuantityOfProductsSold($brandData['quantity_products_sold']);
        $brand->setNumberRegisteredProducts($brandData['number_registered_products']);

        return $brand;
    }
}
