<?php
/**
 * User: polly
 * Date: 2017/5/6
 * Time: 9:36
 *
 */

function spl($st,$len=300,$g=false){
    if(strlen($st)>$len){
        $ss = substr($st,0,$len);
        if($g)$ss=gzencode($ss);
        echo dechex(strlen($ss))."\r\n";
        echo $ss;
        echo "\r\n";
        ob_flush();
        flush();
        spl(substr($st,$len),$len);
    }else{
        echo dechex(strlen($st))."\r\n";
        echo $st;
        echo "\r\n";
        echo "0\r\n\r\n";
        ob_flush();
        flush();
    }
}
header('Content-Type: text/html;charset=UTF-8');
header("Transfer-Encoding: chunked");
header('Keep-Alive: timeout=15, max=100');
header('Connection:Keep-Alive');
header('Content-Encoding: gzip');

$ah= file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/test/h.php');
spl($ah,300,true);


