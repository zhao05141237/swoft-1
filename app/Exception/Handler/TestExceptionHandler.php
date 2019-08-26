<?php


namespace App\Exception\Handler;


use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Swoft\Log\Helper\CLog;
use Throwable;
use App\Exception\TestException;

/**
 * Class TestExceptionHandler
 * @package App\Exception\Handler
 * @ExceptionHandler(TestException::class)
 */
class TestExceptionHandler extends AbstractHttpErrorHandler
{
    public function handle(Throwable $except, Response $response): Response
    {
        // TODO: Implement handle() method.
        $data = [
            'code'  => $except->getCode(),
            'error' => sprintf('(%s) %s', get_class($except), $except->getMessage()),
            'file'  => sprintf('At %s line %d', $except->getFile(), $except->getLine()),
            'trace' => $except->getTraceAsString(),
        ];

        CLog::error($except->getMessage());

        $result = $response->withStatus(404)->withData($data);

        return $result;
    }


}