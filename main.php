<?php
include "config.php";
include "lib/lang/".$botlang.".php";
$only=true;
$issend=false;
if($botlang!="chinese" && $botlang!="english" && $botlang!="japanese" && $botlang!="vietnamese")
{
	echo "Lang Error";
	exit(0);
}
if($argv[1]=="used"){
  include "used.php";
} else
if($argv[1]=="traffic"){
  include "traffic.php";
} else 
if($argv[1]=="check"){
	$only=true;
  include "autounshow.php";
} else 
if($argv[1]=="help"){
	echo $allhelp;
} else 
if($argv[1]=="login"){
	include "lib/login.php";
} else
if($argv[1]=="all"){
	while(1){
		$only=false;
		include "used.php";
		sleep((int)(60-date("i"))*60+(60-date("s")));
		var_dump((int)(59-date("i"))*60+(60-date("s")));
		$traffictime=explode(":",$traffic_send_time);
		if($traffictime[0]<=date("H") &&$traffictime[1]<=date("i") &&$traffictime[2]<=date("s") && $issent == false){
			include "traffic.php";
			$issent=true;
		}
		if($traffictime[0]>=date("H") &&$traffictime[1]>=date("i") &&$traffictime[2]>=date("s") && $issent == true){
			$issent=false;
		}
		sleep(3600);
	}
} else {
  echo $help;
}
?>
