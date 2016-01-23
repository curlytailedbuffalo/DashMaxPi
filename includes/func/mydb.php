<?php
$dbhost="192.168.24.11";
$dbuser="xbmc";
$dbpass="xbmc";
$dbdb1="testing_tables";
$dbdb2="MyVideos90";
$dbdb3="MyMusic48";
	

function getDBConnectionT(){
	global $dbhost, $dbuser, $dbpass, $dbdb1;

	return new MySQLi($dbhost, $dbuser, $dbpass, $dbdb1);
}
function getDBConnectionV(){
	global $dbhost, $dbuser, $dbpass, $dbdb2;

	return new MySQLi($dbhost, $dbuser, $dbpass, $dbdb2);
}
function getDBConnectionM(){
	global $dbhost, $dbuser, $dbpass, $dbdb3;

	return new MySQLi($dbhost, $dbuser, $dbpass, $dbdb3);
}
?>
