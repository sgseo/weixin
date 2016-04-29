<?php
/**
  * wechat php test
  */


//define your token 

 
	

error_reporting(E_ALL & ~E_NOTICE);

//exit( $_GET["echostr"]);
 
	define('WELCOME_MSG',"自由聊天，查询天气，故事,笑话，机票，翻译，百科，星座运程，菜谱....  ");


$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();
$wechatObj->responseMsg();

class wechatCallbackapiTest
{


    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
   
   /* $postStr='<xml><ToUserName><![CDATA[gh_5f14e9a94323]]></ToUserName>
<FromUserName><![CDATA[oPcagjtPBenClsqfJ-u39YvhM2i4]]></FromUserName>
<CreateTime>1365696014</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[我还不想睡]]></Content>
<MsgId>5865619716407561944</MsgId>
</xml>';*/
     
      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $myName = $postObj->ToUserName;
                $question = trim($postObj->Content);
                $time = $postObj->CreateTime;
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
							
							
						//	file_put_contents('debuglog.txt',$question, FILE_APPEND);
							
							
							$GLOBALS['session_user'] = $fromUsername ;
							$GLOBALS['session_host'] = $myName;
							$GLOBALS['weixin_openid'] = $fromUsername ;
							$GLOBALS['weixin_master'] = $myName;
						
						 //file_put_contents('log.txt', $postStr,FILE_APPEND);
							
							if( $postObj->MsgType =='text')
							{$Content = $this->freeQuestion($question);
							}
							else if( $postObj->MsgType =='event')
							{								
								require_once('event.php');
								$Content = doevents($postObj);
								
							}
							else if($postObj->MsgType =='image')
							{ 
								 require_once('face/face.php');
							}
							else if($postObj->MsgType =='location')
							{     $Content = "更新你的坐标:(".$postObj->Location_X .','. $postObj->Location_Y.')'
								      ."\r\n地理位置: " . $postObj->Label ;
								  //$Content =    
							}
							else if($postObj->MsgType =='voice')
							{
								$anwserList = array('我听不懂语音','你口音好重哇','我不会说话','我头上没耳朵呀，听不到',
								            '听不懂你口音','四川话我听不懂','我这里信号不好','我耳朵不好');
								$Content = $anwserList[rand(0,count($anwserList))]."\n 要不你【打字】给我吧";
								
								$question = $postObj->Recognition;
								/*$GLOBALS['msg_ext']['mediaID'] = $postObj->MediaId;
								$Content = '[voice]';
								*/
								//先回复语音
								$Content = $this->freeQuestion($question);
							}						
							
							
							
							
				   if(!empty( $Content ))
			        {
              		   $msgType = "text";
                	     
                	 
                	   if(substr($Content,0,6)=='[news]'){
                		 $data = $GLOBALS['msg_ext'];
                	     $resultStr = $this->makeXML('news',$data);                 	    
                       }else  { //普通文本
                     	  
                     	   if($postObj->MsgType =='voice')
                     	   {
                     	   	  require_once('tts.php');
	                     	  $voiceid = voiceID($Content);
	                     	  // file_put_contents('voice.txt', $voiceid, FILE_APPEND);
	                     	  if($voiceid) 
	                     	  {
	                     	  	    $Content="[voice]";
	                     	  	    $GLOBALS['msg_ext']['mediaID'] = $voiceid;     
	                     	  }
                     	  }
                     	 
                     	 if($Content!="[voice]")
                     	 {   $resultStr = sprintf($textTpl, $GLOBALS['session_user'], $myName, $time, $msgType, $Content);
                         }
                     	   
                    }
                       
                       
                       
                       
                     if(substr($Content,0,7)=='[voice]'){
                		 $data = $GLOBALS['msg_ext'];
                		
                	     $resultStr = $this->makeXML('voice',$data);
                	      
                     }
                     
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }
                
                

        }else {
             echo "";
            exit;
        }
    }
		
		public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	//echo $echoStr;
         	//exit;    
         	//OK     
        }
        else
        {//Fail 
         //	exit;
        }
    }
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = $GLOBALS["TOKEN"] ;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	private function freeQuestion($q)
	{ 
     /*
      $getQurl = 'http://biyike.scicompound.com/xiaoi/ixiao.php?q=' .urlencode($q);      
	     return file_get_contents($getQurl);	
	  */ 
	   $IS_XIAOI_INCLUDE =1;
     $_REQUEST['q'] = $q;   
     
    // return '系统维护中...';
      
     return  require_once('chat.php');
      
	}
	private function makeXML($msgType,$data)
	{
		 $time = time();
		 if($msgType =='text' )
		 {
		   $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
			 $resultStr = sprintf($textTpl, $GLOBALS['session_user'], $GLOBALS['session_host'], $time, $data);	
			 
		}else if($msgType =='news' )
		{
			 $count = count($data);
			 $resultStr = "<xml>
								 <ToUserName><![CDATA[".$GLOBALS['session_user']."]]></ToUserName>
								 <FromUserName><![CDATA[".$GLOBALS['session_host']."]]></FromUserName>
								 <CreateTime>".$time."</CreateTime>
								 <MsgType><![CDATA[news]]></MsgType>
								 <ArticleCount>".$count."</ArticleCount>
								 <Articles>";
				    foreach($data as $v)
				    {		$resultStr .= " 
								 <item>
								 <Title><![CDATA[" . $v['title'] . "]]></Title> 
								 <Description><![CDATA[" . $v['description']."]]></Description>
								 <PicUrl><![CDATA[" . $v['picurl']."]]></PicUrl>
								 <Url><![CDATA[" . $v['link']."]]></Url>
								 </item>";
								 
						}		 
						$resultStr .="</Articles>
								 <FuncFlag>0</FuncFlag>
								 </xml> 
								";
	 
						 
		}	else if($msgType =='voice' )
		{
			 
			 $resultStr ="<xml>
						 <ToUserName><![CDATA[".$GLOBALS['session_user']."]]></ToUserName>
						 <FromUserName><![CDATA[".$GLOBALS['session_host']."]]></FromUserName>
						 <CreateTime>".$time."</CreateTime>
						 <MsgType><![CDATA[voice]]></MsgType>
						 <Voice>
						<MediaId><![CDATA[". $data['mediaID'] ."]]></MediaId>
						</Voice>
						 </xml>";
			
		}
		
		return 	$resultStr;
							
	}
	
	

        
}

?>