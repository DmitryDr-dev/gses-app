<?php

declare(strict_types=1);

namespace App\UI\User\Http\Dto\Request;

use App\UI\Shared\Http\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class GetAllUsersRequestDto extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('int')]
    protected $limit;

    #[Assert\NotBlank]
    #[Assert\Type('int')]
    protected $offset;
}