<?php

declare(strict_types=1);

namespace App\Application\ExchangeRate\Query\GetExchangeRate;

use App\Application\ExchangeRate\Service\ApiClient\ExchangeApiClientInterface;
use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateResponse;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetExchangeRateHandler
{
    public function __construct(private ExchangeApiClientInterface $client)
    {
    }

    public function __invoke(GetExchangeRateQuery $query): ExchangeRateResponse
    {
        return $this->client->getExchangeRate(
            $query->getSourceCurrency(),
            $query->getTargetCurrency(),
            $query->getSourceAmount(),
        );
    }
}
