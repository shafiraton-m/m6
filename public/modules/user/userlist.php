<?php
session_start();
require_once '../../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../../includes/security.php';

$UM = new UserManager();
$users = $UM->getAllUsers();

if(isset($users)) {
?>
<html>
    <head> 
        <title>Developer</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; Developer
            </p>
            <br>
            <h3>Below is the list of Developers registered in community portal<h3>
            <br>
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
        if($user != null && $user->role != 'admin') {
?>
                <tr>
                   <td><?=$user->firstName?></td>
                   <td><?=$user->lastName?></td>
                   <td><?=$user->email?></td>
                </tr>
<?php 
        }
    }
?>
            </table>
            <br/>
            <br/>
<?php 
}
include '../../../includes/footer.php';
?>