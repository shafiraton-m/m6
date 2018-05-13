<?php
session_start();
require_once '../../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../../includes/security.php';
?>

<?php

$formerror  = "";
$deleteflag = false;
$firstName  = "";
$lastName   = "";

$UM = new UserManager();
$existuser = $UM->getUserById($_GET["id"]);
$firstName = $existuser->firstName;
$lastName  = $existuser->lastName;
$email      = $existuser->email;
$role      = $existuser->role;
$name      = $firstName." ".$lastName;

if(isset($_POST["submitted"])) {
    if(isset($_GET["id"])) {
        $UM->deleteAccount($_GET["id"]);
        $formerror = "<font color = 'green'>User deleted successfully.</font>";
        $deleteflag = true;
    }
} else if(isset($_POST["cancelled"])) {
    header("Location:userlistadmin.php");
}
?>
<html>
    <head> 
        <title>Delete User Confirmation</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp;<a href='userlistadmin.php'>Administer User</a>
                &nbsp;&#187;&nbsp; Delete User
            </p>
            <br>
            <form name = "deleteUser" method = "post" 
                class = "pure-form pure-form-stacked">
                <h3><b>Delete User</b></h3>
                <div><?=$formerror?></div>
<?php
if (!$deleteflag && $role != "Admin") {
?>
                <table width = "500" style = "font-size:18px">
                    <tr>
                        <td align = 'center'>
                            Are you sure you want to delete user <?=$name?>?
                        </td>
                    </tr>
                    <tr>
                        <br>
                        <td align = 'center'>
                            <br>
                            <input type = "submit" name = "submitted" 
                                value = "Delete" class = "btn btn-default" 
                                style = "background-color:green; color: white; 
                                font-size:16px; font-weight:bold;">
                            <input type = "submit" name = "cancelled" 
                                value = "Cancel" class = "btn btn-default" 
                                style = "background-color:red; color: white; 
                                font-size:16px; font-weight:bold;"></td>
                        </td>
                    </tr>
                </table>
<?php
} else if ($role == "Admin" && $email != $_SESSION['email']){
?>
                <table width = "500" style = "font-size:18px">
                    <tr>
                        <td align = 'center'>
                            <?=$name?> is an Admin.
                            <br>
                            You are not allowed to delete another Admin.
                        </td>
                    </tr>
                    <tr>
                        <br>
                        <td align = 'center'>
                            <br>
                            <input type = "submit" name = "cancelled" 
                                value = "Back" class = "btn btn-default" 
                                style = "background-color:red; color: white; 
                                font-size:16px; font-weight:bold;"></td>
                        </td>
                    </tr>
                </table> 
<?php
} else if ($email == $_SESSION['email']){
?>
                <table width = "500" style = "font-size:18px">
                    <tr>
                        <td align = 'center'>
                            You are not allowed to delete yourself.
                        </td>
                    </tr>
                    <tr>
                        <br>
                        <td align = 'center'>
                            <br>
                            <input type = "submit" name = "cancelled" 
                                value = "Back" class = "btn btn-default" 
                                style = "background-color:red; color: white; 
                                font-size:16px; font-weight:bold;"></td>
                        </td>
                    </tr>
                </table> 
<?php
} else {
?>
                <table width = "500" style = "font-size:18px">
                    <tr>
                        <br>
                        <td align = 'center'>
                            <br>
                            <input type = "submit" name = "cancelled" 
                                value = "Back" class = "btn btn-default" 
                                style = "background-color:red; color: white; 
                                font-size:16px; font-weight:bold;"></td>
                        </td>
                    </tr>
                </table>
<?php    
}
?>
            </form>
        <?php include '../../../includes/footer.php'; ?>