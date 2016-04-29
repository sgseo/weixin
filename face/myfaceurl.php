<?php
error_reporting(E_ALL & ~E_NOTICE); 


$url = $_GET['url'];
$buf = (file_get_contents($url));
$myfaceurl = trim(findBetween($buf,'queryImgThumbURL : "','",'));

 header('Location: '.$myfaceurl);

function findBetween($buf,$k1='',$k2='',$off=0)
{   
		if($k1=='') $p1=0;
		else $p1 = mb_strpos($buf,$k1,$off );	
		
		if($k2=='')$p2=strlen($buf);
		else $p2 = mb_strpos($buf, $k2,$p1 + mb_strlen($k1) );	

    
		if(
		    (($k1 && $p1 > 0 ) || $k1=='' )
		 && $p2 > $p1)
		{
			$p1+=mb_strlen($k1);
		  return mb_substr($buf,$p1,$p2-$p1);	
		}
}
?>