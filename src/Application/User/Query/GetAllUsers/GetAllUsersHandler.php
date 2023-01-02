<?php

declare(strict_types=1);

namespace App\Application\User\Query\GetAllUsers;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\User;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetAllUsersHandler
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /** @return User[] */
    public function __invoke(GetAllUsersQuery $query): array
    {
        $users = $this->repository->getAll(
            limit: $query->getLimit(),
            offset: $query->getOffset(),
        );

        return $users;
    }
}
