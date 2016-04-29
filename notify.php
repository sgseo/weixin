<?

	require_once('dbfunction.php');  
  require_once('xiaoifunc.php');
  
  require_once('sony/main.php');
  
echo "\n<pre>".$_REQUEST['msgtype'];
echo "\n sender:".$_REQUEST['sender'];
echo "\n message:".$_REQUEST['message'];
echo "\n weixin:".$_REQUEST['weixin'];
 
 if($_REQUEST['sum']!='sunbaoliang') exit('·Ç·¨ÇëÇó');
 
 $mail['sid'] = strtoupper($_REQUEST['weixin']);
 $mail['message'] = $_REQUEST['message'];
 $mail['sender'] = $_REQUEST['sender'];
 $mail['type'] = strtolower($_REQUEST['msgtype']);
 $mail['type'] = strtolower($_REQUEST['type']);
 $mail['updatetime'] = time();
 
 $sony = new sony();
 
 
 echo  $sony->savemail($mail);
 
   
   
?>
 