<?php

declare(strict_types=1);

namespace App\UI\User\Http\Controller;

use App\Application\User\Command\CreateUser\CreateUserCommand;
use App\UI\User\Http\Dto\Request\CreateUserRequestDto;
use App\UI\User\Http\Dto\Response\UserPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->messageBus = $commandBus;
    }

    #[Route('user/create', name: 'create-user', methods: ['POST'])]
    public function __invoke(CreateUserRequestDto $request): Response
    {
        $request->validate();
        $data = $request->convertToArray();
        $user = $this->handle(
            new CreateUserCommand(
                firstName: $data['firstName'],
                lastName: $data['lastName'],
                email: $data['email'],
            )
        );


        return new JsonResponse(
            data: UserPayload::create($user),
            status: Response::HTTP_OK,
        );
    }
}
