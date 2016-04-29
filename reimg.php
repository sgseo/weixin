<?
 error_reporting(E_ALL & ~E_NOTICE);
 
header('Content-Type: image/jpeg');

//echo file_get_contents($_GET['imgurl']);
if(stripos($_GET['imgurl'],'ttp://') > 0)
readfile($_GET['imgurl']);

/*
require_once('HTTP.php');

$url="http://a.hiphotos.baidu.com/baike/" . $_GET['imgpart'];
$urlx = parse_url($url);

$para['Referer'] = 'http://'.$urlx['host']; //'http://a.hiphotos.baidu.com/baike/';
$para['Host'] = $urlx['host'];
$body= http_request($url,$para);
$body  = HTTP_body($body);
header('Content-Type: image/jpeg');

echo $body;
//http://a.hiphotos.baidu.com/baike/s%3D220/sign=4aca63951bd5ad6eaef963e8b1ca39a3/8b82b9014a90f603eb5cc4163912b31bb151edf7.jpg
//http://biyike.scicompound.com/weixin/caipu/reimg.php?imgpart=s%3D220/sign=4aca63951bd5ad6eaef963e8b1ca39a3/8b82b9014a90f603eb5cc4163912b31bb151edf7.jpg
*/
?>