<? 
 
function doevents($postObj){
	
   $func = 'event_'. $postObj->Event; 
  if(function_exists($func)){
    return $func($postObj, $postObj->EventKey);
  }else{
    return  "event: '" .$postObj->Event. "' is not  disposed. ";
  }   
}
 
function event_LOCATION($postObj, $EventKey=''){
	$Latitude = $postObj->Latitude;
    $Longitude = $postObj->Longitude;
    
    $msg= "坐标:($Latitude,$Longitude)";
    file_put_contents('pos.txt',$msg);
    return $msg;
}



function event_CLICK($postObj,$EventKey=''){
	$func = "menu_" .$EventKey;
     if(function_exists($func)){
       return $func();
     }else{
       return "menu '$EventKey' is not disposed";
     }
	
}
function event_VIEW($postObj,$EventKey=''){
	$url = $EventKey;
	return "you click:  $url";
}

 
?>