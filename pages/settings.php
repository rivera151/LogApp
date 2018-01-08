<?php

include_once 'includes/LogApp.php';

if ( LogApp::noSessionEmailOrSessionEmailEmpty() || !LogApp::isRegularUserOrAdmin() ){
    print "Unauthorized Access.";
    die;
}

print '<h1>Welcome ' . $_SESSION['given_name'] . '!<br></h1>';

print "Your current rotation is: ";

?>