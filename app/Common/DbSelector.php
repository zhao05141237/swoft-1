<?php declare(strict_types=1);


namespace App\Common;


use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Console\ConsoleContext;
use Swoft\Db\Connection\Connection;
use Swoft\Db\Contract\DbSelectorInterface;

/**
 * Class DbSelector
 *
 * @since 2.0
 *
 * @Bean()
 */
class DbSelector implements DbSelectorInterface
{
    /**
     * @param Connection $connection
     * @throws \Swoft\Exception\SwoftException
     * @throws \Throwable
     */
    public function select(Connection $connection): void
    {
        $context = context();

        if ($context instanceof ConsoleContext) {
            $selectIndex = $context->getInput()->get('index', 0);
        } else {
            $selectIndex = $context->getRequest()->query('index', 0);
        }

        $createDbName = $connection->getDb();

        if ($selectIndex == 0) {
            $selectIndex = '';
        }

        $dbName = sprintf('%s%s', $createDbName, (string)$selectIndex);
        $connection->db($dbName);
    }
}
