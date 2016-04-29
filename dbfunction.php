<?php
require_once('dbconfig.php');
  $db_link = null;
  
define('ERR_NUM_DB_ERR','0');
 
 
 $db_link = mysql_connect($db_host,$db_user,$db_password)
  or die(ERR_NUM_DB_ERR."\n数据库无法连接:" .  mysql_error());
mysql_select_db($db_db);

 
function db_init(){
global	$db_link, $db_host,$db_user,$db_password;
	
$db_link = mysql_connect($db_host,$db_user,$db_password)
  or die(ERR_NUM_DB_ERR."\n数据库无法连接:" .  mysql_error());
mysql_select_db($db_db);
}

function db_deinit(){
global	$db_link, $db_host,$db_user,$db_password;
	
 mysql_close($db_link);

}

function db_query($sql){
global	$db_link, $db_host,$db_user,$db_password;
	
 $query = mysql_query($sql) or die(ERR_NUM_DB_ERR."\n更新数据库错误:($table) ".mysql_error(). "\r\n". $sql);
 return $query;
}


//读文件 $pageset=array('pagesize'=>20, 'start'=>5)
function db_read_array($table,$pageset=array(),$container='')
{
	$table = preix_table($table);
	$sql="SELECT * FROM `" .$table. "` " ;
	
	if('' != $container) 
	$sql .= ' where '. $container;
	 
	if(count($pageset))
	{
		$start =  $pageset['start'];
		$sql .= ( " limit " .$start . ",". ($pageset['pagesize'])  );		
	}
   //	echo $sql;
	$query = mysql_query($sql) or die(ERR_NUM_DB_ERR."\n更新数据库错误:($table) ".mysql_error(). "\r\n". $sql);
	$result =array();
	while ($row = mysql_fetch_assoc($query)) {
         $result[$row['uid']] = $row;
  }
  return $result;
}

function db_count($table,$container='')
{
	$table = preix_table($table);
	$sql="SELECT count(`uid`) FROM `" .$table. "` " ;
	
	if(''!=$container) 
	$sql .= ' where '. $container;
	 
	//echo "\r\n $sql \r\n" ;
	$result = mysql_query($sql) or die(ERR_NUM_DB_ERR."\n更新数据库错误:($table) ".mysql_error() . "\r\n". $sql);
	 	 
  return mysql_result($result,0); ;
}
//字段  求和
function db_sum($table,$KEY,$container='')
{
	$table = preix_table($table);
	$sql="SELECT SUM(`$KEY`) FROM `" .$table. "` " ;
	
	if(''!=$container) 
	$sql .= ' where '. $container;
	 
	//echo "\r\n $sql \r\n" ;
	$result = mysql_query($sql) or die(ERR_NUM_DB_ERR."\n更新数据库错误:($table) ".mysql_error() . "\r\n". $sql);
	 	 
  return mysql_result($result,0);  
}

//读文件
function db_read_one($table,$uid)
{  $table = preix_table($table);
	
	$sql="SELECT * FROM `" .$table. "` WHERE uid='".$uid ."'";;
	$query = mysql_query($sql) or die(ERR_NUM_DB_ERR."\n更新数据库错误:($table) ".mysql_error() . "\r\n". $sql);
	 
	 $row = mysql_fetch_assoc($query);
    
  return $row;
}

//最后一条记录
function db_read_last($table)
{  $table = preix_table($table);
 

	$sql="SELECT * FROM `" .$table. "`  order by uid desc limit 1";;
	$query = mysql_query($sql) or die(ERR_NUM_DB_ERR."\n更新数据库错误:($table) ".mysql_error() . "\r\n". $sql);
	 
	$row = mysql_fetch_assoc($query);
    
  return $row;
}

 
//写缓存内容
function db_write($table,$data,$uid='')
{  
	$num_rows =0;
	
	if (!is_array($data))
	{return;}
	
	$uid = $uid ? $uid : $data['uid'] ;
	if ($uid !='')
	{$sql = "SELECT `uid`  FROM `" .preix_table($table). "` WHERE uid='" . $uid ."'" ;
 
	 $query = mysql_query($sql) or die("数据库访问失败($table)".mysql_error() . "\r\n". $sql);;
	 $num_rows = mysql_num_rows($query);
	}
	
	if($uid)  $data['uid'] = $uid ; 
	if( $num_rows < 1)
	{		
		db_insert($table,$data);
		return mysql_insert_id();
				
	} 
	else
	{
		
		db_update($table,$data);
		return $data['uid'];
	}
}

