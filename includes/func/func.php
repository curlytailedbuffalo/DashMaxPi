<?php
session_start();
include("includes/func/password.php");

function getConfig(){

    include("includes/config/config.php");
    return $mainConfig;
}

function checkPassword($given){
    $config = getConfig();
    if (password_verify($given, $config->password)) {
        return true;
    } else {
        return false;
    }
}

function checkUsername($given){
    $config = getConfig();
    if ($given == $config->username) {
        return true;
    } else {
        return false;
    }
}

function verifyUserPass($username, $password, $redirect){
    if(checkUsername($username) && checkPassword($password)){
        $_SESSION["loggedIn"] = true;
		$_SESSION["user"] = $username;
        header("Location: ../../" . $redirect);
    }else{
        return false;
    }
}

function isLoggedIn(){

    if($_SESSION["loggedIn"] != true){
        header("Location: ../../login.php");
    }else{
        return true;
    }
    
}

function getServiceList($alt = ".."){

    $myfile = fopen("includes/config/serviceList.txt", "r") or die("Unable to open file!");
    $myFileContents = fread($myfile,filesize("includes/config/serviceList.txt"));
    fclose($myfile);
    return json_decode($myFileContents, true);
}

function addToServiceList($newService){
    $serviceList = getServiceList();
    $serviceList[] = $newService;
    $myfile = fopen("includes/config/serviceList.txt", "w") or die("Unable to open file!"); 
    fwrite($myfile, json_encode($serviceList));
    fclose($myfile);
}

function removeFromServiceList($service){
    $serviceList = getServiceList();
    foreach($serviceList as $key=>$value){
        if (trim(strtolower($value)) == trim(strtolower($_POST["dropservice"]))){
            $removeKey = $key;
        }
    }
    unset($serviceList[$removeKey]);
    $myfile = fopen("includes/config/serviceList.txt", "w") or die("Unable to open file!"); 
    fwrite($myfile, json_encode($serviceList));
    fclose($myfile);
}

function getGooglePing(){

    $googlePingRaw = exec("ping google.com -c 1 | awk '/from/ {print $8}'");
    $googlePingArr = explode("=", $googlePingRaw);
    $pingTime1 = trim($googlePingArr[1]);
    
    $googlePingRaw = exec("ping google.com -c 1 | awk '/from/ {print $8}'");
    $googlePingArr = explode("=", $googlePingRaw);
    $pingTime2 = trim($googlePingArr[1]);
    
    $googlePingRaw = exec("ping google.com -c 1 | awk '/from/ {print $8}'");
    $googlePingArr = explode("=", $googlePingRaw);
    $pingTime3 = trim($googlePingArr[1]);
    
    $gtotal = $pingTime1 + $pingTime2 + $pingTime3;
    $avgPing = $gtotal / 3;
    
    return $avgPing;
}

?>