<?php
function getIP() 
{ 
global $ip; 
if (getenv("HTTP_CLIENT_IP")) 
$ip = getenv("HTTP_CLIENT_IP"); 
else if(getenv("HTTP_X_FORWARDED_FOR")) 
$ip = getenv("HTTP_X_FORWARDED_FOR"); 
else if(getenv("REMOTE_ADDR")) 
$ip = getenv("REMOTE_ADDR"); 
else $ip = "Unknow"; 
return $ip; 
} 

function cn_substr_utf8($str, $length, $start=0) 
{ 
if(strlen($str) < $start+1) 
{ 
return ''; 
} 
preg_match_all("/./su", $str, $ar); 
$str = ''; 
$tstr = ''; 
//为了兼容4.1以下版本,与varchar一致,这里使用按字节截取 
for($i=0; isset($ar[0][$i]); $i++) 
{ 
if(strlen($tstr) < $start) 
{ 
$tstr .= $ar[0][$i]; 
} 
else 
{ 
if(strlen($str) < $length + strlen($ar[0][$i]) ) 
{ 
$str .= $ar[0][$i]; 
} 
else 
{ 
break; 
} 
} 
} 
return $str; 
} 

?>