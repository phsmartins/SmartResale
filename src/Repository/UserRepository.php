<?php

namespace Smart\Resale\Repository;

use Smart\Resale\Entity\User;

readonly class UserRepository
{
    public function __construct(
        private \PDO $pdo
    )
    {}

    private function checkIfEmailExists(string $userEmail): void
    {
        $querySql = "SELECT COUNT(*) FROM users WHERE email = :email;";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":email", $userEmail);
        $statement->execute();

        $existsEmail = $statement->fetchColumn();

        if ($existsEmail > 0) {
            throw new \LogicException("O e-mail que você forneceu já está associado a uma conta");
        }
    }

    public function addUser(User $user): bool
    {
        $this->checkIfEmailExists($user->getEmail());

        $querySql = "
            INSERT INTO users (
                name, email, password
            ) VALUES (
                :name, :email, :password
            );
        ";

        $statement = $this->pdo->prepare($querySql);

        $statement->bindValue(":name", $user->getName());
        $statement->bindValue(":email", $user->getEmail());
        $statement->bindValue(":password", $user->getPasswordHash());

        $resultAddVideo = $statement->execute();

        $id = $this->pdo->lastInsertId();
        $user->setId($id);

        return $resultAddVideo;
    }

    public function updateUser(string $name, string $email, int $id): bool
    {
        $querySql = "
            UPDATE users SET
                name = :name,
                email = :email
            WHERE id = :id;
        ";

        $statement = $this->pdo->prepare($querySql);

        $statement->bindValue(":name", $name);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":id", $id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function removerUser(int $id): bool
    {
        $querySql = "DELETE FROM users WHERE id = :id;";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":id", $id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function findUserData(int $id): ?array
    {
        $querySql = "SELECT * FROM users WHERE id = :id;";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":id", $id);

        $resultFindUserData = $statement->execute();
        $userData = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($resultFindUserData === false || $userData === false) {
            return null;
        }

        return $userData;
    }

    public function findUserByEmail(string $email): ?array
    {
        $querySql = "SELECT * FROM users WHERE email = :email";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":email", $email);

        $resultFindUserByEmail = $statement->execute();
        $userData = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($resultFindUserByEmail === false || $userData === false) {
            return null;
        }

        return $userData;
    }

    public function updatePassword(string $password, int $id): bool
    {
        $querySql = "
            UPDATE users SET
                password = :password 
            WHERE id = :id;
        ";

        $statement = $this->pdo->prepare($querySql);

        $statement->bindValue(':password', password_hash($password, PASSWORD_ARGON2ID));
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }
}
