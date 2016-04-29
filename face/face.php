<?php
$Content ='[news]';
$myface = ($postObj->PicUrl); 

//$myface = 'http://g.search.alicdn.com/img/bao/uploaded/i4/i2/12479023804045333/T187SVXBRbXXXXXXXX_!!0-item_pic.jpg_310x310.jpg';

require_once('myfunction.php'); 
$jsonX =  getsimilar($myface);


$json=$jsonX->json;
   $cookie= $jsonX->cookie;
   $querysign=$jsonX->querysign  ;
//$Content = '给你匹配120个相似候选人:<a href="'.$url.'">点这里查看</a>';

$p=0;$j=0;
foreach($json->data as $img)
{  
	
	$picurl = $img->faceURL;
	if(strlen($picurl) < 5) continue;
	
	$simi = $img->simi;
	$imgurl ='http://biyike.scicompound.com/weixin/face/img.php?url='.urlencode($picurl).'&querysign='.$querysign .'&cookie='.$cookie;
	
 
  $url = 'http://biyike.scicompound.com/weixin/face/show.php?myface='.urlencode($myface) .'&pagenum='.($j*50);
  $title ='第'.($j*50+1).'-'.($j*50+50).'位候选人。';
  if($simi > 90) $title .="\n这是你本人吗？貌似是个明星，严重怀疑。。";
  else $title .="\n相似度:".$simi.'%';;
  
  $wordx = $title."\n点击查看";
  //$imgurl = $myface;
  $GLOBALS['msg_ext'][] = array('picurl'=> $imgurl,'title'=> $title,'description'=> $wordx,'link'=> $url );
  
  if($p > 0) $j++;  
  if($j>5) break;
  $p = 11;
}

if($j < 1) 
{
  $Content ="抱歉，哇，找不到与之匹配的人类。\n请给一张人物正面照";
  $GLOBALS['msg_ext'][] = array('picurl'=> $myface,'title'=> $Content ,'description'=> $postObj->PicUrl ,'link'=> $myface );
  $Content ='[news]';
}


//print_r($GLOBALS['msg_ext']);

?>