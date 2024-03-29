<?php

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9501);

$serv->set([
    'worker_num' => 8,      //worker进程数 cpu  1-4
    'max_request' => 10000,
]);

//监听连接进入事件
/**
 * $fd 客户端连接的唯一表示
 */
$serv->on('connect', function ($serv, $fd,$reactor_id) {
    echo "设备接入Client:{$reactor_id} - {$fd}-Connect.\n";
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $reactor_id, $data) {
    $serv->send($fd, "发起事件Server: {$reactor_id} - {$fd}".$data);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start();