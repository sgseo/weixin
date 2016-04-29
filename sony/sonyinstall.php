<meta http-equiv="content-type" content="text/html;charset=utf-8">
<?php
 //echo gwd(); exit;
 require_once(dirname(__FILE__).'/../dbfunction.php');
 

 
// mysql_query('update `tao_cache` set `saler`=26');
    
if(is_file('INSTALL_FINISHED'))
exit('错误:请勿重复安装');

 
$sql = "CREATE TABLE IF NOT EXISTS `" . $tb_prefix . "sonyuser` (
`uid` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`sessionid` TEXT,
`fakeid` TEXT  ,
`sid` TEXT   ,
`talkid` TEXT   ,
`lastword` TEXT  ,
`lastword2` TEXT  ,
`lasttalktime` BIGINT
 
) ;";
$result = mysql_query($sql) or die("数据库访问失败,表user,".mysql_error());








//-------------------- server
$sql = "CREATE TABLE IF NOT EXISTS `" . $tb_prefix . "sonydata` (
`uid` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`sid` TEXT ,
`message` TEXT,
`sender` TEXT,
`type` TEXT,
`updatetime` BIGINT  DEFAULT '0' 
 
) ;";
$result = mysql_query($sql) or die("数据库访问失败,表sonydata,".mysql_error());

 touch('INSTALL_FINISHED');
 echo $tb_prefix . "Done<br>";
echo '数据库安装完成';
exit;//========================================== 退出







//-------------------- server
$sql = "CREATE TABLE IF NOT EXISTS `" . $tb_prefix . "sonydata` (
`uid` TEXT ,
`sid` TEXT ,
`message` TEXT,
`sender` TEXT,
`type` TEXT,
`updatetime` BIGINT  DEFAULT '0',
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
 