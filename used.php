<?php
include "lib/init.php";
include "lib/login.php";
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
curl_setopt($curl, CURLOPT_COOKIEFILE , dirname(__FILE__).'\logined.cookie');
curl_setopt($curl, CURLOPT_URL,"https://".$hostname."/api/v1/admin/server/manage/getNodes");
$return = curl_exec($curl);
curl_close($curl);
$json=json_decode($return,true);
$text=$name.$usedtext."\n";
if($show_poweredby){
    $text.="Powered By MengXin";
}
for($i=0;$i<count($json['data']);$i++){
    if($json['data'][$i]['show']!=null){
        if($json['data'][$i]['parent_id']==null){
            if($json['data'][$i]['online']==null){
		    if($json['data'][$i]['availale_status']==null){
				if($only){
					$text.="\n".$json['data'][$i]['name']." ".$shit;
				}
			    } else {
		   	 $text.="\n".$json['data'][$i]['name']." ".$onlinetext.":0";
		    }
            } else {
                $text.="\n".$json['data'][$i]['name']." ".$onlinetext.":".$json['data'][$i]['online'];
            }
        } else {
		
            if($json['data'][$json['data'][$i]['parent_id']]['online']==null){
		    if($json['data'][$i]['availale_status']==null){
				if($only){
					$text.="\n".$json['data'][$i]['name']." ".$shit;
				}
			    } else {
		   	 $text.="\n".$json['data'][$i]['name']." ".$onlinetext.":0";
		    }
            } else {
                $text.="\n".$json['data'][$i]['name']." ".$onlinetext.":".strval($json['data'][strval($json['data'][$i]['parent_id'])]['online']);
            }
        }
    }
}
send(make($chat_id,$text));
?>
