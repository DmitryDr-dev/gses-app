<?php

declare(strict_types=1);

namespace App\Component\NotificationService\Application\Service;

use App\Component\MailerService\Application\Service\Notification\EmailNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class NotificationService
{
    public function __construct(private MailerServiceInterface $mailerService)
    {
    }

    public function __invoke(EmailNotification $notification): void
    {
        $this->mailerService->sendEmail($notification);
    }
}
