<?php

declare(strict_types=1);

namespace App\Component\NotificationService\Application\Service\Recipient;

class NotificationRecipient
{
    public static function create(
        string $firstName,
        string $lastName,
        string $email,
    ): self {
        return new self($firstName, $lastName, $email);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    private function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
    ) {
    }
}
