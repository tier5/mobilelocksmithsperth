<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
//$appId = '1669952783274041'; //Facebook App ID
//$appSecret = '69085904345d88c6a2f69205a9e8f114'; // Facebook App Secret

$appId = '234858623524856'; //Facebook App ID
$appSecret = '1ed4e282ed2a4da0fb7da2da73f32780'; // Facebook App Secret


$homeurl = 'http://www.lockrepairsperth.com.au/reviews/facebook';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
//print_r($fbuser);exit;
?>