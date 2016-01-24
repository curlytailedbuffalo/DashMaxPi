<?php
session_start();
include("includes/func/password.php");

function getConfig(){

    include("includes/config/config.php");
    return $mainConfig;
}

function passwordMaker($password){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $hash;
}

function checkPassword($given, $actual){
    if (password_verify($given, $password)) {
        return true;
    } else {
        return false;
    }
}

function checkUsername($given, $actual){
    
    if ($given == $actual) {
        return true;
    } else {
        return false;
    }
}

function verifyUserPass($username, $password, $redirect){
    $config = getConfig();
    if(checkUsername($username, $config->username) && checkPassword($password, $config->password)){
        if(loadConfig($config)){
            $_SESSION["loggedIn"] = true;
        }
        header("Location: " . $redirect);
    }else{
        return false;
    }
}

function loadConfig($config){

    $_SESSION['username'] = $config->username;
    $_SESSION['enable_ping'] = $config->enable_ping;
    return true;
}
function isLoggedIn(){

    if($_SESSION["loggedIn"] != true){
        header("Location: login.php");
    }else{
        return true;
    }
    
}

function logout(){
    unset($_SESSION["loggedIn"]);
    unset($_SESSION["user"]);
    header("Location: index.php");
}
function getServiceList(){

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
    return json_encode($serviceList);
}

function getGooglePing(){

    $googlePingRaw = exec("ping google.com -c 1 | awk '/from/ {print $8}'");
    $googlePingArr = explode("=", $googlePingRaw);
    $pingTime1 = trim($googlePingArr[1]);
    
    if($pingTime1 < 20){
        return $pingTime1;
    }
    
    $googlePingRaw = exec("ping google.com -c 1 | awk '/from/ {print $8}'");
    $googlePingArr = explode("=", $googlePingRaw);
    $pingTime2 = trim($googlePingArr[1]);
    
    $googlePingRaw = exec("ping google.com -c 1 | awk '/from/ {print $8}'");
    $googlePingArr = explode("=", $googlePingRaw);
    $pingTime3 = trim($googlePingArr[1]);
    
    if($pingTime1 < $pingTime2 && $pingTime1 < $pingTime3){
        return $pingTime1;
    }else if($pingTime2 < $pingTime1 && $pingTime2 < $pingTime3){
        return $pingTime2;
    }else{
        return $pingTime3;
    }
   
}

?>