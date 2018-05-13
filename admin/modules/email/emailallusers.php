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
    $recipient = '';
    $sent_by   = $_SESSION['email'];
    $sentFlag  = "False";
    
    $UM = new UserManager();
    $users = $UM->getAllUsers();
          
    //coding for sending email
    require '../../../includes/phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer();    
    $mail->isSMTP();
    $mail->Host = 'in-v3.mailjet.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'da3b01077bcbdc20a81bcb8b6aa25844';
    $mail->Password = '2c57db0b75ff75dbbab981f912f2743a';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('shafiraton.m@gmail.com', 'ABC Jobs Portal');
    
    foreach ($users as $user) 
    {        
        if($user != null) 
        {        
            $email = $user->email;
            $name  = $user->firstName." ".$user->lastName;
            $mail->addAddress($email, $name);
            $recipient .= $email.'; ';
        }
    }
    
    $mail->Subject = $subject;
    $mail->AltBody = "This is the plain text version of the email content";
    $mail->Body = "Dear User, <br><br>".$message;
    
    if(!$mail->send()) {
        echo "Mailer Error:".$mail->ErrorInfo;
        $sentFlag = "False";
    } else {
        $formerror = "<font color = green>Email has been sent.</font>";
        $sentFlag = "True";
    }
    
    $emailsent = new EmailSent();
    $emailsent->subject   = $subject;
    $emailsent->message   = $message;
    $emailsent->type      = $type;
    $emailsent->sent_by   = $sent_by;
    $emailsent->recipient = $recipient;
    
    $EM = new EmailSentManager();
    $EM->saveEmailSent($emailsent);   
            
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