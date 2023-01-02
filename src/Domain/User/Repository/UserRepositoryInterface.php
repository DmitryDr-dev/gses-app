<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\User;

interface UserRepositoryInterface
{
    public function save(User $entity, bool $flush): void;

    /** @return User[] */
    public function getAll(int $limit, int $offset): array;
}
