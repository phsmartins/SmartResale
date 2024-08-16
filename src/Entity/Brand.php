<?php

namespace Smart\Resale\Entity;

use Smart\Resale\Traits\NumberFormatTrait;

class Brand
{
    use NumberFormatTrait;

    private int $id;
    private int $userId;
    private string $brandName;
    private string $description;

    private float $invoicing;
    private float $profit;
    private int $quantityOfProductsSold;

    public function __construct(int $userId, string $brandName, string $description = null)
    {
        $this->setUserId($userId);
        $this->setBrandName($brandName);
        $this->setDescription($description);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getBrandName(): string
    {
        return mb_convert_case($this->brandName, MB_CASE_TITLE, "UTF-8");
    }

    public function setBrandName(string $brandName): void
    {
        $this->brandName = filter_var($brandName, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getDescription(): ?string
    {
        return filter_var($this->description, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function setDescription(?string $description): void
    {
        $this->description = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getInvoicing(): string
    {
        return $this->numberFormatReal($this->invoicing);
    }

    public function setInvoicing(int $value): void
    {
        $this->invoicing = $value / 100;
    }

    public function getProfit(): string
    {
        return $this->numberFormatReal($this->profit);
    }

    public function setProfit(int $value): void
    {
        $this->profit = $value / 100;
    }

    public function getQuantityOfProductsSold(): int
    {
        return $this->quantityOfProductsSold;
    }

    public function setQuantityOfProductsSold(int $quantity): void
    {
        $this->quantityOfProductsSold = $quantity;
    }
}
