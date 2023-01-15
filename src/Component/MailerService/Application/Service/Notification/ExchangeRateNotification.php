<?php

declare(strict_types=1);

namespace App\Component\MailerService\Application\Service\Notification;

use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateResponse;
use App\Component\NotificationService\Application\Service\Recipient\NotificationRecipient;

class ExchangeRateNotification extends EmailNotification
{
    public const TEMPLATE = 'emails/exchange-rate.html.twig';

    public const SUBJECT = 'Exchange Rate Updates';
    public function __construct(NotificationRecipient $recipient, ExchangeRateResponse $exchangeRate)
    {
        parent::__construct(
            recipient: $recipient,
            options: [
                'sourceCurrency' => $exchangeRate->getSourceCurrency(),
                'targetCurrency' => $exchangeRate->getTargetCurrency(),
                'sourceAmount' => $exchangeRate->getSourceAmount(),
                'targetAmount' => $exchangeRate->getTargetAmount(),
            ],
        );
    }
}
