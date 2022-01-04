<?php
include "lib/init.php";
include "lib/login.php";
exec("curl -s https://".$hostname."/api/v1/admin/server/manage/getNodes -b logined.cookie",$return);
$json=json_decode($return[0],true);
for($i=0;$i<count($json['data']);$i++){
    if($json['data'][$i]['show']!=null){
        if($json['data'][$i]['parent_id']==null){
            if($json['data'][$i]['online']==null){
		    if($json['data'][$i]['availale_status']==null){
                exec('curl -s https://apcloud.tk/api/v1/admin/server/v2ray/update -b logined.cookie -X POST \'id='.$json['data'][$i]['id'].'&show=0\'')
			    } else {
		   	 $text.="\n".$json['data'][$i]['name']." ".$onlinetext.":0";
		    }
            } else {
                $text.="\n".$json['data'][$i]['name']." ".$onlinetext.":".$json['data'][$i]['online'];
            }
        } else {
		
            if($json['data'][$json['data'][$i]['parent_id']]['online']==null){
		    if($json['data'][$i]['availale_status']==null){
                exec('curl -s https://apcloud.tk/api/v1/admin/server/v2ray/update -b logined.cookie -X POST \'id='.$json['data'][$i]['id'].'&show=0\'')
			    } else {
		   	 $text.="\n".$json['data'][$i]['name']." ".$onlinetext.":0";
		    }
            } else {
                $text.="\n".$json['data'][$i]['name']." ".$onlinetext.":".strval($json['data'][strval($json['data'][$i]['parent_id'])]['online']);
            }
        }
    }
}
?>
