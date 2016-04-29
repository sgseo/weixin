<?php

 error_reporting(E_ALL & ~E_NOTICE); 

require('../HTTP.php');
//$_REQUEST['querysign'] = '2115791462,676461655';

$querysign = $_REQUEST['querysign'];
$url = $_REQUEST['url'];
$parm['Referer']='http://stu.baidu.com/i?ct=3&tn=faceresult&rn=10&querysign='.$querysign.'&stt=1&size_filter=-1';
$parm['Cookie'] = $_REQUEST['cookie'];

$buf = http_request($url,$parm);
//echo $parm['Cookie']
 header('Content-Type: image/jpeg');

echo HTTP_body($buf);
?>