<?php

declare(strict_types=1);

namespace App\Application\ExchangeRate\Query\GetExchangeRate;

class GetExchangeRateQuery
{
    public function __construct(
        private string $sourceCurrency,
        private string $targetCurrency,
        private float $sourceAmount
    ) {
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
}
