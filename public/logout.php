<?php
session_start();
session_destroy();
header("Location:/m6/public/login.php");
?>