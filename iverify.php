<?php

 
    function r() {
        return '3.141592653589793' . "I";
    }
    function c() {
        return "no";
    }
    function i($k) {
    	 
        return h(g(t($k)));
    }
    function g($N) {
    	// echo "\n========[[[[[[[[".join(',',$N)."]]]]]]]]]]]]";
        $K = $N;
        $L = array();
        $J = 1732584193;
        $I = -271733879;
        $H = -1732584194;
        $G = 271733878;
        $F = -1009589776;
        for ($C = 0; $C < count($K); $C += 16) {
            $E = $J;
            $D = $I;
            $B = $H;
            $A = $G;
            $k = $F;   
            for ($z = 0; $z < 80; $z++) {
                if ($z < 16) {
                    $L[$z] = $K[$C + $z];
                } else {
                    $L[$z] = o($L[$z - 3] ^ $L[$z - 8] ^ $L[$z - 14] ^ $L[$z - 16], 1);
                }
                $M = u(u(o($J, 5), x($z, $I, $H, $G)), u(u($F, $L[$z]), l($z)));
                $F = $G;
                $G = $H;
                $H = o($I, 30);
                $I = $J;
                $J = $M;
            }
            $J = u($J, $E);
            $I = u($I, $D);
            $H = u($H, $B);
            $G = u($G, $A);
            $F = u($F, $k);
          
        }
        
        $rlt =  array($J, $I, $H, $G, $F);
       
        return $rlt ;
    }
    function x($z, $k, $B, $A) {
        if ($z < 20) {
            return ($k & $B) | ((~$k) & $A);
        }
        if ($z < 40) {
            return $k ^ $B ^ $A;
        }
        if ($z < 60) {
            return ($k & $B) | ($k & $A) | ($B & $A);
        }
        return $k ^ $B ^ $A;
    }
    function l($k) {
        return ($k < 20) ? 1518500249 : (($k < 40) ? 1859775393 : (($k < 60) ? -1894007588 : -899497514));
    }
    function u($k, $B) {
        $A = ($k & 65535) + ($B & 65535);
        $z = ($k >> 16) + ($B >> 16) + ($A >> 16);
        return ($z << 16) | ($A & 65535);
    }
    function o($k, $z) {
    	//echo ("oooooooo" . $k . ',' .$z."oooooooooo\n");
    	    $left = ($k << $z);
        	$right = shr32($k ,(32 - $z));
        
        return ($k << $z) | ( shr32($k ,(32 - $z)));
           


        //return ($k << $z) | ($k >>> (32 - $z));
    }
    function t($A) {
        $k = ((strlen($A) + 8) >> 6) + 1;
        
        $B = array();
        for ($z = 0; $z < $k * 16; $z++) {
            $B[$z] = 0;
        }
        
        for ($z = 0; $z < strlen($A); $z++) {
            $B[$z >> 2] |= charCodeAt($A,$z) << (24 - ($z & 3) * 8);
        }
        
        $B[$z >> 2] |= 128 << (24 - ($z & 3) * 8);
        $B[$k * 16 - 1] = strlen($A) * 8;
        return $B;
    }
    function h($A) {
        $z = "0123456789abcdef";
        $B = "";
        for ($k = 0; $k < count($A) * 4; $k++) {
            $B .= substr($z,($A[$k >> 2] >> ((3 - $k % 4) * 8 + 4)) & 15, 1) . substr($z,($A[$k >> 2] >> ((3 - $k % 4) * 8)) & 15,1);
        }
        //echo '//'.$B;
        return $B;
    }
    function f($E) {
    	 
         
        $B = explode(";" , $GLOBALS['cookie']);
       // print_r($B);
        for ($A = 0; $A < count($B); $A++) {
            $C = $B[$A];
            $k = strpos($C,"=");
            $z = trim(substr($C,0, $k));
            $D = trim(substr($C,$k + 1));
          // echo "==$E,$z=   ";
             $z = str_replace("/^\s+|\s+$/g", "", $z);   
          // echo "--$E,$z-   ";          
            if ($z == $E) {
            	  //echo unescape($D) .'---------';
                return unescape($D);
            }
        }
    }
    function b() {
        return "n";
    }
    function s($z, $k) {
        $GLOBALS['cookie'] .= '; '.($z . "=" . escape($k));
        //echo "\n ---".  $GLOBALS['cookie'];
    }
    function a() {
        return "ce";
    }
    function m($z) {
        $B = "";
        $C = substr(r(),0, 7);
        
        for ($A = 0; $A < strlen($C); $A++) {
            $D = substr($C,$A,1);
            if ($D != ".") {
                $B = $D . $B;
            }
        }
        
        return i($z . $B);
    }
    function p() {
        return c() . b() . a();
    }
    
   
   
