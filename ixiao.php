<?php

  error_reporting(E_ALL & ~E_NOTICE);
  
  require_once('xiaoifunc.php');
  
/*  $GLOBALS['session_user'] = 'xxx';
  $_REQUEST['q'] ='xx';
 */ 
  $question = trim($_REQUEST['q']);
  
  //$question = '你是谁';
  
if($question)
$rlt = XiaoI($question);
 
if($IS_XIAOI_INCLUDE) return $rlt;
else echo $rlt;






function XiaoI($question)
{
	 $msg = XiaoIdo($question);
	 $rpname = array('Xiao i'=>'娃娃',
                 '小i'=>'娃娃',
                 '小i机器人'=>'娃娃',
                 'xiaoi'=>'娃娃');
   $msg = strtr($msg,$rpname);
 
   return $msg;
	
}
function XiaoIdo($question)
{
	$spxQ = specialWord($question);
	if($spxQ) return $spxQ;
	
	
	require_once('HTTP.php');
	
	$url = 'http://nlp.xiaoi.com/robot/demo/wap/';
  $buf = http_request($url);
 // echo $buf;
  
  // echo '<hr>';
 

 //$GLOBALS['cookie'] = 'XISESSIONID=1l0s93oikmcir1khmetkx2ih6h; nonce=384655';
  	require_once('iverify.php');

   $GLOBALS['cookie'] = strtr($GLOBALS['cookie'], array('xx_cookie_end=xx_end;'=>''));
// echo $GLOBALS['cookie']; 
 
  $url = 'http://nlp.xiaoi.com/robot/demo/wap/wap-demo.action';
  $para['ext']['content'] ='requestContent=' . $question;
    $buf = http_request($url,$para);
 
 //OK
 $p = strpos($buf,'<p class="wap_cn2"><span>');
 if($p < 1) return '...';
 $p = strpos($buf,'</span>',$p)+7;
 $p2 = strpos($buf,'</p>',$p);
 
 //echo $buf;
 $msg = substr($buf,$p,$p2-$p);
 //$msg = iconv('utf-8','gbk',$msg);

 
  
 // file_put_contents('qn.html',$msg);
  return  trim($msg);
} 

function specialWord($q)
{  //echo 'ddddd';
	
	 require_once('recipes.php');
  	$as = caipuCheck($q);
	 if($as) return $as;
 	 
 	 
 	 if (preg_match("/看(.*?)话/", $q)) {
     return '我有健忘症，马上就忘记了, 没人知道我们说什么';
   }
   
   require_once('special.php');
   foreach($specailword as $ask => $AS)
   {   	
   	  if (preg_match($ask, $q)) {
       return  '.' . getrndAnswer($AS);
     }
   }
    
   if($GLOBALS['session_reply']) return $GLOBALS['session_reply'];
}

?>