<?php
 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
       // last request was more than 5 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
		header("Location:./index.php");
		//exit();
	
	}

    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


    if (!isset($_SESSION['CREATED'])) {
        $_SESSION['CREATED'] = time();
    } else if (time() - $_SESSION['CREATED'] > 1200) {
        // session started more than 5 minutes ago
        session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
        $_SESSION['CREATED'] = time();  // update creation time
    }


?>