<?php
session_start();
require_once '../../../includes/autoload.php';

ob_start();
include '../../../includes/security.php';

use classes\business\UserManager;
use classes\entity\User;

$notice = "";

$UM = new UserManager();
$users = $UM->getAllUsers();

if(isset($_GET['id'])) {
    $updated = $UM->getUserByID($_GET['id']);
    $notice  = $updated->firstName." ".$updated->lastName."'s 
        profile has been updated";
}
?>
<html>
    <head> 
        <title>Administer User</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; Administer User
            </p>
            <br/>
            <h3>
                Below is the list of Developers registered in community portal 
            <h3>
            <h4><font color = 'green'><?=$notice?></font></h4>
            <table class = "pure-table pure-table-bordered" width = "1050" 
                style = "font-size:18px">
                <col width = "250">
                <col width = "250">
                <col width = "250">
                <col width = "100">
                <col width = "100">
                <col width = "100">
                <col width = "100">
                    <tr>
                    <thead>
                        <th><b>First Name</b></th>
                        <th><b>Last Name</b></th>
                        <th><b>Email</b></th>
                        <th><b>Access</b></th>
                        <th><b>Subscribe</b></th>
                        <th colspan = "2"><b>Operation</b></th>
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
                        <td><?=$user->user_access?></td>
                        <td><?=$user->subscription?></td>
                        <td>
                            <a href = 'edituser.php?id=<?php echo $user->id ?>'>
                                Edit
                            </a>
                        </td>
                        <td>
                            <a href = 'deleteuser.php?id=<?php echo $user->id ?>'>
                                Delete
                            </a>
                        </td>                       
                    </tr>
<?php 
        }
    }
?>
    </table><br/><br/>
<?php 
include '../../../includes/footer.php';
?>