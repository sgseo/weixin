<meta http-equiv="content-type" content="text/html;charset=utf-8">
<?php

 require_once('dbfunction.php');
 
// mysql_query('update `tao_cache` set `saler`=26');
    
if(is_file('INSTALL_FINISHED'))
exit('错误:请勿重复安装');

 
$sql = "CREATE TABLE IF NOT EXISTS `" . $tb_prefix . "userinfo` (
`uid` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`sessionid` TEXT,
`fakeid` TEXT  ,
`petname` TEXT   ,
`talkid` TEXT   ,
`lastword` TEXT  ,
`lastword2` TEXT  ,
`v2session_cookie` TEXT  ,
`lasttalktime` BIGINT
 
) ;";
$result = mysql_query($sql) or die("数据库访问失败,表user,".mysql_error());

echo $tb_prefix . "cache Done<br>";



touch('INSTALL_FINISHED');
echo '数据库安装完成';
exit;//========================================== 退出



//-------------------- server
$sql = "CREATE TABLE IF NOT EXISTS `" . $tb_prefix . "cfg` (
`uid` TEXT ,
`lasttime` BIGINT  DEFAULT '0',
`period` INT ,
`host` TEXT ,
`sub` TEXT,
`user` TEXT,
`password` TEXT,
`min` INT DEFAULT '1',
`max` INT DEFAULT '255',
`count` INT  DEFAULT '0',
`agree` TINYINT NOT NULL DEFAULT '0',
`tick` INT   DEFAULT '0',    
`enable` TINYINT NOT NULL DEFAULT '1',
`server` INT DEFAULT '0',
`lastserverid` INT DEFAULT '0',
`sw_ver`  TINYINT   DEFAULT '0', 
`allmyhost` TEXT 
) ;";
$result = mysql_query($sql) or die("数据库访问失败,表cfg,".mysql_error());

 
$sql = "CREATE TABLE IF NOT EXISTS `" . $tb_prefix . "pay` (
`uid` TEXT   ,
`trade_no` TEXT   ,
`user` TEXT   ,
`type` TEXT  ,
`num` INT   ,
`money` INT  ,
`step` TEXT,
`time` BIGINT   
 
) ;";
$result = mysql_query($sql) or die("数据库访问失败,表pay,".mysql_error());


 $sql = "CREATE TABLE IF NOT EXISTS `" . $tb_prefix . "result` (
`uid` TEXT ,
`ok` INT DEFAULT '0',
`bad` INT DEFAULT '0',
`worse`   INT DEFAULT '0',
`err`    INT DEFAULT '0',
`total`    INT DEFAULT '0',
`taketime`   BIGINT DEFAULT '0',
`time`     BIGINT DEFAULT '0', 
`count`  INT DEFAULT '0'  
) ;";
$result = mysql_query($sql) or die("数据库访问失败,表result,".mysql_error());	

 

 
touch('INSTALL_FINISHED');
?>
数据库安装完成
 