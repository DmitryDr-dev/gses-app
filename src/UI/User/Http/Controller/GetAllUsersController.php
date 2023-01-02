<?php

declare(strict_types=1);

namespace App\UI\User\Http\Controller;

use App\Application\User\Query\GetAllUsers\GetAllUsersQuery;
use App\UI\User\Http\Dto\Request\GetAllUsersRequestDto;
use App\UI\User\Http\Dto\Response\UserPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class GetAllUsersController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    #[Route('user/list', name: 'user-list', methods: ['POST'])]
    public function __invoke(GetAllUsersRequestDto $request): Response
    {
        $request->validate();
        $data = $request->convertToArray();
        $result = $this->handle(
            new GetAllUsersQuery(
                limit: $data['limit'],
                offset: $data['offset'],
            )
        );

        foreach ($result as $user) {
            $users[] = UserPayload::create($user);
        }

        return new JsonResponse(
            data: $users ?? [],
            status: Response::HTTP_OK,
        );
    }
}
