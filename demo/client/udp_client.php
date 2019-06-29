<?php

$client = new swoole_client(SWOOLE_SOCK_UDP);

if(!$client->connect('127.0.0.1',9502)){
    echo '连接失败';
}

//php cli常量
fwrite(STDOUT,"请输入消息");

$msg = trim(fgets(STDIN));

//发送消息给 tcp server服务器

$client->send($msg);


$result = $client->recv();

echo $result;