<?php
session_start();

//Destroy the session: this removes all session variables
session_destroy();

//Redirect the user to the login page
header("Location: ../index.php");
?>