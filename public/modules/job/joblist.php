<?php
session_start();
require_once '../../../includes/autoload.php';

//use classes\business\UserManager;
//use classes\entity\User;

ob_start();
include '../../../includes/security.php';

//$UM=new UserManager();
//$users=$UM->getAllUsers();

//if(isset($users)){
?>
<html>
    <head> 
        <title>Job</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; Job
            </p>
            <br/><h3>Sorry! Page under construction.<h3><br/>

        <?php include '../../../includes/footer.php'; ?>