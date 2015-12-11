<?php

namespace App\Handlers;

use Exception;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Body;

class Error
{
    private $displayErrorDetails;
    private $logger;

    function __construct($displayErrorDetails = false, LoggerInterface $logger) {
        $this->displayErrorDetails = $displayErrorDetails;
        $this->logger = $logger;
    }

    /**
     * Invoke error handler
     *
     * @param ServerRequestInterface $request   The most recent Request object
     * @param ResponseInterface      $response  The most recent Response object
     * @param Exception              $exception The caught Exception object
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Exception $exception)
    {
        $output = $this->renderJsonErrorMessage($exception);

        $body = new Body(fopen('php://temp', 'r+'));
        $body->write($output);

        return $response
                ->withStatus(500)
                ->withHeader('Content-type', 'application/json')
                ->withBody($body);
    }

    /**
     * Render JSON error
     *
     * @param  Exception $exception
     * @return string
     */
    protected function renderJsonErrorMessage(Exception $exception)
    {
        $error = [
            'message' => 'Slim Application Error',
        ];

        if ($this->displayErrorDetails) {
            $error['exception'] = [];

            do {
                $error['exception'][] = [
                    'type' => get_class($exception),
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => explode("\n", $exception->getTraceAsString()),
                ];
            } while ($exception = $exception->getPrevious());
        }

        $this->logError($error);

        return json_encode($error, JSON_PRETTY_PRINT);
    }

    private function logError($errors) {
        $output = $errors['message'] . "\n";

        if ($this->displayErrorDetails) {
            foreach ($errors['exception'] as $error) {
                $output .= "\t" . $error['type'] . ' - ';
                $output .= "Code: " . $error['code'] . " - ";
                $output .= 'Message: ' . $error['message'] . "\n";
                $output .= "\tLine: " . $error['line'] . ' - ';
                $output .= $error['file'] . "\n";
                $output .= "\tTrace: \n";

                foreach ($error['trace'] as $value) {
                    $output .= "\t\t" . $value . "\n";
                }
            }
        }

        $this->logger->error($output);
    }
}
