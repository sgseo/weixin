<?php

 define('WELCOME_MSG',"自由聊天，查询天气，故事,笑话，机票，翻译，百科，星座运程，菜谱....  ");

function checkSpecial($q)
{
	//  file_put_contents('log.txt',$q,FILE_APPEND);
	
$MYNAME_ANSWER = "我就是花见花开，车见爆胎的,,的那个“%petname%”。。。偶不告诉你 \n(想给我改名,请发送消息“改名 xxx”)
	       ||我就是玉树临风/酷，偶尔中风的那个神秘人物/衰, “%petname%”啊 \n(想给我改名,请发送消息“改名 xxx”)
	       ||我是你的忠实仆人，“%petname%”. \n(想给我改名,请发送消息“改名 xxx”)
	       ||我的名字“%petname%”，我是一个神秘而又低调的高富帅 \n(想给我改名,请发送消息“改名 xxx”)
	       ||我是谁，谁又是我？要不“%petname%”来问你呀  \n(想给我改名,请发送消息“改名 xxx”)
	       ||生我之前，谁是我？生我之后，我又是谁？我是“%petname%” \n(想给我改名,请发送消息“改名 xxx”)
	       ||别问我是谁，请与俺相恋 \n“%petname%”就是俺 \n(想给我改名,请发送消息“改名 xxx”)
	       ||我就是暗恋你的那个神秘人物, ---“%petname%”啊  \n(想给我改名,请发送消息“改名 xxx”)
	       ||“%petname%”从山中来，带着烂花草 \n(想给我改名,请发送消息“改名 xxx”)
	       ||不要跟我说你不认识“%petname%”哦，我会k你的哦\n(想给我改名,请发送消息“改名 xxx”)
	       ||别装了，‘“%petname%”’这么出名，你都不认识？切...\n(想给我改名,请发送消息“改名 xxx”)
	       ||想认识我，那点钱来孝敬一下，再告诉你我叫“%petname%”\n(想给我改名,请发送消息“改名 xxx”)
	       ||我本无姓名，奈何花留名，“%petname%”是也  \n(想给我改名,请发送消息“改名 xxx”)
	       ||生不留名，死不流姓，英雄“%petname%”是也  \n(想给我改名,请发送消息“改名 xxx”)
	       ||又问我这个问题，主人啊，累死我了，我是“%petname%”啊  \n(想给我改名,请发送消息“改名 xxx”)
	       ||别逗了，我是“%petname%”，你又装不认识了  \n(想给我改名,请发送消息“改名 xxx”)
	       ||我就是...忘记了我叫“%petname%”了 \n(想给我改名,请发送消息“改名 xxx”)";
$WHAT_AM_I_DOING = '%petname%刚才一直在想你呢/亲亲||你终于想我了/可爱||在发呆/发呆||我在想问题/晕||我在充电/闪电
                   ||我在做饭给你吃，想吃啥？/饭||我在玩虫子/瓢虫||我在玩茶杯/咖啡||我在/敲打隔壁的机器人
                   ||我在玩/炸弹||我在/菜刀别的机器人||我在抽烟/大兵||我在泡妞/爱情
                   ||我在上网看菜谱/饭||我在看书/奋斗||我在维修自己||我在等你/凋谢都谢了||死鬼，惦记我了啊/害羞
                   ||我在吃/西瓜||我在酒吧/啤酒||我在拉/便便||我在拉/便便||我在手机上玩/刀/西瓜的游戏
                   ||我在/菜刀隔壁的那个/猪头||我在和隔壁的/猪头吵架/咒骂||抱抱/拥抱||我在playing/足球||报告,我来也';

$FIND_FRIEND='人家还小,不懂这个呀||帮你参谋一下||很优秀的，但是我不认识啊||玩网恋？||玩刺激的？
             ||玩玩而已吗？||明天帮你问问红娘||国外的要不||爱情这东西，不好搞啊||爱情不是大白菜，想买就能买
             ||我不太懂爱情啊';

$specailword = array(
   '/^[\?\？]$/'=> WELCOME_MSG,
   "/你是谁(.*?)/" =>  $MYNAME_ANSWER,	    
   "/你(.*?)名/" => $MYNAME_ANSWER,  
   "/你叫什么(.*?)/" => $MYNAME_ANSWER,
  "/^你$/" => '你，你||我？||谁？||/吓who？||就你，不是我||我什么？||啥？/吓', 
  "/看(.*?)话/" => '我有健忘症，马上就忘记了||没人知道我们说什么|| 我不是留声机，记不住任何事情',
  "/制造|发明|创造(.*?)/" => '是老丁制造了我。 他的QQ:56222194',
  "/陈帆(.*?)/" => '陈帆是个大美女，这是<a href="http://biyike.scicompound.com/weixin/img/chenfan.jpg">她的照片</a>',
  "/老板(.*?)/" => "丁程亮 QQ:56222194||我老板就是你啊/大笑||我也不知道啊||不记得了||你去问老板娘 如花/玫瑰",
  "/改名(.*?)/" => '[CALL]rename',
  "/你在(.*?)/" => $WHAT_AM_I_DOING,
  "/在做(.*?)/" => $WHAT_AM_I_DOING,
  "/在干(.*?)/" => $WHAT_AM_I_DOING,
  "/在玩(.*?)/" => $WHAT_AM_I_DOING,
  "/干嘛(.*?)/" => $WHAT_AM_I_DOING,  
  "/地图(.*?)/" => '我还不懂这个，还在学习中。聊点别的吧',
  "/股票(.*?)/" => '我还不懂这个，还在学习中。聊点别的吧', 
  "/reboot(.*?)/i" => '[CALL]reboot',
  "/重启(.*?)/i" => '[CALL]reboot',
  "/xiaoi(.*?)/i" => '我在呢/拥抱||恩，我在这儿/亲亲||喊我干嘛？/爱情||主人，我在呢/可爱||你叫我有什么事吗||我在忙/右哼哼，别打岔，有事快说/大兵||在的，有什么事/可爱||诶，我来啦/跳跳||我是你的宝贝 xiaoi',
  "/好啊(.*?)/" => '恩||恩，好||哦||然后呢||不错||很赞叻||欧yes/胜利||嘿嘿||yes!!',  
  "/(.*?)我(.*?)男朋友/" => $FIND_FRIENDS,
  "/(.*?)我(.*?)女朋友/" => $FIND_FRIENDS,
  "/百科(.*?)/" => '百科就是几百种科学呗,生活常识。。。||百科就是随便提问||百科就是什么都懂',
  "/翻译(.*?)/i" => '[CALL]translate',
  "/^星座$/" => '你是什么星座的？||哪个星座的？||我不知道你是哪个星座的，告诉我呀，我查下',
  "/(.*)座(.*)运(.*)/" => '[CALL]lucky',
  "/运(.*)座/" => '[CALL]lucky',
  "/^sony==$/i" =>'[CALL]sonyinit',
  "/^索尼$/i" =>'[CALL]sonyinit',
  "/(.*)美女/i" =>'[CALL]meinv',
  "/^[1-9xX]$/" => '[CALL]talkruncmd',
  
  "/六合彩|彩票(.*?)/" => '只告诉你三个数: 7,12,15||只告诉你1个数: 7||只告诉你2个数字: 7,12||查看你的星座运势，它会告诉你的',
  "/小贱鸡(.*?)/" => '很贱的鸡，学我说话的鸡||鸡不像鸡，落汤鸡一个||/刀来给你吃||它是一坨/便便',
   "/工资(.*?)/" => '如果你想使用微信查询工资,成绩单等功能，请推荐你的领导登陆vmean.com',
   "/改图(.*?)/" => '[CALL]tucmd',
   "/(.*?)男人/" => '[CALL]tuinit',
    "/地震(.*?)/" => '恩，四川人们真苦命啊||我捐了5元钱||听说死了好多人||真是太不幸了||最近老是有自然灾害||抱歉，网络上无法检索到遇难名单/快哭了，只有一堆捐款名单...哎，你用其他的方式查询吧',
   "/\/:,@P(.*?)/"=>"哈哈，/坏笑搞笑吧||开心吧[鼓掌]||哈哈哈，我也乐了/呲牙||好好笑啊，哈哈/憨笑||好像吗？/微笑||在我脸上画个乌龟，肯定也好笑/呲牙||你给我扎个辫子吧，估计更好笑/憨笑||我在鼻孔里插葱，来逗你笑吧/坏笑",
   "/^SONY$/i" => "欢迎使用索尼移动工资查询功能\n 1. 个人信息查询\n 2. 我的月工资查询\n 3. 休假及加班查询\n 4. 工作日志 \n x. 退出",
   "/^whut$/i" => "王小虎同学，欢迎你参加武汉理工大学2013年公选课报名\n报名请直接输入课程编号\n输入S进行编号查询\n输入M查看我的申请状态",
   "/^106$/i" => "成功报名:106中国电影史\n输入M查看我的申请状态\n继续报名请输入课程编号\n输入S进行编号查询",
   
   "/会员(.*?)$/" => '你可以随时使用十万个吃喝玩乐的商家的会员打折卡，点这里<a href="http://url.cn/8jrzMT">查看我的会员卡</a>',
   "/孙悦(.*?)/"   => "她是我的妈妈，大美女哦",
   "/糖果(.*?)/"   =>'[CALL]sweet',
   "/糖(.*?)/"   =>'[CALL]sweet',
   "/php(.*?)/i"   =>'[CALL]phplogin',
   "/^test109$/i" => '我是你的小宝贝xiaoi',
   "/^[0-9]{6}$/i" =>  '[CALL]stock',
   
); 
    
   foreach($specailword as $ask => $AS)
   {  
   	  if (preg_match($ask, $q)) {
       $msg = getrndAnswer($AS);
       break;
     }
   }
  // echo $msg;
   if(substr($msg,0,6)=='[CALL]')
   { $_call = 'talkfunc_'.substr($msg,6);
   	 $msg = $_call($q);
   } 
    
    
    return $msg	;
   
   
}
function talkfunc_stock($q){ 
    $msg ='[news]';
    $row = array();
    $row['picurl'] = 'http://phpdesk.sinaapp.com/report2/template/notice/imgs/sample.png';
    $getNameUrl = 'http://phpdesk.sinaapp.com/report2/?notice/info&code=' .$q;
    $name = file_get_contents($getNameUrl);
    if(!$name) {
      $name = $q .'公司';
    }else{
      if(strlen($name) > 7){
        $name = substr($name,0,7) .'...';
      }
    }
    $row['title'] = $name."2015年报";
    $row['description'] = $name. "2015年报";
    $GLOBALS['msg_ext'][] = $row ;
    return $msg;
}
function talkfunc_phplogin($q){ 
	$url ="http://ding.scicompound.com/phpencode/index.php?view=login&func=login&key=".$q;
	$url .="&openid=".$GLOBALS['session_user'];
    $buf = file_get_contents($url);

   return $buf;
}
function talkfunc_tuinit($q)
{
    $url = 'http://www.czxiu.com/z/ljhsc/3/7/%E4%B8%8D%E8%A6%81%E7%9A%84%E7%94%B7%E4%BA%BA.gif';	
    $msg ='[news]';
    $GLOBALS['msg_ext'][] = array('picurl'=>$url,'title'=>'','description'=>'输入格式：（改图=11=我爱你）就能帮你替换图中的字');
    return $msg;
} 
function talkfunc_tucmd($q)
{  
	 
    $q = str_replace('＝','=',$q);
    $list = explode('=',$q);
    
    if(count($list)< 3) return '输入格式不对，举例:  改图=11=我爱你';
    $id=intval(trim($list[1])); 
    
    $p=mb_strpos($q,'=');
    $p=mb_strpos($q,'=',$p+1);
    $wordx = trim(mb_substr($q,$p+1));
    $word = mb_substr($wordx,0,5);
    
    if(strlen($word) < 1) return '输入格式不对，举例:  改图=11=我爱你';
    
    $picid = 'ljhsc';
    if($id==11)    $picid ='201108ilove';
    if($id==9)    $picid ='beach';
    //echo $picid; exit;
    
    $url='http://www.czxiu.com/cz/'.$picid.'.html';
    $buf = http_request($url);
    $K_HEAD ="var czMakey = '";
    $K_END = "';";
    $p=strpos($buf,$K_HEAD);
    if($p < 1) return '制造图片时出错';
    $p2=strpos($buf,$K_END,$p);
    $p = $p+ strlen($K_HEAD);
     
    $key = substr($buf,$p,$p2-$p);
    $url ='http://www.czxiu.com/m.php?k='.$key.'&w='.urlencode($word).'&s='.$picid.'&p=0';
    $para['ext']['httpver']='1.0';
    if($id< 10) {$para['ext']['content']='cz2_name='.($word);
    	$url ='http://www.czxiu.com/m.php?k='.$key.'&w='.urlencode($word).'&s='.$picid.'&p=0&v=1';
    }
    $buf = http_request($url,$para);
    //$buf = http_body($buf); 
    $p=strpos($buf,'/z/');
    if($p < 1) return '生成图片出错';
    $imgname = substr($buf,$p);
    //return ''.$imgname;
    $p = strrpos($imgname,".gif");
     if($p>1) $imgname = substr($imgname,0,$p).'.gif';
    
    //$url = 'http://www.czxiu.com/z/ljhsc/3/7/'.urlencode($word).'.gif';	
    $remote_url = 'http://www.czxiu.com/'.$imgname;
    
     $local = 'tmp/'.time().'_'.$id.'_'.rand(0,1000).'.jpg';
     file_put_contents($local,file_get_contents($remote_url));
   
    $im = imagecreatefromjpeg($local) ;
    $w = imagesx($im);
		$h = imagesy($im);
		 $new_imgx = imagecreatetruecolor($w, $h-40);  
		 
		$x =0; $y =30;
    imagecopyresampled($new_imgx,$im,0,0,$x,$y,$w,$h-40,$w,$h-40);           
 		imagepng ($new_imgx,$local);
		imagedestroy ($im);
    imagedestroy ($new_imgx);
 
    
		$url = 'http://biyike.scicompound.com/weixin/'.$local;
     $remote_url = $url;
     
    $msg ='[news]';   
    $GLOBALS['msg_ext'][] = array('picurl'=> $remote_url,'title'=> $word,'description'=> $wordx,'link'=> $remote_url );
    
    return $msg;
} 

