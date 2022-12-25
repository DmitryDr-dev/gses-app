<?php

declare(strict_types=1);

namespace App\Infrastructure\ExchangeRate\Client;

use App\Application\ExchangeRate\Service\ApiClient\Exception\RequestFailedException;
use App\Application\ExchangeRate\Service\ApiClient\ExchangeApiClientInterface;
use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExchangeRateHostClient implements ExchangeApiClientInterface
{
    public function __construct(private HttpClientInterface $exchangeRateHost)
    {
    }

    public function getExchangeRate(
        string $sourceCurrency,
        string $targetCurrency,
        float $sourceAmount
    ): ExchangeRateResponse {
        $response = $this->call(
            'GET',
            "/convert?from={$sourceCurrency}&to={$targetCurrency}&amount={$sourceAmount}"
        );

        return ExchangeRateResponse::create(
            $response['query']['from'],
            $response['query']['to'],
            $response['query']['amount'],
            $response['result'],
            $response['date'],
        );
    }

    private function call(string $method, string $url): array
    {
        try {
            $response = $this->exchangeRateHost->request($method, $url);

            return $response->toArray();
        } catch (HttpExceptionInterface $exception) {
            $message = $exception->getResponse()->getContent(false);

            if (Response::HTTP_BAD_REQUEST === $exception->getResponse()->getStatusCode()) {
                throw new BadRequestHttpException($message);
            }

            throw RequestFailedException::create($message);
        }
    }
}
