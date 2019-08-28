<?php declare(strict_types=1);

namespace App\Exception\Handler;

use const APP_DEBUG;
use function get_class;
use ReflectionException;
use function sprintf;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Swoft\Log\Helper\CLog;
use Swoft\Log\Helper\Log;
use Swoft\Whoops\WhoopsHandler;
use Throwable;

/**
 * Class HttpExceptionHandler
 *
 * @ExceptionHandler(\Throwable::class)
 */
class HttpExceptionHandler extends AbstractHttpErrorHandler
{
    /**
     * @param Throwable $e
     * @param Response $response
     * @return Response
     * @throws ContainerException
     * @throws ReflectionException
     * @throws \Swoft\Exception\SwoftException
     */
    public function handle(Throwable $e, Response $response): Response
    {
        $request = context()->getRequest();
        // Log
        Log::error($e->getMessage());
        CLog::error($e->getMessage());

        // Debug is false
        if (!APP_DEBUG) {
            return $response->withStatus(500)->withContent(
                sprintf(' %s At %s line %d', $e->getMessage(), $e->getFile(), $e->getLine())
            );
        }

        $data = [
            'code'  => $e->getCode(),
            'error' => sprintf('(%s) %s', get_class($e), $e->getMessage()),
            'file'  => sprintf('At %s line %d', $e->getFile(), $e->getLine()),
            'trace' => $e->getTraceAsString(),
        ];

        // Debug is true
//        $whoops  = bean(WhoopsHandler::class);
//        $content = $whoops->run($e, $request);
//        return $response->withContent($content);

        // Debug is true
        return $response->withData($data);
    }
}
