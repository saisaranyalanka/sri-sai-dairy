<?php
// continue the session
session_start();
// retrieve session data
// set time-out period (in seconds)
$inactive = 1200;

// check to see if $_SESSION["timeout"] is set
if (isset($_SESSION["timeout"])) {
    // calculate the session's "time to live"
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
        session_destroy();
       header("Location: /pp/dairy/");
    }
}
if (isset($_SESSION["ID"])=="" ||isset($_SESSION["NAME"])=="") {
	session_destroy();
       header("Location: /pp/dairy/");
}

$_SESSION["timeout"] = time();

?>