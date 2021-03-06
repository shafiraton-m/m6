<?php
session_start();
require_once '../../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../../includes/security.php';

if(isset($_GET["firstName"])) {
    $firstName = $_GET["firstName"];
}
if(isset($_GET["lastName"])) {
    $lastName  = $_GET["lastName"];
}
if(isset($_GET["email"])) {
    $email     = $_GET["email"];
}

$UM = new UserManager();
$users = $UM->searchUsers($firstName,$lastName,$email);

if(    $firstName == "" 
    && $lastName  == "" 
    && $email     == ""
) {
?>
<html>
    <head> 
        <title>Developer Search Result</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; Search for Developer
            </p>
            <br>
            <h3>
                <b>
                <img src = "../../../images/search.png" alt = "Forum" 
                    style = "width:25px; height:25px"> 
                    Search for Developers
                </b>
            <h3>
            <form action = "../../home.php" class = "pure-form pure-form-stacked">
                <table width = "400" style = "font-size:18px">
                    <tr>
                        <td align = 'center'>
                            <font color = 'red'>
                                Search fields are empty. Please try again.
                            </font>
                        </td>
                    </tr>
                    <tr><td><br></td></tr>
                    <tr>
                        <td align = 'center'>
                            <input type = "submit" name = "back" value = "Back" 
                                class = "btn btn-default" 
                                style = "background-color:green; color:white; 
                                font-size:16px; font-weight:bold;">
                        </td>
                    </tr>
                </table>
            </form>
<?php
} else if(isset($users)) {
?>
<html>
    <head> 
        <title>Developer Search Result</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; Search for Developer
            </p>
            <br>
            <h3>
                <b>
                <img src = "../../../images/search.png" alt = "Forum" 
                    style = "width:25px; height:25px">
                    Search Result for Developers
                </b>
            <h3>
            <table class = "pure-table pure-table-bordered" width = "750" 
                style = "font-size:18px">
                <col width = "250">
                <col width = "250">
                <col width = "250">
                <tr>
                    <thead>
                        <th><b>First Name</b></th>
                        <th><b>Last Name</b></th>
                        <th><b>Email</b></th>
                    </thead>
                </tr>                   
<?php   
    foreach ($users as $user) {
        if($user != null) {
?>
                <tr>
                    <td><?=$user->firstName?></td>
                    <td><?=$user->lastName?></td>
                    <td><?=$user->email?></td>
                </tr>
<?php 
        }
    }                
    if($users[0] == NULL && !isset($users[1])) {
?>
                <tr>
                    <td colspan = "3" align = 'center'>
                        <font color = 'red'>No Developer found.</font>
                    </td>
                </tr>
<?php
    }
?>
            </table>
            <br>
            <form action = "../../home.php" class = "pure-form pure-form-stacked">
                <table width = "600" align = "right">
                    <tr align = "right">
                        <input type = "submit" name = "back" value = "Back" 
                            class = "btn btn-default" 
                            style = "background-color:green; color:white; 
                            font-size:16px; font-weight:bold;">
                    </tr>
                </table>
            </form>
<?php
}
include '../../../includes/footer.php';
?>