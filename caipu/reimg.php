<?
require_once('../HTTP.php');
$url="http://a.hiphotos.baidu.com/baike/" . $_GET['imgpart'];
$para['Referer'] = 'http://a.hiphotos.baidu.com/baike/';
$para['Host'] = 'a.hiphotos.baidu.com';
$body= http_request($url,$para);
$body  = HTTP_body($body);
header('Content-Type: image/jpeg');

echo $body;
//http://a.hiphotos.baidu.com/baike/s%3D220/sign=4aca63951bd5ad6eaef963e8b1ca39a3/8b82b9014a90f603eb5cc4163912b31bb151edf7.jpg
//http://biyike.scicompound.com/weixin/caipu/reimg.php?imgpart=s%3D220/sign=4aca63951bd5ad6eaef963e8b1ca39a3/8b82b9014a90f603eb5cc4163912b31bb151edf7.jpg

?>