<?php 


$GLOBALS["TOKEN"] = "dingabcd2014";
 
	
	
require_once('wx.entery.php');


function menu_MENU_CONTACT(){
    $content =  "联系我们:  13910136035\r\n abcdefg";	 
	 return strip_tags($content);	
	
}

//被关注
function event_subscribe($postObj, $EventKey=''){
	  $content =  event_wellcome();	 
	  return strip_tags($content);
}


 

function event_wellcome()
{ 
	 $openid = $GLOBALS['weixin_openid'];

    $filter = "openid='$openid'";;
 
	 $wellcome = "欢迎使用'好到家'社区服务微信号";
 
	 $GLOBALS['msg_ext'][]=  array(
	      'picurl'=> 'http://www.1949.gov.cn/uploadfile/school_pic/200910171952068912.jpg',  
	      'title'=> "'好到家'社区服务微信号",
	      'description'=> '...',
	      'link'=>'http://water.itsweetie.com/?win=goods&cls=1'  );

      $GLOBALS['msg_ext'][]=  array(
	      'picurl'=> 'http://itsweetie.com/data.water/logo.jpg',  
	      'title'=> $wellcome,
	      'description'=> '...',
	      'link'=>'http://water.itsweetie.com/?win=goods&cls=1'  );
	      
	      
	 return '[news]';      
}