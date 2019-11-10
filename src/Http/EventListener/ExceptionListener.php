<?php

namespace App\Http\EventListener;

use App\Http\Exception\AppException;
use App\Http\ParamConverter\RequestObjectPayloadException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * ExceptionListener constructor.
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();

        $responseArr = [];
        if (getenv('APP_DEBUG')) {
            $responseArr = [
                'trace' => $exception->getTraceAsString(),
            ];
        }

        if ($exception instanceof RequestObjectPayloadException) {
            $requestObject = $exception->getRequestObject();
            $errors = $exception->getErrors();
            $event->setResponse($requestObject->getErrorResponse($errors));
            $this->logger->info('RequestObjectPayloadException: ' .
                $requestObject->getErrorResponse($errors)->getContent());
            return;
        }

        if ($exception instanceof NotFoundHttpException) {
            $message = $exception->getMessage();
            $event->setResponse(new JsonResponse(array_merge([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => $message,
            ], $responseArr), Response::HTTP_NOT_FOUND));
            $this->logger->info('NotFoundHttpException: ' . $message);
            return;
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $message = $exception->getMessage();
            $event->setResponse(new JsonResponse(array_merge([
                'code' => Response::HTTP_METHOD_NOT_ALLOWED,
                'message' => $message
            ], $responseArr), Response::HTTP_METHOD_NOT_ALLOWED));
            $this->logger->info('MethodNotAllowedHttpException: ' . $message);
            return;
        }

        if ($exception instanceof AppException) {
            $message = $exception->getMessage();
            $code = $exception->getCode();

            $event->setResponse(new JsonResponse(array_merge([
                'code' => $code,
                'message' => $message,
            ], $responseArr), $code));
            $this->logger->info('AppDomainException: ' . $message);
            return;
        }
    }
}
