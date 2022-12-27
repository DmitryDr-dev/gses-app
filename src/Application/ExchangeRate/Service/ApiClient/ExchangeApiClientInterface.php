<?php

declare(strict_types=1);

namespace App\Application\ExchangeRate\Service\ApiClient;

use App\Application\ExchangeRate\Service\ApiClient\Exception\RequestFailedException;
use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface ExchangeApiClientInterface
{
    /**
     * @throws BadRequestHttpException,
     * @throws RequestFailedException,
     */
    public function getExchangeRate(
        string $sourceCurrency,
        string $targetCurrency,
        float $sourceAmount,
    ): ExchangeRateResponse;
}
