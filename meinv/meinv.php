<?php 
error_reporting(E_ALL & ~E_NOTICE);


remove_xss();
 
if($_REQUEST['showpic']) {
	html();exit;
}

if(!$EXT_CMD)
{
  getmeinv(10);
}
function getmeinv($tag)
{
	if($_REQUEST['page']) $page = $_REQUEST['page'];
	else $page = rand(0,100);
  
  if($_REQUEST['rnd']) $rnd = $_REQUEST['rnd'];
	
	$page_no = $page*30 + $rnd;
	
	$url = 'http://image.baidu.com/channel/listjson?fr=channel'
	      .'&tag1='.urlencode('美女').'&tag2='.urlencode('清纯').'&sorttype=1&pn='.($page_no).'&rn=30&ie=utf8&oe=utf-8&1368356260113';
	$buf = file_get_contents($url);
	 
	$json = json_decode($buf);
	
	$data = $json->data;
	if($tag < 5)
	{
		$rnd = rand(0,29);
	  
	  $imgurl = $data[$rnd]->obj_url;
	  //$imgurl = $data[$rnd]->image_url;
	  $title = $data[$rnd]->abs;
	  $wordx = $title .'';
	  $url = "http://biyike.scicompound.com/weixin/meinv/meinv.php?showpic=". urlencode($imgurl);
	  $GLOBALS['msg_ext'][] = array('picurl'=> $imgurl,'title'=> $title,'description'=> $wordx,'link'=> $url );
	  
	  $url = "http://biyike.scicompound.com/weixin/meinv/meinv.php?page=".$page ."&rnd=".$rnd;
	  $imgurl = $data[$rnd+1]->thumbnail_url;
	  $wordx = "点这里可以查看其余10个美女\n微信号:Cleverbot";
	  $title = $wordx;
	  $GLOBALS['msg_ext'][] = array('picurl'=> $imgurl,'title'=> $title,'description'=> $wordx,'link'=> $url );
	  
	  echo $GLOBALS;
	  return;
  }
  
  
  
  echo  htmlhead();
	
	//print_r($data);
  foreach($data as $v)
  {	
  	$imgurl = $v->obj_url;
  	//$imgurl = $v->image_url;
  	$link = $v->from_url;
	  echo "<br><img src='".	$imgurl . "' width=100%>";
	 //  echo "<br>".$v->abs;
	  $i++; if($i>20) break;
	 
	};
 echo "</body></html>";

     
}

function html(){
	echo  htmlhead();
	$url = "http://biyike.scicompound.com/weixin/reimg.php?imgurl=".$_REQUEST['showpic'] ;
	echo "<img src=$url>";
	echo "</body></html>";
	 
}
 
function htmlhead(){
	return  '<!DOCTYPE html><!--STATUS OK-->
   <html><head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.8, maximum-scale=2.0, user-scalable=yes" /> 
	<style>
		 body,dl {width:600px;word-break: break-all; word-wrap:break-word;}
		 dt,dd{float:left;display:block;}
		</style>
	<title>清纯美女</title><body>
	更多图片请加微信号:Cleverbot'
	;
}



function remove_xss(){
	foreach($_REQUEST as $k=> $v){
    $_REQUEST[$k]= htmlentities($v);
  }
}
?>