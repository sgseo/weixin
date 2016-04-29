<?php

  $CUR_PATH =getcwd().'\\';
  echo "\n====$CUR_PATH\n";
	require_once($CUR_PATH .'..\\dbfunction.php');  
  require_once($CUR_PATH.'..\\xiaoifunc.php');
  
  require_once('main.php');
  
echo "\n<pre>".$_REQUEST['msgtype'];
echo "\n sender:".$_REQUEST['sender'];
echo "\n message:".$_REQUEST['message'];
echo "\n weixin:".$_REQUEST['weixin'];
 
 if($_REQUEST['sum']!='sunbaoliang') exit('·Ç·¨ÇëÇó');
 
 $mail['sid'] = strtoupper($_REQUEST['weixin']);
 $mail['message'] = $_REQUEST['message'];
 $mail['sender'] = $_REQUEST['sender'];
 $mail['type'] = strtolower($_REQUEST['msgtype']);
 if(!$mail['type'])$mail['type'] = strtolower($_REQUEST['type']);
 $mail['updatetime'] = time();
 
 $sony = new sony();
 
 
 echo  $sony->savemail($mail);
 
   
   
?>
 