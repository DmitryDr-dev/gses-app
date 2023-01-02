<?php

declare(strict_types=1);

namespace App\UI\Shared\Http\EventListener;

use App\UI\Shared\Http\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        switch ($exception::class) {
            case BadRequestException::class:
                $this->error(
                    event: $event,
                    statusText: Response::$statusTexts[Response::HTTP_BAD_REQUEST],
                    code: Response::HTTP_BAD_REQUEST,
                    message: $exception->getMessage(),
                );

                return;
            default:
                $this->error(
                    event: $event,
                    statusText: Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR],
                    code: Response::HTTP_INTERNAL_SERVER_ERROR,
                );
        }
    }

    private function error(ExceptionEvent $event, string $statusText, int $code, string $message = ''): void
    {
        $response = new JsonResponse(
            data: [
                'exception' => [
                    'code' => $statusText,
                    'message' => $message,
                ]
            ],
            status: $code
        );

        $event->setResponse($response);
    }
}
