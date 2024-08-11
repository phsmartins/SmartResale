<?php

namespace Smart\Resale\Entity;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $passwordHash;

    public function __construct(string $name, string $email, string $password)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setPasswordHash($password);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = filter_var($id, FILTER_VALIDATE_INT);
    }

    public function getName(): string
    {
        return mb_convert_case($this->name, MB_CASE_TITLE, "UTF-8");
    }

    public function setName(string $name): void
    {
        $this->name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $password): void
    {
        $this->passwordHash = password_hash($password, PASSWORD_ARGON2ID);
    }
}
