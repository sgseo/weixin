<?php

if(is_file('../HTTP.php'))
require_once('../HTTP.php');
else
require_once('HTTP.php');

function getsimilar($faceurl)
{
 /*$rnd = time().'_'.rand(0,1000);
 $tmp = "tmp/face/".$rnd.".jpg";
  file_put_contents($tmp,file_get_contents($faceurl)); 
 $faceurl = 'http://biyike.scicompound.com/weixin/' .$tmp;
  $faceurl = 'http://biyike.scicompound.com/weixin/tmp/face/1379839793_426.jpg';

 //$faceurl = 'http://g.search.alicdn.com/img/bao/uploaded/i4/i3/15385022918345355/T1lTOmXDVbXXXXXXXX_!!0-item_pic.jpg_310x310.jpg';
//echo $faceurl;
*/
$pagenum = floor($_REQUEST['pagenum']);

$url = 'http://stu.baidu.com/i?objurl='.urlencode($faceurl).'&tn=faceresult&stt=1&rt=0&nojump=1&ct=1&rn=10&';
$url = 'http://stu.baidu.com/i?objurl='.urlencode($faceurl).'&filename=&rt=0&rn=10&ftn=searchimage&ct=1&stt=0&tn=baiduimagepc';



$myfaceurl = 'myfaceurl.php?url='.urlencode($url);

 
$GLOBALS['HTTP_NO_REDIRECT'] = 'yes';
//echo $url;
$parm['ext']['httpver']='1.0';
$parm['Accept-Encoding']='deflate';
$buf = http_request($url,$parm);
$newurl = trim(findBetween($buf,'Location: ',"\n"));

//$newurl = $GLOBALS['HTTP_REDIRECT']; 
$urlx = parse_url ($newurl ); 
parse_str($urlx['query'],$par); 
$querysign =$par['querysign'];
 
// $buf=iconv('utf-8','gbk',$buf);

 

/*
http://stu.baidu.com/i?nojump=1&ct=1&rn=10&objurl=http://g.search.alicdn.com/img/bao/uploaded/i4/i5/T11K1VXl0tXXaYX1U4_052548.jpg_310x310.jpg&tn=faceresult&stt=1&rt=0

http://stu.baidu.com/i?ct=3&tn=faceresult&rn=10&querysign=664570862,3032070308&stt=1&size_filter=-1


http://stu.baidu.com/i?ct=3&tn=facejson&rn=60&querysign=664570862,3032070308&stt=1&size_filter=-1&sign=664570862,3032070308&pn=0&536035987312.1943&787950511193.9479
*/

$url = 'http://stu.baidu.com/i?ct=3&tn=facejson&pn='.($pagenum).'&rn=50&querysign='.$querysign.'&sign='.$querysign.'&120925743968.79402&1345175946821.5527';

$buf = file_get_contents($url);

 
$json = json_decode($buf);

$jsonX->json = $json;
$jsonX->myface = $myfaceurl;

$p =strpos($GLOBALS['cookie'],';');
$cookie = substr($GLOBALS['cookie'],0,$p+1);
$jsonX->cookie=$cookie;

$jsonX->querysign = $querysign;

return $jsonX;

}


function findBetween($buf,$k1='',$k2='',$off=0)
{   
		if($k1=='') $p1=0;
		else $p1 = mb_strpos($buf,$k1,$off );	
		
		if($k2=='')$p2=strlen($buf);
		else $p2 = mb_strpos($buf, $k2,$p1 + mb_strlen($k1) );	

    
		if(
		    (($k1 && $p1 > 0 ) || $k1=='' )
		 && $p2 > $p1)
		{
			$p1+=mb_strlen($k1);
		  return mb_substr($buf,$p1,$p2-$p1);	
		}
}
?>