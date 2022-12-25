<?php

declare(strict_types=1);

namespace App\UI\ExchangeRate\Http\Controller;

use App\Application\ExchangeRate\Query\GetExchangeRate\GetExchangeRateQuery;
use App\UI\ExchangeRate\Http\Dto\GetExchangeRateRequestDto;
use App\UI\ExchangeRate\Http\Dto\GetExchangeRateResponseDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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
    public function __invoke(Request $request): Response
    {
        $data = $request->toArray();
        $dto = new GetExchangeRateRequestDto($data['sourceCurrency'], $data['targetCurrency'], $data['sourceAmount']);
        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            throw new BadRequestHttpException((string) $errors);
        }

        $response = $this->handle(new GetExchangeRateQuery($data['sourceCurrency'], $data['targetCurrency'], $data['sourceAmount']));

        return new JsonResponse(
            new GetExchangeRateResponseDto(
                $response->getSourceCurrency(),
                $response->getTargetCurrency(),
                $response->getSourceAmount(),
                $response->getTargetAmount(),
                $response->getDate(),
            ),
            200
        );
    }
}
