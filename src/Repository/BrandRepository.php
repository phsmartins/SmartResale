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

    public function findAllBrandsByUserId(int $userId): ?array
    {
        $querySql = "SELECT * FROM brands WHERE user_id = :user_id";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":user_id", $userId);

        if (!$statement->execute()) {
            return null;
        }

        $brandsList = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(
            $this->hydrateBrand(...),
            $brandsList
        );
    }

    private function hydrateBrand(array $brandData): Brand
    {
        $brand = new Brand(
            $brandData['user_id'],
            $brandData['name'],
            $brandData['description'],
        );

        $brand->setId($brandData['id']);

        return $brand;
    }
}
