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

    public function updateUser(User $user): bool
    {
        $querySql = "
            UPDATE users SET
                name = :name,
                email = :email,
                password = :password
            WHERE id = :id;
        ";

        $statement = $this->pdo->prepare($querySql);

        $statement->bindValue(":name", $user->getName());
        $statement->bindValue(":email", $user->getEmail());
        $statement->bindValue(":password", $user->getPasswordHash());
        $statement->bindValue(":id", $user->getId(), \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function removerUser(int $id): bool
    {
        $querySql = "DELETE FROM users WHERE id = :id;";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":id", $id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function findUserData(int $id): ?User
    {
        $querySql = "SELECT * FROM users WHERE id = :id;";

        $statement = $this->pdo->prepare($querySql);
        $statement->bindValue(":id", $id);

        $resultFindUserData = $statement->execute();
        $userData = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($resultFindUserData === false || $userData === false) {
            return null;
        }

        return $this->hydrateUser($userData);
    }

    private function hydrateUser(array $userData): User
    {
        $user = new User(
            $userData["name"],
            $userData["email"],
            $userData["password"],
        );
        $user->setId($userData['id']);

        return $user;
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
}
