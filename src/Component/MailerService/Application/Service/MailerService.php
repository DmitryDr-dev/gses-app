<?php

declare(strict_types=1);

namespace App\Component\MailerService\Application\Service;

use App\Component\MailerService\Application\Service\Notification\EmailNotification;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\BodyRendererInterface;
use App\Component\NotificationService\Application\Service\MailerServiceInterface;

class MailerService implements MailerServiceInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private BodyRendererInterface $renderer,
        private string $senderAddress,
    ) {
    }

    public function sendEmail(EmailNotification $notification): void
    {
        $email = (new TemplatedEmail())
            ->from($this->senderAddress)
            ->to($notification->getRecipient()->getEmail())
            ->subject($notification::SUBJECT)
            ->htmlTemplate($notification::TEMPLATE)
            ->context($notification->getOptions());
        $this->renderer->render($email);

        $this->mailer->send($email);
    }
}
