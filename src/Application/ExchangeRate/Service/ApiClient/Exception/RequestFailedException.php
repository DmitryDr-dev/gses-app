<?php

declare(strict_types=1);

namespace App\Application\ExchangeRate\Service\ApiClient\Exception;

class RequestFailedException extends \Exception
{
    public static function create(string $message): self
    {
        return new self('Request failed: '.$message);
    }
}
