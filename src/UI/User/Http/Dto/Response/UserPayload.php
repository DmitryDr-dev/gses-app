<?php

declare(strict_types=1);

namespace App\UI\User\Http\Dto\Response;

use App\Domain\User\User;

class UserPayload
{
    public static function create(User $user): self
    {
        return new self(
            id: $user->getId(),
            firstName: $user->getFirstName(),
            lastName: $user->getLastName(),
            email: $user->getEmail(),
        );
    }

    private function __construct(
        public int    $id,
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {
    }
}
