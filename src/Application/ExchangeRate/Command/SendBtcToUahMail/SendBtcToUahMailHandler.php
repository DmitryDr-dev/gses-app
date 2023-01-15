<?php

declare(strict_types=1);

namespace App\Application\ExchangeRate\Command\SendBtcToUahMail;

use App\Application\ExchangeRate\Service\ApiClient\ExchangeApiClientInterface;
use App\Component\MailerService\Application\Service\Notification\ExchangeRateNotification;
use App\Component\NotificationService\Application\Service\Recipient\NotificationRecipient;
use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class SendBtcToUahMailHandler
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private ExchangeApiClientInterface $client,
        private UserRepositoryInterface $repository,
    ) {
    }

    public function __invoke(SendBtcToUahMailCommand $command): void
    {
        $exchangeRate = $this->client->getExchangeRate(
            sourceCurrency: 'BTC',
            targetCurrency: 'UAH',
            sourceAmount: 1,
        );

        $recipients = $this->repository->getAll();

        foreach ($recipients as $recipient) {
            $this->commandBus->dispatch(new ExchangeRateNotification(
                recipient: NotificationRecipient::create(
                    firstName: $recipient->getFirstName(),
                    lastName: $recipient->getLastName(),
                    email: $recipient->getEmail(),
                ),
                exchangeRate: $exchangeRate,
            ));
        }
    }
}
