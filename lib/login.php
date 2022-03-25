<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
curl_setopt($ch, CURLOPT_URL, 'https://'.$hostname.'/api/v1/passport/auth/login');
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__, 2).'\logined.cookie');
$postdata=http_build_query(array('email'=>$admin_username,'password'=>$admin_password));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
if($debug==true){
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		send(make($chat_id,'Errno'.curl_error($ch)));
	}
} else {
	curl_exec($ch);
}
curl_close($ch);
?>
