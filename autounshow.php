<?php
include "lib/init.php";
include "config.php";
$time=1;
while(1){
	echo "第".$time."次检查节点\r\n";
	include "lib/login.php";
	exec("curl --socks5 127.0.0.1:10808 -s https://".$hostname."/api/v1/admin/server/manage/getNodes -b logined.cookie",$return);
	$json=json_decode($return[0],true);
	for($i=0;$i<count($json['data']);$i++){
		if($json['data'][$i]['available_status']==0){
			exec("curl -s https://apcloud.tk/api/v1/admin/server/v2ray/update -b logined.cookie -X POST -d \"id=".$json['data'][$i]['id']."&show=0\"");
		} else {
			exec("curl -s https://apcloud.tk/api/v1/admin/server/v2ray/update -b logined.cookie -X POST -d \"id=".$json['data'][$i]['id']."&show=1\"");
		}
	}
	echo "检查完成\r\n";
	$time++;
	sleep(10);
}
?>
