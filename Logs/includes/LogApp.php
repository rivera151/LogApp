<?php

class LogApp {

	public static $protocol = 'https://';
	public static $server = 'localhost/';
	public static $serverDir = '~ricardo/Logs/';
	public static $authConfig = 'client_secret_498659216388-koof0bg6eq3pbddecsbvhnpdejbiq3qo.apps.googleusercontent.com.json';
	public static $userInfoUrl = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=';
	public static $googleApiPhpClientPath = '/Users/ricardo/lib/google-api-php-client-2.2.1/vendor/autoload.php';

	public static function getRootUrl() {

		return self::$protocol . self::$server . self::$serverDir;

	}
	
	
}

?>
