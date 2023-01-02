<?php

declare(strict_types=1);

namespace App\UI\ExchangeRate\Http\Controller\GetExchangeRate;

use App\Application\ExchangeRate\Query\GetExchangeRate\GetExchangeRateQuery;
use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateResponse;
use App\UI\ExchangeRate\Http\Controller\GetExchangeRate\Dto\GetExchangeRateRequestDto;
use App\UI\ExchangeRate\Http\Controller\GetExchangeRate\Dto\GetExchangeRateResponseDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GetExchangeRateController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus, private ValidatorInterface $validator)
    {
        $this->messageBus = $queryBus;
    }

    #[Route('/convert', name: 'convert', methods: ['POST'])]
    public function __invoke(GetExchangeRateRequestDto $request): Response
    {
        $request->validate();
        $data = $request->convertToArray();

        /** @var ExchangeRateResponse $response */
        $result = $this->handle(
            new GetExchangeRateQuery(
                sourceCurrency: $data['sourceCurrency'],
                targetCurrency: $data['targetCurrency'],
                sourceAmount: $data['sourceAmount']
            )
        );

        return new JsonResponse(
            data: GetExchangeRateResponseDto::create($result),
            status: 200
        );
    }
}
