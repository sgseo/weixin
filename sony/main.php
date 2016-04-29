<?php

	require_once('dbfunction.php');  
  require_once('xiaoifunc.php');

class sony{
	
public function init()
{//set user talkid ='sony'
  $us = getuserinfo(); //parent function
  $us['talkid']='sony'; 
  saveuserinfo($us);
   
  $myid = $this->makeid();
 
  return "\n___sony菜单[爱你]:___\n(sony mobile mail) "
             ."\n1.查询今日未处理新IM消息 "
             ."\n2.查询今日新到邮件 "
             ."\n3.查询今日会议,日程  "
             ."\n4.查询明日会议,日程 "
             ."\nx.退出"
             ."\n[ID]: " . $myid ."\n";
	
}
function  cmd($EXT_MSG)
{
	$sus = $this->getuserinfo();
	$sid = $sus['sid'];
	
	$cmdid = trim($EXT_MSG);
	if($cmdid==1)
	{$container = " `type`='im' ";
	 $mesagename='最近未处理communicator';
	}
	if($cmdid==2)
	{$container = " `type`='mail' ";
	 $mesagename='今日未处理邮件';
	}
	if($cmdid==3)
	{$container = " `type`='reminder' ";
	 $mesagename='今日会议日程';
	}	
	if(strtolower($cmdid)=='x')
	{
		return $this->deinit('sony mail');
	}	
	
	
	$container .= " and `sid`='" .$sid."' ";
	$container .= " order by updatetime desc ";
	//echo $container;
	$rlt = db_read_array('sonydata',array(),$container);
	
	foreach($rlt as $v)
	{
		$j++;
		$msgT = substr($v['message'],0,40);
		$msgT = iconv('utf-8','gbk',$msgT);$msgT = iconv('gbk','utf-8',$msgT);
		$msg .= "\n" .$j .'. '. $msgT . date("(H:i)",$v['updatetime']);
	}
	
	return $mesagename .$msg;
}
function  deinit($EXT_MSG)
{
	$us = getuserinfo(); //parent function
  $us['talkid']=''; 
  saveuserinfo($us);
	return '已经退出' . $EXT_MSG;
}

private  function makeid()
{
	$sus = $this->getuserinfo();
	if($sus['sid'])
	return $sus['sid'];
	
	$count = db_count('sonyuser');
	$id = $this->decto36($count+1);
	
	$sum =	$this->decto36(rand(0,46655)); 
	 
	if(strlen($sum)< 2) $sum = '00'.$sum;	
	if(strlen($sum)< 3) $sum = '0'.$sum;	
	
	$sus['sid']=$id.$sum; 
	$this->saveuserinfo($sus);
	return $sus['sid'];
}



private  function  getuserinfo()
{
   $container = " `sessionid`='" . $GLOBALS['session_user'] ."'";
	 
   $rlt = db_read_array('sonyuser',array(), $container);
      
   if(count($rlt)>0)
     return current($rlt);
   else
     return ;	
}
private  function saveuserinfo($userdb)
{	 
  $userdbx = $this->getuserinfo();
  foreach($userdb as $k => $v)
  {
  	$userdbx[$k] = $v;
  }
  $userdbx['sessionid'] = $GLOBALS['session_user'];
  $userdbx['lasttalktime'] = time();
  db_write('sonyuser',$userdbx);
	
}

function savemail($mail)
{	 
    
   $container = " `sid`='" . $mail['sid'] ."'";	 
   $rlt = db_read_array('sonyuser',array(), $container);      
   if(count($rlt)>0)
   {;}
   else
   {return '[[MAIL_NO_RECEIVER]]错误的ID';} ;
     
   
  
  db_write('sonydata',$mail);
	return '[[MAIL_OK]]';
}


private function decto36($num)
{  
  $num_char= "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  while($num)
  { $p = substr($num_char,$num % 36,1).$p;
 	  $num = floor($num/36);
 	
 	} 
 	//echo "\n==$p==";
  return $p;
}
}
?>