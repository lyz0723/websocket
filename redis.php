<?php
    $port        =    6379;//$config['port'] ? $config['port'] : 6379;
    $host        =    '127.0.0.1';
    $timeout = 30;
    $redis = new Redis();
    $redis->connect($host, $port, $timeout);
    $redis->set('liyanzhao','23');
    echo $redis->get('liyanzhao');
?>