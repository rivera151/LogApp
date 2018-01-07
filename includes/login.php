<?php
    session_start();
	include_once 'LogApp.php';
	include_once 'DataHelper.php';
    include_once 'LoggedOffException.php';
	require_once LogApp::$googleApiPhpClientPath;
	
	$client = new Google_Client();

	$client->setAuthConfig( 'includes/'. LogApp::$authConfig );

	$client->addScope(['email', 'profile']);

	unset($at);
	if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		$at = $_SESSION['access_token'];
		$client->setAccessToken($at);
		$uia = getUserInfoArray();
		
		$email = $uia['email'];
		
		try {
		    $dh = new DataHelper($email);
		}
		catch (LoggedOffException $e) {
		    
		    print "login.php: $e";
		    die();
		}
		
		$_SESSION['email'] = $email;
		$_SESSION['given_name'] = $uia['given_name'];
		$_SESSION['family_name'] = $uia['family_name'];

	} else {
		$redirect_uri = LogApp::getRootUrl() . 'includes/oauth2callback.php';
		header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	}

	function getUserInfoArray() {
		$at = $_SESSION['access_token'];
		$q = LogApp::$userInfoUrl . $at['access_token'];
		$json = file_get_contents($q);
		return json_decode($json,true);
	}

?>
