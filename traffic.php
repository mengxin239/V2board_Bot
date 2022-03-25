<?php
include "lib/init.php";
include "lib/login.php";
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
curl_setopt($curl, CURLOPT_COOKIEFILE , dirname(__FILE__).'\logined.cookie');
curl_setopt($curl, CURLOPT_URL,"https://".$hostname."/api/v1/admin/stat/getServerLastRank -b logined.cookie");
$return = curl_exec($curl);
curl_close($curl);
$json=json_decode($return[0],true);
$text=$name.$trafficinfo."\n";
if($show_poweredby){
    $text.="Powered By MengXin";
}
for($i=0;$i<count($json['data']);$i++){
    $text.="\n".$nodename."：".$json["data"][$i]["server_name"].
           "\n".$nodetotal."：".round($json["data"][$i]["total"], 7)." GB\n";
}
send(make($chat_id,$text));
?>