function db_update($table,$data,$indexkey='uid')
{ $i=0;$f='';$v='';
	
	$table = preix_table($table);	
	$strict = 0;
	
	foreach($data as $key=>$val)
	{
		if($strict)
		{
			if(in_array($key,$field))
			{
				$d=$i>0?',':'';
				$f.=$d."`".$key."`="."'".addslashes(trim($val))."'";
				$i++;
			}
		}
		else
		{
			$val = addslashes(trim($val));
			 if($val=='')  $val = null;
			
			$d=$i>0?',':'';
			$f.=$d."`".$key."`="."'". $val ."'";
			$i++;
		}
		
	}
	
	$sql="update  ". ($table)." set ";
	$sql.=$f." where ".$indexkey."= '".$data[$indexkey] ."'";
	                      
	// exit($sql);                     
 
	 $result = mysql_query($sql) or die("数据库访问失败($table)".mysql_error() . "\r\n". $sql);
	
}



function db_insert($table,$data )
{ $i=0;$f='';$v='';
	$table = preix_table($table);	
	 
	$strict = 0;
	if (!is_array($data))
	{return;}
	foreach($data as $key=>$val)
	{
		if($strict)
		{
			if(in_array($key,$field))
			{
				$d=$i>0?',':'';
				$f.=$d.'`'.$key.'`';
				$v.=$d."'". addslashes(trim($val))."'";
				$i++;
			}
		}
		else
		{
			$d=$i>0?',':'';
			$f.=$d.'`'.$key.'`';
			$v.=$d."'". addslashes(trim($val))."'";
			$i++;
		}
		
	}
	$replace = 0;
	$type=$replace?'replace':'insert';
	$sql =  $type." into `". ($table)."` (".$f.") values(".$v.")";
	
	// exit($sql);
	 
	$result = mysql_query($sql) or die("数据库访问失败($table)".mysql_error() . "\r\n". $sql);
}

//删除一个条
function db_delete_one($table,$uid)
{  $table = preix_table($table);
	
	$sql="DELETE FROM `". $table ."`   WHERE uid='".$uid ."'  limit 1";;
	$query = mysql_query($sql) or die(ERR_NUM_DB_ERR."\n更新数据库错误($table):".mysql_error() . "\r\n". $sql);
 
}
 
//清除数据
function db_clean_table($table)
{ $table = preix_table($table);
	
	$sql="TRUNCATE `". $table ."`";;
	$query = mysql_query($sql) or die(ERR_NUM_DB_ERR."\n更新数据库错误($table):".mysql_error() . "\r\n". $sql);
 
}


function preix_table($table)
{  global $tb_prefix;
	  return $tb_prefix .$table	;	
}


function debug_assert($msg)
{
	
 	echo "<div style='border；1px solid #339933;background:#ddffdd'>" ;
 	if(is_array($msg))
 	  print_r($msg) ;
 	else
 	  echo $msg;
 	  
 	echo "</div>";
 	exit;
}

?><?php

















//读文件
function cache_read($file,$folder='')
{  
	$file = cachefilepath($file,$folder);
	if(is_file($file))
	{  include($file);	 
	   return $content;
	}
}
 
//写缓存内容
function cache_write($file,$content,$folder='')
{
	$file = cachefilepath($file,$folder);
	if(is_array($content))
	{
		$content= var_export($content,1);
	}
	else
	{
		$content='array()';
	}	 
	/*$content = '<?  $content = unserialize (\'' . serialize($content) . '\');  ?>';	  */
	$content = '<?  $content =    ' .  ($content) . '  ;  ?>';	 
	
	if(function_exists('file_put_contents'))
	{
		file_put_contents($file,$content);
	}
	else
	{
		$fp=fopen($file,'w');
		  flock($fp,2);  //加锁
		fwrite($fp,$content);
			if(flock($fp,3))    //解除锁定
		fclose($fp);
	}
}
function cachefilepath($file,$folder='')
{
	return  $folder.'cache.'.($file) .'.php';
}



function err_handler($errno, $message, $errfile, $errline)
{
	$msg = $message   .". (file) $errfile ($errline)";
	 if( strpos("mm" .$msg  ,'Undefined index') > 0 )
	   return;
	 
  switch ($errno) {
  case E_CORE_ERROR:
  case E_USER_ERROR:
  case E_ERROR:
    {echo "\r\n严重错误:". $msg ;
    }break;
  default:
    //mylog( $msg );
   break;
  }
}
// set_error_handler('err_handler');
?>