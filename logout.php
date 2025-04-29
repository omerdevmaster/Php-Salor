<?php
// Start session
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to signup page or login page
header("Location: login_form.php");
exit();
?>
