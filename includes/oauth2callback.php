<?php

	include_once 'LogApp.php';
	
	require_once LogApp::$googleApiPhpClientPath;

	session_start();

	$client = new Google_Client();

	$client->setAuthConfig( LogApp::$authConfig );

	$client->addScope(['email', 'profile']);
	$client->setRedirectUri( LogApp::getRootUrl() . 'includes/oauth2callback.php' );

	if (! isset($_GET['code'])) {
		$auth_url = $client->createAuthUrl();
		header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
	} else {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();
		$redirect_uri = LogApp::getRootUrl();
		header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	}

?>
