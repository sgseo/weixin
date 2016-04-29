<?php

error_reporting(E_ALL & ~E_NOTICE);
 require_once('xiaoifunc.php');
 
//echo caipuCheck('八宝粥');

function caipuCheck($q)
{  
	
	$q = trim($q);
  if(mb_strlen($q) < 2) return;
  
	if($q=='菜谱' || $q =='食谱')
	{
		$longurl = 'http://biyike.scicompound.com/weixin/caipu/recipemake.php?q=all' ;
	}	  
  else
  { 

    if(mb_substr($q,0,2)=='菜谱')
	  {
		  $q = trim(strtr($q,array('菜谱'=>'')));
		  $notice='如果没有你想搜的菜谱，请在名称前加个！号';
	  }
	  if(mb_strpos('--'.$q,'怎么做') > 0 || mb_strpos('--'.$q,'做法') > 0)
	  {
		  $q = trim(strtr($q,array('怎么做'=>'')));
		  $q = trim(strtr($q,array('的做法'=>''))); 
		  $notice='如果没有你想搜的菜谱，请在名称前加个！号';
	  }
	  if( substr($q,0,1)=='!' || substr($q,0,1)=='！')
	  {	  	
	  	$q = substr($q,1);
	  	$longurl = 'http://biyike.scicompound.com/weixin/caipu/recipemake.php?q=' . urlencode($q);
	  }
	  
	  $q = trim(strtr($q,array('?'=>'','？'=>'')));


	  require_once('recipes.dat.php');
	 
		foreach($caipuList as $caipu)
		{
		 if($caipu==$q)
		 {$matchlist[]=$caipu;break;}
		 if(stripos('--'.$caipu,$q)>0)
		 { 
		   $matchlist[]=$caipu;
		   //break;		   
		 }
		}
		if(count($matchlist))//如果有多个，随机给一个
		{
		  $q = $matchlist[rand(0,count($matchlist)-1)];
		  $longurl = 'http://biyike.scicompound.com/weixin/caipu/recipemake.php?q=' . urlencode($q);
	  }
		
  }
  
   if(!$longurl && $notice) //想找，但是菜单里没有
   {
   	  $longurl = 'http://biyike.scicompound.com/weixin/caipu/recipemake.php?q=' . urlencode($q);
   }
   
   if(!$longurl)
   return; //啥都没有，回去
   
   
	 //$url = makeURL($longurl);
	 //if(!$url) 
	 $url = $longurl;
	 
	// echo $longurl;exit;
	 
	 if(strpos($longurl,'all')) 
	   return '我会的菜谱，很多很长哟，我把它放到这里了，你慢慢看:<a href="' . $url .'">查看菜谱</a>'
	          ."\n  或者你告诉我一个'蔬菜(鱼肉)'的名字，我给你推荐一下";	
	 
	 
	 $answerHeadstr = '这个很简单的，教会了你，要请我吃哦
	                  ||这个我拿手，我现在就做给你吃吧
	                  ||让我来教你，笨笨。
	                  ||刚好问道我最拿手的
	                  ||今天就做这道菜给你吃
	                  ||菜谱我是无私奉献啦，学会了，要请我吃哦
	                  ||我教了你，保证比酒店的还好吃
	                  ||这道菜我研究了几个月了，
	                  ||绝对的大师级做法
	                  ||让你见识一下什么叫大厨风范
	                  ||不是偶吹啊，偶是清华厨师学校的博士生
	                  ||今天就让你看看什么叫牛'; 
	                  
	  $msg  = getrndAnswer($answerHeadstr)."，给你看【" .$q."】的做法\n" .$notice ."微信号:Cleverbot"  ;	
	 
	 
	 
	  
	  $imgurl = getimg($q);
	  $wordx = $msg;
	  $title = $q;
    $GLOBALS['msg_ext'][] = array('picurl'=> $imgurl,'title'=> $title,'description'=> $wordx,'link'=> $url );
    
    return '[news]'; 
	
	
}

function getimg($name){
  $url = "http://biyike.scicompound.com/weixin/caipu/recipemake.php?q=" . urlencode($name);	
	$buf = file_get_contents($url);
	
	//echo $buf;
	$p = strpos($buf,'reimg.php?');
	$p2 = strpos($buf,'"',$p);
	$imgurl = substr($buf,$p,$p2-$p);
  
	
 	return 'http://biyike.scicompound.com/weixin/'.$imgurl;
	//http://a.hiphotos.baidu.com/baike/
}


function makeURL($longurl)
{ 
	require_once('HTTP.php');
	$url = 'http://126.am/api!shorten.action';
	//$para['']='';
	$para['ext']['content']=
	          'longUrl='.urlencode($longurl)
	          .'&key=8e3127b421ef4d56993aa9bef79fe996';
	$buf = http_request($url,$para);
	$buf = HTTP_body($buf);
	 
	$re=json_decode($buf,true); 
	//print_r($re);
	if($re['status_code'] ==200)
	{
	   return 'http://'.$re['url'];
	}
	 
  // echo $arrResponse['status_txt']!='OK';
}
 
?>