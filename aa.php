<?php
exec("netstat -ano|findstr 192.168.1.8:8000",$out);
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
print_r($b);