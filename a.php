<?php
/**
 * User: polly
 * Date: 2017/5/5
 * Time: 10:21
 */

header('Content-Type: text/html;charset=UTF-8');
header('Transfer-Encoding: chunked');
define("RN", "\r\n");

function flush_data(){
    $str=ob_get_contents();
    ob_clean();
    echo dechex(strlen($str)).RN.$str.RN;
    ob_flush();
    flush();
}

function end_data(){
echo RN;
echo "0\r\n\r\n";
ob_flush();
}

$fc = file_get_contents('./a.html');
echo $fc;
flush_data();
end_data();