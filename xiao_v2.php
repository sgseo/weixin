<?php

  error_reporting(E_ALL & ~E_NOTICE);
  
	require_once('HTTP.php');
	
 
function v2_askXiaoI($question)
{  
	$GLOBALS['XIAOI_web_process'] = '__processOpenResponse';
 
  $rlt = getNewXiaoISession();
  
  
  $data=sprintf('{"sessionId":"%s","robotId":"webbot","userId":"%s","body":{"content":"%s"},"type":"txt"}',
              $rlt->sessionId, $rlt->userId, $question);
  $GLOBALS['XIAOI_web_process'] = '_processMsg';
  $cmd =array('type'=>'_processMsg',
               'data'=> $data); 
  $msg = sendrequest($cmd);
  $msg = trim($msg);
  
	  $userinfo['cookie'] = $GLOBALS['cookie'];
	  $userinfo['xiaoitksession'] = $rlt;  
	  $userdb['v2session_cookie'] = json_encode($userinfo);  
	  saveuserinfo($userdb);
   
  
  return $msg;
  
} 
  
function getNewXiaoISession()
{
	  
	 $userdb = getuserinfo();
	  
	 if($userdb  )
	 { //echo time()-$userdb['lasttalktime'] ."\n";
	 	 if(time()-$userdb['lasttalktime'] < 5*60)
	   {
	 	   $userinfo = json_decode($userdb['v2session_cookie']);	 
	 	   //print_r($userinfo);
	 	  	  
	 	   $GLOBALS['cookie'] = $userinfo->cookie;
	 	  
	 	    // echo "\n===use old session==\n";
	 	      ieupdatecookie('cnonce=;cvisits=;sig=;');
	 	      require_once('iverify.php');
          makesigvalue();
	 	   return  $userinfo->xiaoitksession;
	 	 }
	 }
	
   $cmd =array('type'=>'__processOpenResponse',
               'data'=>'{"type":"open"}'); 
   $rlt = sendrequest($cmd);
   //$GLOBALS['cookie'] =  'XISESSIONID=kny62iw1jvu8yp3hblxnkc0;nonce=308788;Path=/';   
   require_once('iverify.php');
   makesigvalue();
    
   /*
   $cookielist = explode(';',$GLOBALS['cookie']);
   foreach( $cookielist as $c)
   {  
   	  list($k,$v) = explode('=',$c);
   	  $k =trim($k); $v = trim($v);
   	  $ie_cookie[$k] = array($k, $v);
   }
   
    $GLOBALS['cookie'] =  $ie_cookie['cnonce'][0] .'=' .$ie_cookie['cnonce'][1] .'; '
                       .  $ie_cookie['sig'][0] .'=' .$ie_cookie['sig'][1] .'; '
                       .  $ie_cookie['XISESSIONID'][0] .'=' .$ie_cookie['XISESSIONID'][1] .'; '
                       .  $ie_cookie['nonce'][0] .'=' .$ie_cookie['nonce'][1] ;
                       
    echo '==='.$GLOBALS['cookie'];
  */
	/*
	 $data=sprintf('{"type":"sessionopen","sessionId":"%s","robotId":"webbot","userId":"%s"}',
	              $rlt->sessionId, $rlt->userId);
	 //$data = json_encode($rlt);
	   
	 $GLOBALS['XIAOI_web_process'] = '_processMsg';
	  $cmd =array('type'=>'_processMsg',
	               'data'=> $data); 
	  $rlt = sendrequest($cmd);
	
	*/

  
  
 // echo "\n===new session==\n";
  return $rlt;
}

  
function sendrequest($cmd)
{
	//echo "\n[send]\n".$cmd['data'];
	list($usec, $sec) = explode(" ",microtime());
	
	$cmdline = '&callback=__webrobot' . $cmd['type'] 
	         . '&data=' . urlencode($cmd['data'])
	         . '&ts=' . $sec .substr($usec,1,3); ;
	$url = 'http://i.xiaoi.com/robot/webrobot?' . $cmdline ;
  //echo "\n".$url;
  //echo "\n[cookie_0]:".$GLOBALS['cookie'];
  $buf = http_request($url);
 // echo "\n[cookie_1]:".$GLOBALS['cookie'];
  
  return getResponse($buf);
}

function getResponse($buf)
{
	  
	$FUNC_HEAD = '__webrobot';//.$GLOBALS['XIAOI_web_process'];
	$p = strpos( $buf,$FUNC_HEAD) ;
	if($p < 1) return;
	
	
  $data = explode($FUNC_HEAD,$buf);
   // print_r($data);
     
  $j =0;
	foreach($data as $func)
	{ $j++; if($j==1){ continue;}
		$buf=trim($func);
	 // 804623111
	 if(stripos($buf,'xiaoi.com'))continue;
	 
	  if(mb_strpos($buf,'逛街有小i') > 0) continue;
	 
	  // echo "\n===\n".iconv('utf-8','gbk',$buf);
		$p=0;
		$p2 = strpos($buf,'(',$p);
		$curmsgtype = substr($buf,$p,$p2-$p);
	 
		$msgbuf = substr($buf,$p2+1,strlen($buf)-$p2-3);
		$msgObj = json_decode( $msgbuf );
		
		 
		$msgline = ' '.$msgObj->body->content;
		$p = mb_strpos($msgline,'详情');		 
		if($p >0) $msgline = mb_substr($msgline,0,$p);
		$p = mb_strpos($msgline,'右侧');		 
		if($p >0) $msgline = mb_substr($msgline,0,$p);
		
		$msgline = trim($msgline);
		if($msgline)
	   $msg = $msgline;
		
		//$msg->curmsgtype = $curmsgtype;
	 	 //	
  }
 // echo "\n=======".$msg;
  return ($msg);
}
?>