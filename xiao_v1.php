<?php

  error_reporting(E_ALL & ~E_NOTICE);
  
 
	require_once('HTTP.php');

function v1_askXiaoI($question)
{   $GLOBALS['cookie']='';
		$url = 'http://nlp.xiaoi.com/robot/demo/wap/';
		$buf = http_request($url);
		// echo $buf;
		
		// echo '<hr>';
		
		
	//	$GLOBALS['cookie'] = 'XISESSIONID=1l0s93oikmcir1khmetkx2ih6h; nonce=384655';
			require_once('iverify.php');
		  makesigvalue();
		 
	  //echo $GLOBALS['cookie']; 
		
		$url = 'http://nlp.xiaoi.com/robot/demo/wap/wap-demo.action';
		$para['ext']['content'] ='requestContent=' . $question;
		$buf = http_request($url,$para);
		
	//	echo $buf;
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
  
?>