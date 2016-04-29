<!DOCTYPE html><!--STATUS OK-->
<html><head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
	<style>
		 body,dl {width:600px;word-break: break-all; word-wrap:break-word;}
		 dt,dd{float:left;display:block;}
		</style>
	<title><?=$_REQUEST['q'] ?></title><body>
<!--	<a href="weixin://qr/gh_5f14e9a94323" target=hid>加cleverbot为好友</a><a href=# onclick='addFirend();'>无限查询菜谱</a><iframe src='about:blank' name=hid ></iframe>

<script >
		function addFirend(){
 
//gh_122a2ee67fae 为被添加者的微信ID
 
WeixinJSBridge.invoke("addContact", {webtype: "1",username: 'gh_5f14e9a94323'}, function(e) {
            WeixinJSBridge.log(e.err_msg);
            //e.err_msg:add_contact:added 已经添加
            //e.err_msg:add_contact:cancel 取消添加
            //e.err_msg:add_contact:ok 添加成功
            if(e.err_msg == 'add_contact:added' || e.err_msg == 'add_contact:ok'){
                //关注成功，或者已经关注过
            }
        })
}
</script>
-->
<?php

  error_reporting(E_ALL & ~E_NOTICE);

/*
define('SHOW_DEBUG_MSG',1);
require_once('HTTP.php');
	//$para['Accept-Encoding']='identity';
	$para['ext']['httpver']='1.0';
	$buf = http_request($url,$para);
	$buf = HTTP_body($buf);
	
	echo $url;
  //$url ='qn.html';

*/

  $word = $_REQUEST['q'];
  $word = iconv('utf-8','gbk',$word);
  
  if($word=='all')
  {
  	showallrecipes();
  	exit;  	
  }
  
  
  $id = $_REQUEST['id'];
  $fenlei =  $_REQUEST['fenlei'];
  $url = 'http://baike.baidu.com/list-php/dispose/searchword.php?word=' . urlencode($word).'&pic=1';
 
  if($fenlei)
  {  
    $url = 'http://baike.baidu.com/fenlei/'.$fenlei;
  } 
 // $id='864280.htm';
  if($id)
  { //$p=strpos($id,'.');
  	//if($p < 1) return;
  	//$id=substr($id,$p-1);
    $url = 'http://baike.baidu.com/view/' .$id;
  } 
 

 // $url='http://baike.baidu.com/list-php/dispose/searchword.php?word=%BB%D8%B9%F8%C8%E2&pic=1';
//echo $url.']'; exit;

  if($word)
  { $buf = file_get_contents($url);

	  $p = strpos($buf,"http-equiv='Refresh'");
	  if($p < 1) return;
	  
	  $p = strpos($buf,"/view/");
	  $p2 = strpos($buf,"'",$p);  
	  $url ='http://baike.baidu.com'. substr($buf,$p,$p2-$p);
  }

//echo $url; exit;
//$url ='qn.html';
 $buf = file_get_contents($url);

  
  
  
  $p =strpos($buf,'<div id="page"><');
  $p2 =strpos($buf,'<span class="related_edit">',$p);
  if($p2 < 1)
  $p2 =strpos($buf,'开放分类',$p);
  if($p2 < 1)
  $p2 = strlen($buf);
  
  $buf = substr($buf,$p,$p2-$p);
  
  
  /*$p = strpos($buf,'百度名片');
  if($p > 0){
			$p2 = strpos($buf,'"',$p);
			$imgurl = substr($buf,$p,$p2-$p);
		}
 */
    
  $buf = strtr($buf,array('http://baike.baidu.com/view/'=>'?id='));
  $ch = "abcdefghijklmnopqrstuvwxyz";
  for($i=0;$i< 26;$i++)
  { $hipdo = substr($ch,$i,1);
  	$specialUrl = 'http://'.$hipdo.'.hiphotos.baidu.com/baike/';
  	//$buf = strtr($buf,array( $specialUrl=>'reimg.php?imgpart='));
  	$buf = strtr($buf,array( $specialUrl=>'../reimg.php?imgurl='.urlencode($specialUrl)));
  	
  }
  $buf = strtr($buf,array('href=/view/'=>'href=?id='));
  $buf = strtr($buf,array('href="/view/'=>'href="?id='));
  $buf = strtr($buf,array('href="/fenlei/'=>'href="?fenlei='));  
  
  //$buf = strtr($buf,'class="nslog:1019"', 'style="display:none"'); 
  $buf = strtr($buf,array('编辑'=>''));$buf = strtr($buf,array('本段'=>''));$buf = strtr($buf,array('义项'=>''));
   
   $buf = strtr($buf,array('百科名片'=>'')); 
    $buf = strtr($buf,array('data-src="'=>' src="'));  
    $buf = strtr($buf,array('height:184px;width:240px;'=> ''));   
    $buf = strtr($buf,array('height:164px;width:220px'=> ''));         
    $buf = strtr($buf,array('<div></div>'=> ''));     
       $buf = trim($buf);  

       $buf = preg_replace('/<script[^>]*?>(.*?)<\/script>/si', '', $buf);  

       $buf = preg_replace('/<style[^>]*?>(.*?)<\/style>/si', '', $buf);  
       $buf = preg_replace('/onload=\"(.*?)\"/si', '', $buf); 
       $buf = preg_replace('/class=\"(.*?)\"/si', '', $buf); 
       $buf = preg_replace('/style=\"(.*?)\"/si', '', $buf);
       
    /*  $buf = preg_replace('/<img[^>]*?>(.*?)/si', '', $buf); */
    
       $buf = preg_replace('/<span[^>]*?><\/span>/si', '', $buf); 
        $buf = preg_replace('/<p[^>]*?>/si', '<p>', $buf);   
      $buf = preg_replace('/<div[^>]*?>/si', '<div>', $buf); 
       $buf = preg_replace('/<dl[^>]*?>/si', '', $buf);         $buf = strtr($buf,array('</dl>'=> '')); 
       $buf = preg_replace('/<dd[^>]*?>/si', '', $buf);         $buf = strtr($buf,array('</dd>'=> '')); 
  

/*
       $str = strip_tags($str,"");  

       $str = ereg_replace("\t","",$str);  

       $str = ereg_replace("\r\n","",$str);  

       $str = ereg_replace("\r","",$str);  

       $str = ereg_replace("\n","",$str);  

       $str = ereg_replace(" ","",$str);  

       $str = ereg_replace("&nbsp;","",$str);  
*/
   $REPLACEKEY = 'reimg.php?imgurl=';
   $p = strpos($buf,$REPLACEKEY);
   if($p > 0)
	 {$p2 = strpos($buf,'"',$p);
	   $p+=strlen($REPLACEKEY);
	   $imgurl = substr($buf,$p,$p2-$p);
    
			$firstimg = urldecode($imgurl);
		  echo "<img src='$firstimg' width=10 height=10>微信号:Cleverbot提供";
	 }
		 
  echo $buf ;
  
  
  function showallrecipes()
  {
  	require_once('recipes.dat.php');
  	echo '<style>a{display:inline-block;float:left;width:200px;padding:8px}</style>';
  	foreach($caipuList as $caipu)
		{
		  $j++;
		  echo " <a href='?q=".	$caipu ."'>".	$caipu ."</a>";
			if($j%2 ==0) echo "<br>";
		}
  	
  	
  }
?>

</body></html>