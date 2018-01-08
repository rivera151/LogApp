<?php

	include_once 'includes/LogApp.php';
	
	require_once LogApp::$googleApiPhpClientPath;

	session_start();

	$client = new Google_Client();

	$client->setAuthConfig( 'includes/' . LogApp::$authConfig );

	$client->addScope(['email', 'profile']);
	$client->setRedirectUri( LogApp::getRootUrl() . 'oauth2callback.php' );

	if (! isset($_GET['code'])) {
		$auth_url = $client->createAuthUrl();
		header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
	} else {
		$client->authenticate($_GET['code']);
		$at = $client->getAccessToken();
		if ($client->isAccessTokenExpired())
		    $client->refreshToken($at);
		$at = $client->getAccessToken();
		$_SESSION['access_token'] = $at;
		$redirect_uri = LogApp::getRootUrl() . 'default.php';
		header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	}

?>
