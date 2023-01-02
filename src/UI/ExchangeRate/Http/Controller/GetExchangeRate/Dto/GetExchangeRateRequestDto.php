<?php

declare(strict_types=1);

namespace App\UI\ExchangeRate\Http\Controller\GetExchangeRate\Dto;

use App\UI\Shared\Http\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class GetExchangeRateRequestDto extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    protected $sourceCurrency;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    protected $targetCurrency;

    #[Assert\NotBlank]
    #[Assert\Type(type: ['float', 'int'])]
    protected $sourceAmount;
}
