<?php
	// Creating a session to store data that will be used on several pages of the site
    session_start();
    // Deleting all registered variables of the current session
	session_unset();
	// End of session
	session_destroy();
	// Transition to home page
	header("Location: index.php");
?>