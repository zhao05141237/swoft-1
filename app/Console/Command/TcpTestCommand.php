<?php


namespace App\Console\Command;

use Swoft\Console\Annotation\Mapping\Command;
use Swoft\Console\Annotation\Mapping\CommandMapping;
use Swoft\Console\Input\Input;
use Swoft\Console\Output\Output;
use Swoft\Tcp\Protocol;
use Swoole\Coroutine\Client;

/**
 * @Command()
 * Class TcpTestCommand
 * @package App\Console\Command
 */
class TcpTestCommand
{
    /**
     * @CommandMapping()
     * @param Input $input
     * @param Output $output
     */
    public function tcpTest(Input $input, Output $output)
    {
        $proto = new Protocol();

        var_dump($proto->getConfig());

        $host = '127.0.0.1';
        $port = 18309;

        $client = new Client(SWOOLE_SOCK_TCP);
        $client->set($proto->getConfig());

        if(!$client->connect((string)$host,(int)$port,5)){
            $code = $client->errCode;
            $msg = socket_strerror($code);
            $output->error("Connect server failed.Error($code):$msg");
        }

        $msg = $output->read('<info>client</info>> ');

        if(false == $client->send($proto->packBody($msg))){
            $code = $client->errCode;
            $msg = socket_strerror($code);
            $output->error("send data failed.Error($code):$msg");
        }

        $res = $client->recv(2.0);

        if(false == $res){
            $code = $client->errCode;
            $msg = socket_strerror($code);
            $output->error("recv data failed.Error($code):$msg");
        }

        if ($res === '') {
            $output->info('Server closed connection');
            return;
        }

        [$head,$body] = $proto->unpackData($res);

        $output->prettyJSON($head);
        $output->writef('<yellow>server</yellow>> %s', $body);
    }
    

}