<?php
$time=1;
while($only){
	echo $time1.$time.$time2."\r\n";
	include "lib/login.php";
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
	curl_setopt($curl,CURLOPT_COOKIEFILE , dirname(__FILE__).'\logined.cookie');
	curl_setopt($curl, CURLOPT_URL, 'https://'.$hostname.'/api/v1/admin/server/manage/getNodes');
	$return = curl_exec($curl);
	$json = json_decode($return,true);
	for($i=0;$i<count($json['data']);$i++){
		if($json['data'][$i]['show']!=$json['data'][$i]['available_status']){
			if($json['data'][$i]['available_status']==0){
				curl_setopt($curl, CURLOPT_URL, 'https://'.$hostname.'https://apcloud.cloud/api/v1/admin/server/'.$json['data'][$i]['type'].'/update');
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('id'=>$json['data'][$i]['id'],'show'=>0)));
				curl_exec($curl);
					$text.=$json['data'][$i]['name']." ".$nodenotonline;
			} else {
				curl_setopt($curl, CURLOPT_URL, 'https://'.$hostname.'https://apcloud.cloud/api/v1/admin/server/'.$json['data'][$i]['type'].'/update');
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('id'=>$json['data'][$i]['id'],'show'=>1)));
				curl_exec($curl);
			}
		}
	}
	curl_close($curl);
	echo "检查完成\r\n";
	$time++;
	sleep($delay);
}
?>