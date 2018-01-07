<?php 
session_start();
// Unset all of the session variables.
$_SESSION = array();

// TODO:  I need to make this a function in the App class, so I can call it from a page after said page determines the user needs to be denied access to the content

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
?>
