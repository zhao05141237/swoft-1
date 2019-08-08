<?php

const PKG_EOF = "\r\n\r\n";

/**
 * @param string $host
 * @param string $cmd
 * @param $data
 * @param array $ext
 * @return mixed
 * @throws Exception
 */
function request(string $host, string $cmd, $data, $ext = []) {
    $fp = stream_socket_client($host, $errno, $errstr);
    if (!$fp) {
        throw new Exception("stream_socket_client fail errno={$errno} errstr={$errstr}");
    }

    $req = [
        'cmd'  => $cmd,
        'data' => $data,
        'ext' => $ext,
    ];
    $data = json_encode($req) . PKG_EOF;
    fwrite($fp, $data);

    $result = '';
    while (!feof($fp)) {
        $tmp = stream_socket_recvfrom($fp, 1024);

        if ($pos = strpos($tmp, PKG_EOF)) {
            $result .= substr($tmp, 0, $pos);
            break;
        } else {
            $result .= $tmp;
        }
    }

    fclose($fp);
    return json_decode($result, true);
}

try{
    $ret = request('tcp://127.0.0.1:18309', 'demo.echo', 'i am a client aa cc ddd eee');
    var_dump($ret);
}catch (Exception $exception){
    echo $exception->getMessage();
}