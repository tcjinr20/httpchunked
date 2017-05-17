<?php
//set headers 火狐
header('Content-Type: text/html;charset=UTF-8');
header('Transfer-Encoding: chunked');
header('Keep-Alive: timeout=15, max=100');
header('Connection:Keep-Alive');
header('Content-Encoding: gzip');

define('SUBLEN',1000);

function chunk($str){
    if(strlen($str)>SUBLEN){
        $op = substr($str,0,SUBLEN);
        echo dechex(strlen($op))."\r\n".$op."\r\n";
        ob_flush();
        flush();
        chunk(substr($str,SUBLEN));
    }else{
        echo dechex(strlen($str))."\r\n".$str."\r\n0\r\n\r\n";
        ob_flush();
        flush();
    }
}

$sg= file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/test/h.php');
$sg= gzencode($sg);
chunk($sg);
?>

