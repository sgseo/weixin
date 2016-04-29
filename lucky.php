<?php


error_reporting(E_ALL & ~E_NOTICE);


$p=mb_strpos($EXT_MSG,'座');
if($p > 1) {
	$ast = mb_substr($EXT_MSG,$p-2,2);
}else {
	$p =mb_strpos($EXT_MSG,'运');
	if($p>0) $ast=mb_substr($EXT_MSG,0,$p); 
	else $ast=mb_substr($EXT_MSG,$p+2); 
}
$ast=trim($ast);
if(strlen($ast) < 1) return;

$time =time();
if(mb_strpos('--'.$EXT_MSG,'明')) $time+=(3600*24);
if(mb_strpos('--'.$EXT_MSG,'后天')) $time+=(3600*24*2);

return get_lucky($ast,$time);

function get_lucky($ast,$time)
{
	  
  
 
 // echo '------' .iconv('utf-8','gbk',$ast);
 $astroNameStr = '---;aries,白羊座;aries,牧羊座;aries,牧羊座;taurus,金牛座;gemini,双子座;cancer,巨蟹座;
                leo,狮子座;virgo,处女座;
                libra,天秤座;libra,天平座;libra,天枰座;scorpio,天蝎座;scorpio,天蟹座;sagittarius,射手座;
                capricorn,魔蝎座;capricorn,摩蝎座;capricorn,摩羯座;capricorn,魔羯座;
                aquarius,水瓶座;pisces,双鱼座;---';
 
 $p2 = mb_strpos($astroNameStr,$ast);
 if($p2 < 1) return;
 $buf = mb_substr($astroNameStr,0,$p2+4);
// echo iconv('utf-8','gbk',$buf);
 
 $p = mb_strrpos($buf,';',-3);
 $p2 = mb_strrpos($buf,',');
 $p3 = mb_strpos($buf,';',$p2);
 $curast = mb_substr($buf,$p2+1,$p3-$p2-1);
 $curast =trim($curast);
 
// echo iconv('utf-8','gbk',$curast);
 if($p < 1 || $p2 < $p) return ;
 $p++;
 $astro = mb_substr($buf,$p,$p2-$p);
 $astro =trim($astro);
  
 $day = date('Ymd',$time);
 $url = 'http://vip.astro.sina.com.cn/astro/view/' .$astro.'/day/'.$day;
 
 $buf = file_get_contents($url);
 //$buf =  strip_tags($buf);

 $p = mb_strpos($buf,'lotstars');
 $p = mb_strpos($buf,'<div',$p);
 if($p < 1) return ;
 $buf = mb_substr($buf,$p);
 $buf = str_replace('<p>',': ',$buf);
 $buf = str_replace('商谈','金钱',$buf);
 $buflist = explode('<div class="tab">',$buf);
 
 $GOT ='';
 for($i=1; $i< 10; $i++)
 {
 	  $c='';
 	  $v = $buflist[$i];
 	  if($i<5) { $c = substr_count($v,'<img');
 	  $c= str_repeat('★',$c);
 	  }
 	  if($i==9)
 	  {
 	  	$v = str_replace(': ',': [',trim($v)).']'; 	  	
 	  }
 	  
 	  //$list[]= iconv('utf-8','gbk',trim(strip_tags($v))) . ' '. $c;
 	  $GOT .=  trim(strip_tags($v)) . ' '. $c ."\n";
 } 
  
  $buf = strip_tags($buflist[10]);
  $buf  =str_ireplace(array('&nbsp;',':'),'',$buf);  
  $buf = trim($buf);
  
  $GOT .= '箴言:'.str_repeat('-',10)."\n".$buf;
  //print_r($list);
  // echo iconv('utf-8','gbk',$GOT);

  $diff = $time-(time()+5);
  $d = floor($diff/(24*3600))+1;
  $dayname = array('今日','明日','后天');
  if($d< 3 && $d >=0) $when = $dayname[$d];
  
  return  '【'.$curast.'】'. $when. " 运势\n".$GOT .date('(Y年m月d日运势)',$time) ;
}  
?>