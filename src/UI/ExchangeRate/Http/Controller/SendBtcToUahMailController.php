<?php

declare(strict_types=1);

namespace App\UI\ExchangeRate\Http\Controller;

use App\Application\ExchangeRate\Command\SendBtcToUahMail\SendBtcToUahMailCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class SendBtcToUahMailController extends AbstractController
{
    public function __construct(private MessageBusInterface $commandBus)
    {
    }

    #[Route('/exchange-rate/send-mail', name: 'send-rate-mail', methods: ['POST'])]
    public function __invoke(): Response
    {
        $this->commandBus->dispatch(new SendBtcToUahMailCommand());

        return new Response(
            content: null,
            status: Response::HTTP_OK,
        );
    }
}