function makesigvalue()
{
    $w = f(p());
  
    if (1) {
        $y = "" .  ceil(rand(100000, 899999));
       //$y = '128617';
      // $y = '452607';
       s("cnonce", $y);
         
        s("sig", i(m($w) . $y));
    }
    $q = f("cvisits");
    $d = time().'000';
    //$d = '1365514676040';
    $n = 0;
    $v = 0;
    /*
    if ($q) {
    	//echo  "==$q===";
        $j = split($q,",");
        $v = ($j[0]);
        $n = ($j[1]);
        if ($d - $n < 500) {
            $v++;
        } else {
            $v = 0;
        }
        if ($v > 5) {
            //false;
        }
    }*/
    
    s("cvisits", $v . "," . $d);
 
 // sig=67a9eecbb831dedfa9adbe16b17b3333945d2d75;
  
    $GLOBALS['cookie'] = strtr($GLOBALS['cookie'], array('xx_cookie_end=xx_end;'=>''));
}

    
 
function escape($str) { 
	return urlencode($str);
	
preg_match_all("/[\x80-\xff].|[\x01-\x7f]+/",$str,$r); 
$ar = $r[0]; 
foreach($ar as $k=>$v) { 
if(ord($v[0]) < 128) 
$ar[$k] = rawurlencode($v); 
else 
$ar[$k] = "%u".bin2hex(iconv("GB2312","UCS-2",$v)); 
} 
return join("",$ar); 
}  
 
function unescape($str) { 
	return urldecode($str);
	
$str = rawurldecode($str); 
preg_match_all("/(?:%u.{4})|.+/",$str,$r); 
$ar = $r[0]; 
foreach($ar as $k=>$v) { 
if(substr($v,0,2) == "%u" && strlen($v) == 6) 
$ar[$k] = iconv("UCS-2","GB2312",pack("H4",substr($v,-4,1))); 
} 
return join("",$ar); 
} 
 
function charCodeAt($str,$pos)
{
	return unicode(substr($str, $pos,1));
}
 
function c_substr($string, $from, $length = null){//截取字符串
     preg_match_all('/[\x80-\xff]?./', $string, $match);
     if(is_null($length)){
         $result = implode('', array_slice($match[0], $from));
     }else{ 
         $result = implode('', array_slice($match[0], $from, $length)); 
     } 
     return $result;
}

function unicode($code){//转换成unicode编码
	
	return ord ($code);
	
	
preg_match_all("/[\x80-\xff]?./",$code,$ar);
print_r($ar);
$c='';
for($i=1;$i<count($ar);$i++){
 $c=$c."&#".utf8_unicode( ( $v)).";";
 }
//echo $c .'>';
return $c;
}

 
 


  $pp=   array(5353543,-5351376,36645768,-9946587,23452453);
for($i=0;$i<5;$i++)
{
   //echo "\n**************".join( ',',g(t($pp[$i]) )   )."\n" ; 	
  //    echo "\n**************".l($pp[$i]) ."\n" ; 	
 
}

 



 /**  3. * 无符号32位右移  
4. * @param mixed $x 要进行操作的数字，如果是字符串，必须是十进制形式  
5. * @param string $bits 右移位数  
6. * @return mixed 结果，如果超出整型范围将返回浮点数  
7. */  
 function shr32($x, $bits){   
	    // 位移量超出范围的两种情况  
	      
    if($bits >= 32 || $bits < 0){   
    	$bits = $bits%32;
    	 // return 0;   
     }   
    //转换成代表二进制数字的字符串   
     $bin = decbin($x);   
    $l = strlen($bin);   
    //字符串长度超出则截取底32位，长度不够，则填充高位为0到32位   
    if($l > 32){   
        $bin = substr($bin, $l - 32, 32);   
    }elseif($l < 32){   
        $bin = str_pad($bin, 32, '0', STR_PAD_LEFT);   
    }   
    //取出要移动的位数，并在左边填充0
    $rlt = bindec(str_pad(substr($bin, 0, 32 - $bits), 32, '0', STR_PAD_LEFT));
    return sprintf('%u',$rlt);
}   
/**  
 * 无符号32位左移  
 * @param mixed $x 要进行操作的数字，如果是字符串，必须是十进制形式  
 * @param string $bits 左移位数  
 * @return mixed 结果，如果超出整型范围将返回浮点数  
 */  
function shl32 ($x, $bits){   
    // 位移量超出范围的两种情况
    if($bits <= 0){
        return $x;   
    }   
    if($bits >= 32){   
        return 0;   
    }   
    //转换成代表二进制数字的字符串   
    $bin = decbin($x);   
    $l = strlen($bin);   
    //字符串长度超出则截取底32位，长度不够，则填充高位为0到32位   
    if($l > 32){   
        $bin = substr($bin, $l - 32, 32);  
    }elseif($l < 32){   
        $bin = str_pad($bin, 32, '0', STR_PAD_LEFT);   
    }   
    //取出要移动的位数，并在右边填充0   
    return bindec(str_pad(substr($bin, $bits), 32, '0', STR_PAD_RIGHT));   
}  


?>