<?php
session_start();
use classes\business\UserManager;
use classes\business\Validation;

require_once '../includes/autoload.php';

$email         = "";
$password      = "";
$salt          = "";
$user_access   = "";
$formerror     = "";
$error_passwd  = "";
$securityerror = "";
$validate = new Validation();

if(isset($_POST["submitted"])) {
    $email    = $_POST["email"];
    $password = $_POST["password"];
            
    if($email != "" && $password != "") {
        $check_captcha = $validate->check_captcha($securityerror);
        $UM = new UserManager();
        $existuser = $UM->getUserByEmail($email);
        
        if(!isset($existuser)) {
            $formerror = "Invalid User Name or Password";
        } else {
            $salt = $existuser->salt;
            $checkP = $validate->check_password($password, $error_passwd);
            
            if($checkP && $check_captcha) {
                $existuser = $UM->getUserByEmailPassword(
                    $email,
                    hash("sha512",$salt.$password)
                    );
                $user_access = $existuser->user_access;
                
                if(isset($existuser) && $user_access == "Allowed") {
                    $login = $UM->getUserLogin($email);
                    $_SESSION['email']     = $email;
                    $_SESSION['firstName'] =  $existuser-> firstName;
                    $_SESSION['lastName']  =  $existuser-> lastName;
                    $_SESSION['password']  =  $existuser-> password;
                    $_SESSION['role']      =  $existuser-> role;
                    $_SESSION['id']        = $existuser->id;
                    $_SESSION['subscription'] = $existuser->subscription;
                    $_SESSION['login']     = $login;
                    $UM->loginUser($existuser); 
                    if($existuser->role == "User") {
                        echo '<meta http-equiv = "Refresh" content = "1; 
                            url = home.php">';
                    } else if($existuser->role == "Admin") {
                        echo '<meta http-equiv = "Refresh" content = "1; 
                            url = ../admin/home.php">';
                    }
                } else if ($user_access == "Denied") {
                    $formerror = "Access Denied! Please contact Administrator";
                } else {
                    $formerror = "Invalid User Name or Password";
                }
                
            }
        }
    } else {
        $formerror = "Please fill in all fields"; 
    }
}

?>
<html>
    <head> 
        <title>Login Page</title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
            function customReset()
            {
                document.getElementById("email").value = "";
                document.getElementById("password").value = "";
            }
        </script>
        <?php include '../includes/header.php'; ?>
            <form name = "myForm" method = "post" class = "pure-form pure-form-stacked">
                <fieldset>
                <legend><h1 align = 'center'><b>Login</b></h1></legend>
                <div><font color = red><?=$formerror?></font></div>
                <div class="row" style="padding-top: 5px; padding-bottom: 5px">
                <div class="table-responsive">
                <table width = "50%" style = "font-size:18px">
                    <col width = "40%">
                    <col width = "60%">
                    <tr>    
                        <td style="text-align:right; padding:15px">Email</td>
                        <td>
                            <input type = "email" name = "email" id = "email" 
                                value = "<?=$email?>" size = "27">
                        </td>
                    </tr>
                    <tr>    
                        <td style="text-align:right; padding:15px">Password</td>
                        <td>
                            <?=$error_passwd?><input type = "password" name = "password"
                                id = "password" value = "<?=$password?>" size = "27">
                        </td>
                        <td>
                    </tr> 
                    <tr>
                        <td></td>
                        <td>
                            <?=$securityerror?>
                            <div class="captcha_wrapper" style="margin:4px 0px">
                                <div class="g-recaptcha" data-sitekey=
                                    "6Lf7JE8UAAAAAHukmRF3mJPA0dDfVKYpq8oPYc-p"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <br>
                            <input type = "submit" name = "submitted" value = "Submit"
                                class = "btn btn-default" style = "background-color:green;
                                color:white; font-size:16px; font-weight:bold;">
                            <input type = "button" name = "reset" value = "Reset" 
                                onclick = customReset() class = "btn btn-default" 
                                style = "background-color:red; color:white; 
                                font-size:16px; font-weight:bold;">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style = "font-size:16px">
                            <br><a href = "./forgetpassword.php">Forget Password</a>
                        </td>
                    </tr>   
                    <tr>
                        <td></td>
                        <td style = "font-size:16px">
                            <br>
                            Not yet a member? <a href = "modules/user/register.php">
                                Register Now!</a>
                        </td>
                    </tr>      
                </table>
                </div>
                </div>
                </fieldset>
            </form>
        <?php include '../includes/footer.php'; ?>