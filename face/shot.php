<?


$Content ='[news]';
$myface = ($postObj->PicUrl); 

//$myface = 'http://g.search.alicdn.com/img/bao/uploaded/i4/i2/12479023804045333/T187SVXBRbXXXXXXXX_!!0-item_pic.jpg_310x310.jpg';
$myface = 'http://mmbiz.qpic.cn/mmbiz/0JBYdHfiaAacphBzGjxF86UbIRWg8SibCSJIibsHCmO9ypPCBAdxa7eLWWtwic9ItlzlbPFBDUuQFhJ6RtwiaoA8RNg/0';

file_put_contents('tmpimg.jpg','');


require_once('myfunction.php'); 
$jsonX =  getsimilar($myface);
$json=$jsonX->json;
   $cookie= $jsonX->cookie;
   $querysign=$jsonX->querysign  ;
//$Content = '����ƥ��120�����ƺ�ѡ��:<a href="'.$url.'">������鿴</a>';

var_dump($jsonX);


$p=0;$j=0;
foreach($json->data as $img)
{  
	
	$picurl = $img->faceURL;
	if(strlen($picurl) < 5) continue;
	
	$simi = $img->simi;
	$imgurl ='http://biyike.scicompound.com/weixin/face/img.php?url='.urlencode($picurl).'&querysign='.$querysign .'&cookie='.$cookie;
	
 
  $url = 'http://biyike.scicompound.com/weixin/face/test.php?myface='.urlencode($myface) .'&pagenum='.($j*50);
  $title ='��'.($j*50+1).'-'.($j*50+50).'λ��ѡ�ˡ�';
  if($simi > 90) $title .="\n�����㱾����ò���Ǹ����ǣ����ػ��ɡ���";
  else $title .="\n���ƶ�:".$simi.'%';;
  
  $wordx = $title."\n����鿴";
  //$imgurl = $myface;
  $GLOBALS['msg_ext'][] = array('picurl'=> $imgurl,'title'=> $title,'description'=> $wordx,'link'=> $url );
  
  if($p > 0) $j++;  
  if($j>5) break;
  $p = 11;
}

if($j < 1) 
$Content ="��Ǹ���ۣ��Ҳ�����֮ƥ������ࡣ\n���һ������������";


 print_r($GLOBALS['msg_ext']);

?>