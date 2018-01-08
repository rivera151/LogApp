<?php

class LogApp {
	public static $protocol = 'https://';
	public static $server = 'localhost/';
	public static $appName = 'LogApp';
	public static $serverDir = '~ricardo/LogApp/';
	public static $authConfig = 'client_secret_498659216388-koof0bg6eq3pbddecsbvhnpdejbiq3qo.apps.googleusercontent.com.json';
	public static $userInfoUrl = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=';
	public static $googleApiPhpClientPath = '/Users/ricardo/lib/google-api-php-client-2.2.1/vendor/autoload.php';

    public static $dbServer = 'localhost';
    // The variables below must match the values in setVars.psql
    public static $appUser = 'logappuser';
    public static $dbPW = 'AntarticaNosocomialBoobySyndrome';
	public static $dbName = 'logapp';
	
	const ADMIN_ROLE = 0;
	const USER_ROLE = 1;

	public static function getRootUrl() {
		return self::$protocol . self::$server . self::$serverDir;
	}
	
	public static function logout() {
	    // remember to call session_start() before call (at beginning, duh)
	    // session_start();
	    // Unset all of the session variables.
	    $_SESSION = array();
	    	    
	    // If it's desired to kill the session, also delete the session cookie.
	    // Note: This will destroy the session, and not just the session data!
	    if (ini_get("session.use_cookies")) {
	        $params = session_get_cookie_params();
	        setcookie(session_name(), '', time() - 42000,
	            $params["path"], $params["domain"],
	            $params["secure"], $params["httponly"]
	            );
	    }
	    
	    // Finally, destroy the session.
	    session_destroy();
	}
	
	public static function sessionVarIsNotDefinedOrNotEqualTo($sessionVarName, $equalTo) {
	    return (!isset($_SESSION[$sessionVarName]) || !$_SESSION[$sessionVarName] == $equalTo);
	}
	
	public static function noSessionEmailOrSessionEmailEmpty() {
	    return !isset($_SESSION['email']) || ($_SESSION['email'] == '');
	}
	
	public static function isRegularUserOrAdmin() {
	    return (isset($_SESSION['role']) ) ? (LogApp::isRegularUser() || LogApp::isAdminUser()) : FALSE;
	}
	
	public function isRegularUser() {
	    return (isset($_SESSION['role']) ) ? (LogApp::USER_ROLE == $_SESSION['role']) : FALSE;
	}
	
	public function isAdminUser() {
	    return (isset($_SESSION['role']) ) ? (LogApp::ADMIN_ROLE == $_SESSION['role']) : FALSE;
	}
}

?>
