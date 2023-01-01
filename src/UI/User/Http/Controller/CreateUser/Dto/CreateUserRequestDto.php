<?php

declare(strict_types=1);

namespace App\UI\User\Http\Controller\CreateUser\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public $firstName;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public $lastName;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Email]
    public $email;

    public function __construct($firstName, $lastName, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}
