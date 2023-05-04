<?php
require_once("../Classes/Users.php");
// require_once("../Classes/SessionLogs.php");
session_start();
// update user is offline
$objUsers = new Users();

if(session_destroy())
{
header("Location: ../index.php");
}

?>
