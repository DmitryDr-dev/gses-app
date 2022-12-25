<?php

declare(strict_types=1);

namespace App\UI\ExchangeRate\Http\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class GetExchangeRateRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $sourceCurrency;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $targetCurrency;

    #[Assert\NotBlank]
    #[Assert\Type(type: ['float', 'int'])]
    private $sourceAmount;

    public function __construct($sourceCurrency, $targetCurrency, $sourceAmount)
    {
        $this->sourceCurrency = $sourceCurrency;
        $this->targetCurrency = $targetCurrency;
        $this->sourceAmount = $sourceAmount;
    }
}
