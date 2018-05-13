<?php
use classes\business\UserManager;
//use classes\business\Validation;

require_once '../includes/autoload.php';

$formerror  = "";
$unsubflag  = false;
$UM = new UserManager();
$salt = $_GET["unsub"];
$existuser    = $UM->getUserBySalt($salt);
$firstName    = $existuser->firstName;
$lastName     = $existuser->lastName;
$name         = $firstName." ".$lastName;
$message      = "Hi ".$name."!<br><br>You have chosen to unsubscribe from 
    the Community Portal mailing list.<br>Please proceed to confirm or you 
    may cancel.<br><br> Alternatively you may update your subscription in 
    your profile page which is accessible upon login.<br> Simply update 
    subscription to 'N' to unsubcribe.";

if(isset($_POST["submitted"])) 
{ 
    $UM = new UserManager();
    $UM->updateSubscription($salt,"N");
    $formerror = "<font color = 'green'>You have unsubscribe successfully.</font>";
    $unsubflag = true;
} else if(isset($_POST["cancelled"])) {
    echo '<meta http-equiv = "Refresh" content = "1; url = home.php">';
} 

?>
<html>
    <head> 
        <title>Unsubscribe</title>
        <?php include '../includes/header.php'; ?>
            <form name = "myForm" method = "post" 
            	class = "pure-form pure-form-stacked">
                <fieldset>
                <legend><h1 align = 'center'><b>Unsubscribe</b></h1></legend>
                <div><?=$formerror?></div>
<?php
if (!$unsubflag) {
?>
                <table border = '0' width = "530" style = "font-size:18px">
                    <col width = "200">
                    <col width = "330">
                    <tr>    
                        <?=$message?>
                    </tr>                    
                    <tr>
                        <td></td>
                        <td>
                            <br>
                            <input type = "submit" name = "submitted" value = "Proceed" 
                                class = "btn btn-default" style = "background-color:green; 
                                color:white; font-size:16px; font-weight:bold;">
                            <input type = "submit" name = "cancelled" value = "Cancel" 
                                class = "btn btn-default" style = "background-color:red; 
                                color: white; font-size:16px; font-weight:bold;">
                        </td>
                    </tr>
                </table>
<?php 
} else {
?>
                <br>
                <br>
                <p style = "font-size:18px">    
                Continue with <a href = "login.php">login</a>
                </p>
<?php 
}?>
                </fieldset>
            </form>
        <?php include '../includes/footer.php'; ?>