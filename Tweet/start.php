<?php

require './config.php';
require './tmhOAuth.php';
	
	 /////// upload the photo
	$img =  $_FILES["img"]["name"];	
	move_uploaded_file($_FILES["img"]["tmp_name"],
					  $img);
	 
	////////// generate *temp* access token and save it in cookie for callback page
	 $tmhOAuth = new tmhOAuth(array(
    'consumer_key'    => CVmDEjeLIK6ElKw5neLlg5Ip2,
    'consumer_secret' => mpIc3lRWWvd59WfpN8Wu30f62ctok4mr5N5OpbsUb9gQY37ei3,	
    'curl_ssl_verifypeer'   => false
  ));
   $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token', ''));
   $response = $tmhOAuth->extract_params($tmhOAuth->response["response"]);  
	

	$txt = $_POST['txt'];
	$temp_token = $response['oauth_token']; 
	$temp_secret = $response['oauth_token_secret']; 
	$time = $_SERVER['REQUEST_TIME'];
	
	setcookie("Temp_Token", $temp_token, $time + 3600 * 30, '/twitter_test/'); // '/twitter_test/' is the cookie path on your server 
	setcookie("Temp_Secret", $temp_secret, $time + 3600 * 30, '/twitter_test/'); 
	setcookie("Img_Url", $img, $time + 3600 * 30, '/twitter_test/'); 
	setcookie("Tweet_Txt", $txt, $time + 3600 * 30, '/twitter_test/');
	
	///////// redirect to twitter page for user authincation 
	$url = $tmhOAuth->url("oauth/authorize", "") . '?oauth_token=' . $temp_token;
    header("Location:".$url);  
	
    // after user give the required authrization he will be redirect to callback.php on your server
	
	
	exit();
	

  
?>
