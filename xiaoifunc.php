<?php

function getrndAnswer($answerstr)
{
	
	$list = explode ('||', $answerstr );
	return trim($list[rand(0,count($list)-1)]);
}


function getuserinfo()
{ 	
	 $container = " `sessionid`='" . $GLOBALS['session_user'] ."'";
	 
   $rlt = db_read_array('userinfo',array(), $container);
      
   if(count($rlt)>0)
     return current($rlt);
   else
     return ;
   
}

function saveuserinfo($userdb)
{	 
  $userdbx = getuserinfo();
  foreach($userdb as $k => $v)
  {
  	$userdbx[$k] = $v;
  }
  $userdbx['sessionid'] = $GLOBALS['session_user'];
  $userdbx['lasttalktime'] = time();
  db_write('userinfo',$userdbx);
	
}
function v2chatstatclr()
{ $userdb = getuserinfo();
	if(!is_array($userdb)) return;
	
	$userdb['lasttalktime'] = 0;
	$userdb['v2session_cookie'] = '';
	db_write('userinfo',$userdb);
	$GLOBALS['cookie']='';
	//exit;
}

function AD_msg()
{
	$admsg = '今日运势查询: 如，输入（金牛座 明天 运势）
	         ||今日电视节目查询: 如，输入（湖南卫视 今晚节目）
	         ||菜谱查询：如，输入(红烧肉 怎么做)
	         ||天气查询: 如，输入(北京 明天 天气)
	         ||翻译查询：如, 输入(翻译 去逛街吗？)
	         ||故事笑话: 如，输入(给我讲个笑话)
	         ||机票查询: 如，输入(北京到长沙4月20日的机票)
	         ||几十万个会员卡，随时使用.如，输入(会员卡)';
	          
	return "\n---".getrndAnswer($admsg);
	
}
?>