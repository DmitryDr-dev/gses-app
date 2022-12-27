<?php

declare(strict_types=1);

namespace App\Application\ExchangeRate\Service\ApiClient\Response;

class ExchangeRateResponse
{
    public static function create(
        string $sourceCurrency,
        string $targetCurrency,
        float $sourceAmount,
        float $targetAmount,
        ?string $date = null,
    ): self {
        return new self(
            $sourceCurrency,
            $targetCurrency,
            $sourceAmount,
            $targetAmount,
            $date ? date('Y-m-d', strtotime($date)) : date('Y-m-d'),
        );
    }

    public function getSourceCurrency(): string
    {
        return $this->sourceCurrency;
    }

    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    public function getSourceAmount(): float
    {
        return $this->sourceAmount;
    }

    public function getTargetAmount(): float
    {
        return $this->targetAmount;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    private function __construct(
        private string $sourceCurrency,
        private string $targetCurrency,
        private float $sourceAmount,
        private float $targetAmount,
        private string $date,
    ) {
    }
}
