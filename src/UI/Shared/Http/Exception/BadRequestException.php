<?php

declare(strict_types=1);

namespace App\UI\Shared\Http\Exception;

class BadRequestException extends \Exception
{
    public static function create(string $message): self
    {
        return new self($message);
    }
}
