<?php

declare(strict_types=1);

namespace App\UI\ExchangeRate\Http\Dto\Response;

use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateResponse;

class ExchangeRatePayload
{
    public static function create(ExchangeRateResponse $result): self
    {
        return new self(
            sourceCurrency: $result->getSourceCurrency(),
            targetCurrency: $result->getTargetCurrency(),
            sourceAmount: $result->getSourceAmount(),
            targetAmount: $result->getTargetAmount(),
            date: $result->getDate(),
        );
    }

    private function __construct(
        public string $sourceCurrency,
        public string $targetCurrency,
        public float  $sourceAmount,
        public float  $targetAmount,
        public string $date,
    ) {
    }
}