<?php
session_start();
require '../../../includes/autoload.php';

include '../../../includes/security.php';

use classes\entity\User;
use classes\business\UserManager;
use classes\entity\EmailSent;
use classes\business\EmailSentManager;

$formerror     = "";

if(isset($_POST["submitted"])) { 
    $subject   = $_POST["subject"];
    $message   = $_POST["message"];
    $type      = 'All Users';
    $sent_to   = '';
    $sent_by   = $_SESSION['email'];
    $sentFlag  = "False";
    
    $UM = new UserManager();
    $users = $UM->getAllUsers();
    
    // Define recipients array
    $recipients = "";
    foreach ($users as $user)
    {
        if($user != null) {
            $name = $user->firstName.' '.$user->lastName;
            $recipients[$name] = $user->email;
            $sent_to .= $user->email.'; ';
        }
    }
    //coding for sending email
    require '../../../includes/BulkEmail.php';
    $BM = new BulkEmail();
    $sent = $BM->toUsers($recipients, $subject, $message);
    
    if ($sent == 'True')
    {
        $formerror = "<font color = green>Email has been sent.</font>";
        $emailsent = new EmailSent();
        $emailsent->subject   = $subject;
        $emailsent->message   = $message;
        $emailsent->type      = $type;
        $emailsent->sent_by   = $sent_by;
        $emailsent->recipient = $sent_to;
        $EM = new EmailSentManager();
        $EM->saveEmailSent($emailsent);
    }
}

?>
<html>
    <head> 
        <title>Email All Users</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; 
                <a href='../../modules/email/bulkemail.php'>Bulk Email</a>
                &nbsp;&#187;&nbsp; 
                Email All Users
            </p>
            <form name = "myForm" method = "post" 
                class = "pure-form pure-form-stacked">
                <fieldset>
                <legend>
                <h1 align = 'center'><b>Email All Users</b></h1>
                </legend>
                <table border = '0' width = "530" style = "font-size:18px">
                    <col width = "200">
                    <col width = "330">
                    <tr>    
                        <td>Subject</td>
                        <td><input type = "text" name = "subject"></td>
                    </tr> 
                    <tr>    
                        <td>Message</td>
                        <td>
                            <textarea rows = "5" name = "message"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <br>
                            <input type = "submit" name = "submitted" 
                                value = "Submit" class = "btn btn-default" 
                                style = "background-color:green; color:white;
                                font-size:16px; font-weight:bold;">
                        </td>
                    </tr>
                    <tr><p><?php echo $formerror?></p></tr>
                </table>
                </fieldset>
            </form>
        <?php include '../../../includes/footer.php'; ?>