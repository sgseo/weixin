<!DOCTYPE html><!--STATUS OK-->
<html><head>
	<!--meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.8, maximum-scale=4.0, user-scalable=yes" /--> 
	<meta name="viewport" content="width=650" /> 
	<style>
	body{width:100%;margin:0px;padding:10px;font-size:32px}
	li{width:160px;height:160px;overflow:hidden;float:left}
	ul{margin:0px;padding:0px;  }
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>看与我长得像的人</title>
</head><body>
 	<div style='width:100%;height:60px'>截个图分享给好友吧,微信号<span style="color:red;font-family:'黑体';"><b>Cleverbot</b></span></div>
<?php

   require_once('myfunction.php');
   $faceurl = $_REQUEST['myface'];
   $jsonX =  getsimilar($faceurl);
   
   $json=$jsonX->json;
   $myfaceurl=$jsonX->myface;
   $cookie= $jsonX->cookie;
   $querysign=$jsonX->querysign  ;

?>
<div>
<ul><li style='border:2px solid #f00; overflow:hidden;width:310px;height:310px'><img src='<?=$myfaceurl?>' width=100%></li>
<?




foreach($json->data as $img)
{ $picurl = $img->faceURL;
	if(strlen($picurl) < 5) continue;
	
	$url ='img.php?url='.urlencode($picurl).'&querysign='.$querysign .'&cookie='.$cookie;
	echo '<li><img src="'.$url.'" width=100%></li>';
	
}
?>
</ul></div>

<?
echo "<div style='clean:both;width:100%;height:20px'>&nbsp<a href=show.php?myface=".$faceurl."&pagenum=".($pagenum+50)."><b>下一页</b></a></div>";



?>