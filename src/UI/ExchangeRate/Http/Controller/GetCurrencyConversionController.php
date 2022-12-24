<?php

declare(strict_types=1);

namespace App\UI\ExchangeRate\Http\Controller;

use App\UI\ExchangeRate\Http\Controller\Dto\GetCurrencyConversionRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GetCurrencyConversionController extends AbstractController
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    #[Route('/convert', name: 'convert', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $data = $request->toArray();
        $dto = new GetCurrencyConversionRequestDto($data['sourceCurrency'], $data['targetCurrency'], $data['sourceAmount']);
        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            throw new BadRequestHttpException((string) $errors);
        }

        return new JsonResponse('ok', 200);
    }
}
