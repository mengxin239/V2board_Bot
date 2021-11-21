<?php
include "config.php";
include "lib/lang/".$lang.".php";
if($lang!=chinese && $lang!=english && $lang!=japanese && $lang!=vietnamese)
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
if($argv[1]=="help"){
	echo $allhelp
}else
{
  echo $help;
}
?>
