<?php

require_once('HTTP.php');
$url = 'http://shequ.huizhou.cn/Survey/SaveSurvey.asp';
$para['ext']['content'] = 'SurveyID=452&Q1583=11863';

$count = 1;

for($i=0;$i < $count; $i++)
{ echo http_request($url,$para);
}
echo '增加:'.$count;

$buf = file_get_contents('http://shequ.huizhou.cn/survey/getResault.asp?AID=11863&QID=1583&RID=452');

$buf = '<br>当前：'.strtr($buf,array('document.write'=>''));

echo $buf;
?>票