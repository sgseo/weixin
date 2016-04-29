<?php
//请用UltraEdit等工具 保存本文件为UTF-8无BOM 格式， 
//严重不推荐用 windows自带的'记事本'进行编辑. (除非本文中没有英文数字半角符号以外的任何字符)
 
//  error_reporting(0); //是否提示运行错误开关
 error_reporting(E_ALL & ~E_NOTICE);
 
 //--------------------请在这里配置您的 数据库 基本信息------------------------------
 global $db_host, $db_user, $db_password, $db_db, $tb_prefix;  

  
	$db_host      = "localhost";   //数据库服务器ip,域名, 如果和程序在一个机器,可填localhost
	
	
	$db_user      = "root";        //帐号 
	$db_password  = "quick";    //密码
	$db_db        = "ding_weixin";      //数据库名    
	$tb_prefix    = "wx_";      //表前缀
    
   
  if(is_file('debug.txt')) $db_password  = "123456"; 
    
?>