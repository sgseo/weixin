<?
error_reporting(E_ALL & ~E_NOTICE);

require_once('HTTP.php');

function voiceID($text){
	
$WATER_APPID= 'wx33b752f7ad7c8890';
$WATER_APPSECRET = 'f12e7300e4cdddb98442ad12802b2901';
 
	// file_put_contents('voice.txt', 'voiceID', FILE_APPEND);
	$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$WATER_APPID.'&secret='.$WATER_APPSECRET;
	$json = http($url);
	 //file_put_contents('voice.txt', $json, FILE_APPEND);
	$json = json_decode($json);
	$Token = $json->access_token;
	
	 //var_dump($json);
	if(!$Token)  return;
	// file_put_contents('voice.txt', $Token, FILE_APPEND);
	 
	 
	$buf = file_get_contents(tts($text));
	$vpath = 'tmp/'.md5($text).'.mp3';
	file_put_contents($vpath, $buf);
	
	//  file_put_contents('voice.txt', $vpath, FILE_APPEND);
 
	 //$json = uploadMedia($vpath, $Token);
	 $json = uploadbyhttp($vpath, $Token);
	
    $json = json_decode($json);
	$mediaID = $json->media_id;
	//file_put_contents('voice.txt', $mediaID, FILE_APPEND);
	if($mediaID) return $mediaID;
}

function tts($text){
	//202 girl 203 man,  from http://www.neospeech.com/
	$url = "http://208.109.168.116/GetAudio1.ashx?speaker=203&content=" . urlencode($text);
	$url = "http://208.109.168.116/GetAudio1.ashx?speaker=202&content=" . urlencode($text);
	
 $url = "http://translate.google.cn/translate_tts?ie=UTF-8&tl=zh-CN&q=" . urlencode($text);
	
	return $url;
}
function uploadbyhttp($vpath, $Token){
	 $url ="http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=".$Token."&type=voice";
	 
	$para['Referer']='http://localhost/sweet/test.htm.php';
$para['Accept-Language']='en-US';
 
$para['User-Agent']='Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; chromeframe/32.0.1700.107; SLCC2; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; InfoPath.2; .NET4.0E)';
$para['Accept-Encoding']='gzip, deflate';
$para['Host']='file.api.weixin.qq.com';
//$para['Content-Length']='3092';
//$para['Connection']='Keep-Alive';
//$para['Cache-Control']='no-cache'; 
 
	$para['ext']['files'] = array( 'userfile'=> $vpath);
	//$para['ext']['fields'] = array('media'=>  '@'. $vpath);
	return http($url, $para);
}
function uploadMedia($file1, $Token){
        $file = realpath($file1); //要上传的文件
        $fields['media'] = '@'.$file;
        
        $url ="http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=".$Token."&type=voice";
        $ch = curl_init($url) ;
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //curl_setopt($ch, CURLINFO_BODY_OUT, true);
        
        $result = curl_exec($ch) ;
        if (curl_errno($ch)) {
         return curl_error($ch);
        }
        
        // var_dump(  curl_getinfo( $ch, CURLINFO_BODY_OUT));
        
        curl_close($ch);
        return $result;
    }