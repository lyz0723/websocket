<?php
/*exec("netstat -ano|findstr 192.168.1.97:8000",$out);
$a=explode(' ',$out[0]);
$arr=array();
foreach($a as $k=>$v){
    if($v==''){
        unset($a[$k]);
    }else{
        $arr[]=$v;
    }
}
$pid=$arr[4];
exec("taskkill /pid $pid -f",$b);
print_r($b);*/

$port        =    6379;//$config['port'] ? $config['port'] : 6379;
$host        =    '127.0.0.1';
$timeout = 30;
$redis = new Redis();
$redis->connect($host, $port, $timeout);
$redis->set('liyanzhao','23');
echo $redis->get('liyanzhao');