<?php

$file_dir_name = dirname(__FILE__); 
include_once ("$file_dir_name/ini.php");
include_once ("$file_dir_name/module_config.php");



//echo "The system is under maintenance please contact administrator or try later.";


AfwMainPage::echoMainPage($MODULE);

?>