<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/18
 * Time: 9:12
 */
$ws_server = new Swoole\WebSocket\Server('127.0.0.1', 9502);
print_r($ws_server);
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
//$redis->flushAll();exit;

$ws_server->on('open', function ($ws, $request) use ($redis) {
    $redis->sAdd('fd', $request->fd);
});

$ws_server->on('message', function ($ws, $frame) use ($redis) {
    global $redis;
    $fds = $redis->sMembers('fd');
    foreach ($fds as $fd){
        $ws->push($fd,$frame->fd.'--'.$frame->data);
        //发送二进制数据：
        $ws->push($fd,file_get_contents('http://imgsrc.baidu.com/imgad/pic/item/267f9e2f07082838b5168c32b299a9014c08f1f9.jpg'),WEBSOCKET_OPCODE_BINARY);
    }
});

//监听WebSocket连接关闭事件
$ws_server->on('close', function ($ws, $fd) use ($redis) {
    $redis->sRem('fd',$fd);
});

$ws_server->start();