<?php

  error_reporting(E_ALL & ~E_NOTICE);
  mb_internal_encoding("UTF-8");
  date_Default_TimeZone_set("PRC");
  
  require_once('dbfunction.php');  
  require_once('xiaoifunc.php');

  require_once('HTTP.php');
  require_once('special.php');
  
  	
/*  $GLOBALS['session_user'] = 'xxx';
  $_REQUEST['q'] ='xx';
 */ 
  $question = trim($_REQUEST['q']);
  
  if(!$IS_XIAOI_INCLUDE) //测试时
  { $question = '改图=11=不要的男人';
  	$question = 'hello';
    $GLOBALS['session_user'] = '00000x19';
    v2chatstatclr();
  }

$rlt = callCMSAPP($question);

if(!$rlt)
$rlt = XiaoI($question);
 
 
if($IS_XIAOI_INCLUDE) return $rlt;
else echo iconv('utf-8','gbk',$rlt);






function XiaoI($question)
{  
	 $us = getuserinfo();
	 if(is_array($us) && strpos('--'.$question,'改名')< 1) 	
	 { $question = str_replace($us['petname'],"xiaoi", $question);
	 }
	 if(time()-$us['lasttalktime'] > 10*3600 && $us['lasttalktime'] > 10)
   {
   	  $addinAD = true;   	 
   }
	 
	 $msg = XiaoIdo(trim($question));
	 $msg = trim($msg);
  
  
   	 
   if($addinAD ) $msg .= AD_msg();
 
  
   //$msg = replaceSpxWords($msg);
   $msg = specialAnswer($msg);
  
 
	 saveuserinfo(array()); //update time
	 	 
	 return $msg;
}
function XiaoIdo($question)
{
	$msg = specialWord($question);	

	if($msg) return $msg;
	
  //if(strpos('--'.$question,'#')>0)
   require_once('xiao_v2.php');
  
   $msg = v2_askXiaoI($question);
   if(strlen($msg) < 1)
   {   
   	  v2chatstatclr();
      $msg = v2_askXiaoI($question);
   }
   
   if(strlen($msg) < 1)
   { require_once('xiao_v1.php');
   	 $msg = '.'.v1_askXiaoI($question);
   }
   /*
   if($msg =='...')
   { v2chatstatclr();
     $msg = v2_askXiaoI($question);
   }*/
   
 
   
	 return $msg;
   
} 

function specialWord($q)
{  //echo 'ddddd';
	
	    
   $msg = checkSpecial($q);   
   if($msg) return $msg;
   
   require_once('caipu/recipes.php');
  	$as = caipuCheck($q);
	 if($as) return $as;
   
    $as =  require_once('sony/ets.php');  	 
	 if(strlen($as) > 3) return $as;
   
   
   if($GLOBALS['session_reply']) return $GLOBALS['session_reply'];
}


//定制服务
function callCMSAPP ($q){
	 
	if(preg_match('/^[a-zA-Z0-9]{3,12}$/',$q))
	{
		 $isAPPcmd = true;
		 /*根据本命令，判断该功能所在的url*/
	}
	if( preg_match('/^[a-zA-Z0-9]{1}$/',$q))
	{ $isAPPcmd = true;
	  /*
 	  检查用户当前所在app
 	  然后决定发送给哪个app的url
 	 */
	}
  if($isAPPcmd)
 	{$url='http://biyike.scicompound.com/wxcms/index.php?act=weixin'
      .'&wxopenid='.$GLOBALS['session_user']
      .'&usermsg='. $q;
   //file_put_contents('cmsapp.log.txt',"\nask:".$q,FILE_APPEND);
	 $buf = file_get_contents($url);
	 $json = json_decode($buf);
	 $answer = $json->answer;
	 //file_put_contents('cmsapp.log.txt',"\nans:".$answer,FILE_APPEND);
	 
	 if($json->msg=='yes')
   return $answer;
 }
 
 
	
}

?>