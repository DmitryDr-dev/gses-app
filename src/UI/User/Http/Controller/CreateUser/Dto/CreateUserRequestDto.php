<?php

declare(strict_types=1);

namespace App\UI\User\Http\Controller\CreateUser\Dto;

use App\UI\Shared\Http\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequestDto extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    protected $firstName;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    protected $lastName;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Email]
    protected $email;
}
