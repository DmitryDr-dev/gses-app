<?php

declare(strict_types=1);

namespace App\Component\MailerService\Application\Service\Notification;

use App\Component\NotificationService\Application\Service\Recipient\NotificationRecipient;

abstract class EmailNotification
{
    public const TEMPLATE = 'email/default.html.twig';
    public const SUBJECT = 'Default Notification';

    public function __construct(
        private NotificationRecipient $recipient,
        private array $options = [],
    ) {
    }

    public function getRecipient(): NotificationRecipient
    {
        return $this->recipient;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