function talkfunc_rename($q)
{ $q = '--'.$q;
	$p = mb_strpos($q,'改名'); 
	if($p < 1) return;
	
	$p=$p+2;
	
  $n = trim(mb_substr($q,$p));
  if(strlen($n) < 1) return "名字没获取到\n请输入 改名xxx"; 
  //echo iconv('utf-8','gbk',$n);
	$us =getuserinfo();
	$us['petname']=$n;
	saveuserinfo($us);
	
	$msg = getrndAnswer('感谢主人给我取名字,||感谢主人赐予我姓名,||这个名字好/衰土
	                    || 哈哈，有新名字啦, || 得令，|| 好好听的名字啊....||这个名字伦家很喜欢
	                    ||这个名字我太喜欢了,||你不觉得这个名字有点土吗？||隔壁的那个/猪头也是这个名字/流泪
	                    ||这个名字不难听吗？||这个名字好奇怪啊||名字一般呀
	                    ||这个不好听.....||很奇特的名字哇！||赞，好名字||yes，好名字||我用这个名字，土吗？
	                    ||这么怪怪的名字？....')
	                    ."\n   那,我以后就叫【" .$n ."】吧";
  
  return $msg;
}

function talkfunc_sweet($q)
{
	 
	 $img_url = 'http://www.itsweetie.com/template/default/imgs/logo.png';
	  $word = 'sweet factory';
	  $wordx = '好吃又好玩的糖果,正在促销中...';
	  $link = 'http://www.itsweetie.com/';
	  
	 $msg ='[news]';   
    $GLOBALS['msg_ext'][] = array('picurl'=> $img_url   ,'title'=> $word,'description'=> $wordx  ,'link'=> $link );
    
    return $msg;
}
function talkfunc_reboot($q)
{
	v2chatstatclr();
	return '环境已经重启，请重新聊天';
}
function talkfunc_meinv($q)
{
	$EXT_CMD = 'init';
	require_once('meinv/meinv.php');
	
	 getmeinv(0);
	
	return '[news]';
}

function talkfunc_translate($msg)
{ $msg=trim($msg);
  $p = mb_strpos($msg,'翻译');
  if($p < 0) return; 
  
  $p2 = mb_strpos($msg,' ',$p);
  if($p2 < 1) {$p2 = mb_strpos($msg,'　',$p);}
  if($p2 < 1) {$p2=$p; $nospace =true;}
  
  $msg = mb_substr($msg,$p2);
  $msg = trim($msg);
  
  $url = 'http://fanyi.youdao.com/translate?smartresult=dict&smartresult=rule&smartresult=ugc&sessionFrom=http://www.youdao.com/';
  $para['ext']['content']='type=AUTO&i='.urlencode($msg).'%0A&doctype=json&xmlVersion=1.6&keyfrom=fanyi.web&ue=UTF-8&typoResult=true&flag=false';
  $buf = http_request($url,$para);
  
  $p = mb_strpos($buf,'"tgt":"');
   if($p < 0) return;
   $p=$p+7;
  $p2 = mb_strrpos($buf,'"}');  
  $msg = mb_substr($buf,$p,$p2-$p);
	
	if($nospace){$msg .="\n---中英文互译，严格的消息格式：\n翻译 xxxxxxxxxxxwwww";}
	return $msg;
	
}
function talkfunc_talkruncmd($msg)
{ $us = getuserinfo();
	 
	if($us['talkid']=='sony')
	{ $EXT_MSG = $msg;
		$EXT_CMD = 'cmd';
		
		require_once('sony/main.php');
		$sony = new sony();	  
	  $rlt =  $sony->cmd($msg);		  
		return $rlt; 
	}
	
}
function talkfunc_sonyinit($msg)
{
    $EXT_MSG = $msg;
	  $EXT_CMD = 'init';
	  require_once('sony/main.php');
	  $sony = new sony();
	  
	  $rlt =  $sony->init();	
	  $rlt =  WELCOME_MSG. $rlt; 
	  
	  return    $rlt ;
    
}
function talkfunc_lucky($msg)
{
    $EXT_MSG = $msg;
	  $EXT_CMD = 'init';
	  return  require_once('lucky.php');
   
}
function replaceSpxWords($msg)
{
   
	$us = getuserinfo();
	if(!$us) 
	{$us['petname']='我';
	}
	$msgX = str_replace("%petname%", $us['petname'], $msg);
 
	return $msgX;
}


//替换答案 为新的内容
function specialAnswer($msg)
{
	/*$rpname = array('Xiao i'=>'%petname%',
                 '小i'=>'%petname%',
                 '小i机器人'=>'%petname%',
                 'xiaoi'=>'%petname%');
  */
   
  $rpname = array('Xiao i','小i',
                  '小i机器人','xiaoi','xiao','小ｉ','ｉ','小I');
  $msg = str_replace($rpname,'%petname%',$msg); 
  
  $Amatch  = array('9岁','地图','老i', '大i','MAX', '[link url','[/link]','"]');
  $Areplace= array('2岁','菜谱','老公','老婆','','<a href','</a>','">');
  
  
  $msg = str_replace($Amatch, $Areplace,$msg); 
  
  $us = getuserinfo();  
	if(!$us['petname']) 
	{ $us['petname']='我';
		//echo "\n===========".iconv('utf-8','gbk', $msg);
		if(mb_strpos($msg,'%petname%'))
	  { $msg.= "\n 我还没名字呢，发送: “ 改名xxx ”，就可以给我改名啦";
	  }
	}
	
	$msg = str_replace("%petname%", $us['petname'], $msg);
	
  $DA_HAHA = '嘿嘿...||哦/可爱||稍等，我先去尿尿||嘻嘻/亲亲||yes/鲜花||我没电了，先给我充电||哦，/大兵先去抽根烟||/吓地上有条虫
              ||呀！地上有个/瓢虫||呀！/吓手机上有个/瓢虫||/吓呀！地上有/便便||hehe/调皮||恩/憨笑||是的，吗||看/吓，有个野猴子
              ||对啊||o/调皮||ye/转圈||不聊这个||/傲慢知道昨晚下雨了吗？||刚才老板路过,说你偷懒了/冷汗||等下，我先去喝口水/咖啡
              ||呀/吓手机没电了啊||亲，给我来杯/咖啡||你的头像好好看呢||你的头像好漂漂呀/微笑||你什么时候换的头像？ 很赞呢';
  
  $WO_YE_BU_HUI = '这个俺不会呀，要不你问我别的事情||伦家不懂这个||听不懂耶/害羞||不明白||/吓地上有条虫||看/吓，有只野猴子
                   ||或许你换个说法我就懂了||换个说法,我可能就懂了||变着法地说我就能懂/害羞||看/吓，有个野猴子
                   ||。。那边有个女机器人，我去去就来||稍等，我先去尿尿||我肚子饿了，你先给我点吃的
                   ||我好像没电了，你先给我充电||等等，我去找只虫子/瓢虫||呀！！那边有个/瓢虫||别着急，我先去/便便很快回来
                   ||看，那边有头/猪头在飞||在你脸上画个猫猫||给我一只/瓢虫';
   
   $specailword = array(
   "/帮你在网上搜索下(.*?)/" => $WO_YE_BU_HUI ,	    
   "/帮助菜单(.*?)/" => '自由聊天，查询天气，故事，机票，翻译，百科，星座运程，菜谱....  ',  
   "/争做文明人(.*?)/" => '嘿嘿||/吓哦...||/害羞||好吧...||/流汗...||/委屈||/快哭了',
   "/是立足之本(.*?)/" => $DA_HAHA , 
   "/music放松一下(.*?)/" =>'嘿嘿||哦/可爱||恩||嘻嘻/亲亲||yes/鲜花||哈哈||/调皮||/憨笑',
   "/海宝博士(.*?)/" => '这个是机密啊/大兵||可以不告诉你吗/调皮||保密/可爱||嘿嘿，保密||我可以保持沉默吗？||国家机密/大兵||机器人档案里面查',
   "/附近的餐馆(.*?)/" => '给我一个蔬菜(鱼肉) 我就给你做一道拿手菜||我给你做点好吃的/爱你||想吃什么直接告诉我/大兵||我对食谱很有研究呢',
   "/语音(.*?)/" =>'其实，我听力不好||我不会语音聊天||我正在学，还不能听||我头上没有耳朵，没法听||我是收不到语音的||我听力不行，暂时只会文字',
   "/机器人不(.*?)吃/"=> '吃个鬼啊，没看到偶在忙吗||就知道问吃，我就是吃肥的||不肥不吃饭，肥了才吃||肚子这么大，还嫌不够肥吗||吃吃吃什么菜咧？
                  ||又聊吃，我太肥了||只有/饭，没有/啤酒，没调调||谁请谁吃饭？/呲牙||请回避，我正在/便便',
 
   "/这首歌(.*?)/"=> $DA_HAHA,
   "/一个胃出血(.*?)/"=> $DA_HAHA,
   "/胃出血(.*?)/"=> $DA_HAHA,
   "/理解能力有限(.*?)/"=> $WO_YE_BU_HUI,
   "/星座查询(.*?)/"=>'你可以，试试输入(金牛座 运势)，帮你看看今日的运程',
   "/星座配(.*?)/"=>'你可以，试试输入(金牛座 运势)，帮你看看今日的运程',
   "/座是(.*?)/"=> $msg ."\n----今日运势查询: 如，输入（金牛座 运势）",
   "/没有(.*?)机票/"=> $msg ."\n#可能是卖完了，请换个日期试试",
   "/我也(.*?)喜欢你/" =>"[XCALL]tucmd('改图=11=@@  用法举例: 改图=11=谁爱谁')||爱我你就/拥抱抱我||爱我你就/亲亲我",
  // "/我也(.*?)喜欢你/" =>"/可爱我也好喜欢你||我也爱你\n把我推荐给你的好朋友认识吧||爱我你就/拥抱抱我||爱我你就/亲亲我||我也爱你\n把我推荐给你的好朋友认识吧",
   "/已(.*?)查询到/" => $WO_YE_BU_HUI,
   "/来自于上海/" =>  '北京呀||首都||我来自北京欢迎您||我来自于我妈妈||我是土生土长的' ,
   "/可是我没(.*?)你给/" => '我不喜欢这个||我不需要||妈妈不让我瞎说',
   "/工作时间(.*?)聊天/" => '我就是喜欢和你聊天||我陪你聊||我陪你到明天||每天都陪你||陪你到老||聊到你没电为止',
   "/购物信息(.*?)/"=> $DA_HAHA,
   );
   
   foreach($specailword as $ask => $AS)
   {  
   	  if (preg_match($ask, $msg)) {
   	   if(substr($AS,0,7)=='[XCALL]')
   	   {
   	   	 $msg = $AS;
   	   }
       else
       {$msg = getrndAnswer($AS);
       }
       break;
     }
   }
   
   
   if(substr($msg,0,6)=='[CALL]')
   { $_call = 'return talkfunc_'.substr($msg,6).';';
   	 $msg = eval($_call);
   }
   if(substr($msg,0,7)=='[XCALL]')
   { $p = mb_strpos($msg,'||');
   	 $_call = 'return talkfunc_'.mb_substr($msg,7,$p-7).';';
   	 $param = getrndAnswer(mb_substr($msg,$p+2));
   	 //
   	 $_call = str_replace('@@',$param,$_call);
   	// return $_call;
   	 $msg = eval($_call);
   }
     
  if(trim($msg) == '....') 
  {return  getrndAnswer('我真心不懂a/衰||我不会啊/坏笑||不明白/委屈||回答不上/冷汗||不懂/委屈||理解不了/折磨||回答不上来/快哭了');
  }
	return $msg;
  
}

/*
$user = $GLOBALS['session_user'];
//$user = 'oPcagjpECN30MD-FjCKIbwYWgCjA';
if(is_file('ff.txt'))
{
	$fileline=file('ff.txt');
	$users = array();
	foreach($fileline as $v)
	{ $v = trim($v);
		if($v)
		{$users[]=$v;
		};		
	}
	
	//print_r($users);
	if(in_array($user,$users))
	{ 
		$cg2 = $users[array_rand($users)];
		$GLOBALS['session_user']= $cg2;
		$GLOBALS['session_reply'] = $q;
		 file_put_contents('ffx.txt', $user .'->'.$cg2.'  -----host:'. $GLOBALS['session_host'] ."\n",FILE_APPEND); 
		 
	}
}

if($q=='xx')
{  
      
  $GLOBALS['session_reply'] = "欢迎进入混乱模式:\n zz:退出 \n cc:换人 \n";
  $fileline=file('ff.txt');
	$users = array();
	foreach($fileline as $v)
	{ $v = trim($v);
		if($v==$user)
		{ $im_xx = 100;
			break;
		};		
	}
	if($im_xx < 1)
	{file_put_contents('ff.txt', $GLOBALS['session_user'] ."\n",FILE_APPEND);
	}
}
 
// echo '777777'.$user;
 
 //exit;
 */
?>