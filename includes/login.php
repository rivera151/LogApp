<?php
    session_start();

	include_once 'LogApp.php';
	include_once 'DataHelper.php';
    include_once 'LoggedOffException.php';
	require_once LogApp::$googleApiPhpClientPath;	
	
	$client = '';
	
	try {
	
	   $client = new Google_Client();
    
	   $client->setAuthConfig( 'includes/' . LogApp::$authConfig );
	
	} catch (Exception $e ) {
	    print '<pre>login.php: ' . $e->getMessage() . '</pre>';  
	}

	$client->addScope(['email', 'profile']);

	unset($at);
	if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		$at = $_SESSION['access_token'];
		$client->setAccessToken($at);
	    if ($client->isAccessTokenExpired()) 
	        $client->refreshToken($at);
		$uia = getUserInfoArray();
		
		$email = $uia['email'];
		
		$dh = '';
		
		try {
		    $dh = new DataHelper();
		    $dh->getUserInfo($email);
		}
		catch (LoggedOffException $e) {
		    LogApp::logout();
		    print "You are either logged out or are not authorized to view this content. <br>";
		    print "Return to the start page <a href=default.php>here</a> to log in.";
		    // @TODO: revoke LogApp privileges from google 
		    die();
		}
		
		$_SESSION['email'] = $email;
		$_SESSION['given_name'] = $uia['given_name'];
		$_SESSION['family_name'] = $uia['family_name'];
		$_SESSION['role'] = $dh->getRole();

	} else {
		$redirect_uri = LogApp::getRootUrl() . 'oauth2callback.php';
		header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	}

	function getUserInfoArray() {
		$at = $_SESSION['access_token'];
		$q = LogApp::$userInfoUrl . $at['access_token'];
		$json = file_get_contents($q);
		return json_decode($json,true);
	}

?>
