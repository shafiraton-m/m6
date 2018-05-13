<?php
session_start();
include '../../../includes/security.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\Validation;

//ob_start();
require_once '../../../includes/autoload.php';
?>

<?php

$UM = new UserManager();
$existuser    = $UM->getUserById($_GET["id"]);
$firstName    = $existuser->firstName;
$lastName     = $existuser->lastName;
$email        = $existuser->email;
$password     = $existuser->password;
$role         = $existuser->role;
$user_access  = $existuser->user_access;
$subscription = $existuser->subscription;
$name         = $firstName." ".$lastName;

$formerror = "";
$firstNameerror = "";
$lastNameerror = "";
$validate = new Validation();

if(isset($_POST["submitted"])) {
	$firstName    = $_POST["firstName"];
	$lastName     = $_POST["lastName"];
	$email        = $_POST["email"];
	$role         = $_POST["role"];
	$user_access  = $_POST["user_access"];	
	$subscription = $_POST["subscription"];
	$update       = true;

	if(    $firstName != '' 
        && $lastName  != '' 
        && $email     != ''
    ) {
		$checkFN = $validate->check_name($firstName, $firstNameerror);
		$checkLN = $validate->check_name($lastName,  $lastNameerror);
	  
		if($checkFN && $checkLN) {
			$UM = new UserManager();
            
			if($email != $existuser->email) {
				$checkuser = $UM->getUserByEmail($email);
				if(is_null($checkuser) == false) {
					$formerror = "User Email already in use, unable to 
                        update email";
					$update = false;
				}
			}
            
			if($update) {
				$existuser->firstName   = $firstName;
				$existuser->lastName    = $lastName;
				$existuser->email       = $email;
				$existuser->password    = $password;
				$existuser->role        = $role;
				$existuser->user_access = $user_access;
				$existuser->subscription  = $subscription;
				$UM->saveUser($existuser);
				echo '<meta http-equiv="Refresh" content="1; 
                    url=userlistadmin.php?id='.$existuser->id.'">';
			}
		}
	} else {
		$formerror = "Please provide required values";
    }
} else if(isset($_POST["cancelled"])) {
	echo '<meta http-equiv = "Refresh" content = "1; url = userlistadmin.php">';  
} else if(isset($_POST["proceed"])) {
	echo '<meta http-equiv = "Refresh" content = "1; url = updateprofile.php">';  
} else if(isset($_POST["reset"])) {
	$UM = new UserManager();
	$existuser   = $UM->getUserById($_GET["id"]);
	$firstName   = $existuser->firstName;
	$lastName    = $existuser->lastName;
	$email       = $existuser->email;
	$role        = $existuser->role;
	$user_access = $existuser->user_access;
	$subscription = $existuser->subscription;
}


?>
<html>
    <head> 
        <title>Update User Profile</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp;<a href='userlistadmin.php'>Administer User</a>
                &nbsp;&#187;&nbsp; Update User Profile
            </p>
<?php
if ($role == "Admin" && $email != $_SESSION['email']){
?>
            <br>
            <form name = "myForm" method = "post" 
                class = "pure-form pure-form-stacked">
                <h3><b>Edit Access Denied</b></h3>
                <table width = "500" style = "font-size:18px">
                    <tr>
                        <td align = 'center'><?=$name?> is an Admin.
                            <br>You are not allowed to edit another Admin.</td>
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
            </form>
<?php    
} else if ($email == $_SESSION['email']){
?>
            <br>
            <form name = "myForm" method = "post" 
                class = "pure-form pure-form-stacked">
                <h3><b>Edit Your Account</b></h3>
                <table width = "500" style = "font-size:18px">
                    <tr>
                        <td align = 'center'>You have chosen to edit your account.
                            <br> Proceed to update your profile.</td>
                    </tr>
                    <tr>
                        <br>
                        <td align = 'center'>
                            <br>
                            <input type = "submit" name = "proceed" 
                                value = "Proceed" class = "btn btn-default" 
                                style = "background-color:green; color: white; 
                                font-size:16px; font-weight:bold;"></td>
                        </td>
                    </tr>
                </table>        
            </form>
<?php    
} else {
?>
            <form name = "myForm" method = "post" 
                class = "pure-form pure-form-stacked">
                <fieldset>
                <legend><h1 align = 'center'><b>Update User Profile</b></h1></legend>
                <div><font color = red><?=$formerror?></div></font>
                <table border = '0' width = "530" style = "font-size:18px">
                    <col width = "200">
                    <col width = "330">
                    <tr>
                        <td>First Name</td>
                        <td>
                            <font color = red><?=$firstNameerror?></font>
                            <input type = "text" name = "firstName" 
                                value = "<?=$firstName?>" size = "30">
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>
                            <font color = red><?=$lastNameerror?></font>
                            <input type = "text" name = "lastName" 
                                value = "<?=$lastName?>" size = "30">
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type = "text" name = "email" value = "<?=$email?>"
                                size = "30">
                        </td>
                    </tr>
                    <tr>
                        <td>Subscription</td>
                        <td>
                            <input type = "text" name = "subscription" 
                                value = "<?=$subscription?>" size = "30" 
                            	data-toggle = "tooltip" data-placement = "bottom"
                                title="'Y' or 'N'">
                        </td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>
                        	<input type = "text" name = "role" value = "<?=$role?>" 
                                size = "30" data-toggle = "tooltip" 
                                data-placement = "bottom" title="'User' or 'Admin'">
                    	</td>
                    </tr>
                    <tr>
                        <td>Access</td>
                        <td>
                        	<input type = "text" name = "user_access" 
                                value = "<?=$user_access?>" size = "30" 
                            	data-toggle = "tooltip" data-placement = "bottom" 
                                title="'Allowed' or 'Denied'">
                    	</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <br>
                            <input type = "submit" name = "submitted" 
                                value = "Submit" class = "btn btn-default" 
                                style = "background-color:green; color: white; 
                                font-size:16px; font-weight:bold;">
                            <input type = "submit" name = "reset" 
                                value = "Reset" class = "btn btn-default" 
                                style = "background-color:darkblue; color: white; 
                                font-size:16px; font-weight:bold;">
                            <input type = "submit" name = "cancelled" 
                                value = "Cancel" class = "btn btn-default" 
                                style = "background-color:red; color: white; 
                                font-size:16px; font-weight:bold;"></td>
                        </td>
                    </tr>
                </table>
                </fieldset>
            </form>
<?php
}
include '../../../includes/footer.php'; 
?>