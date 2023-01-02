<?php

declare(strict_types=1);

namespace App\UI\ExchangeRate\Http\Controller\GetExchangeRate\Dto;

use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateResponse;

class GetExchangeRateResponseDto
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
