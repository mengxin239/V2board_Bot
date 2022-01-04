<?php
$uname=explode('@',$admin_username);
$admin_username=$uname[0].'%40'.$uname[1];
exec("curl -s https://".$hostname."/api/v1/passport/auth/login -X POST -d 'email=".$admin_username."&password=".$admin_password."' -c logined.cookie",$a);
?>
