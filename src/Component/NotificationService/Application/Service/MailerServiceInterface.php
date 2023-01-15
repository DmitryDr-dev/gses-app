<?php

declare(strict_types=1);

namespace App\Component\NotificationService\Application\Service;

use App\Component\MailerService\Application\Service\Notification\EmailNotification;

interface MailerServiceInterface
{
    public function sendEmail(EmailNotification $notification): void;
}
