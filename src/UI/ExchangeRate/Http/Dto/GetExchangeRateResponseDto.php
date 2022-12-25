<?php

declare(strict_types=1);

namespace App\UI\ExchangeRate\Http\Dto;

class GetExchangeRateResponseDto
{
    public function __construct(
        public string $sourceCurrency,
        public string $targetCurrency,
        public float $sourceAmount,
        public float $targetAmount,
        public string $date,
    ) {
    }
}
