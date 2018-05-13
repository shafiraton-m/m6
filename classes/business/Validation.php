<?php
namespace classes\business;

use classes\entity\User;
use classes\data\UserManagerDB;
/**
 * This class provides the business logic
 * for inputs submitted by end user
 * @author Shafiraton Mardhiah
 *
 */
class Validation
{
    /**
     * Return true if the input contain only letters and white space, 
     * else return false with error output
     * @param string $input
     * @param string $error
     * @return boolean
     */
    public function check_name($input, &$error)
    {
        if (!preg_match("/^[a-zA-Z ]*$/",$input)) { 
            $error = "<font color=red size='2'> Only letters and white 
                space allowed</font>"; 
            return false;
        }
        return true;
    }
	/**
	 * To check login passwords 
	 * Return true if the input contain at least 8 characters with at least 
	 * one uppercase letter, one lowercase letter and one digit, 
	 * else return false with error output
	 * @param string $input is the password to be checked
	 * @param string $error
	 * @return boolean
	 */
    public function check_password($input, &$error)
    {
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$input)) 
        { 
            $error = "<font color=red size='2'> Password must consist of at least 8 
                characters with at least one uppercase letter, one lowercase letter 
                and one digit</font>"; 
            return false;
        }
        return true;
    }
	/**
	 * To check newly submitted password
	 * Return true if password and confirmation password are the same, 
	 * else return false with error output
	 * @param string $password is the submitted password
	 * @param string $cpassword is the confirmation password
	 * @param string $error
	 * @return boolean
	 */
    public function check_match($password, $cpassword, &$error)
    {
        if ($password!=$cpassword) { 
            $error = "<font color=red size='2'> Password and Confirm Password do not
                match</font>"; 
            return false;
        }
        return true;
    }
	/**
	 * To check the password strength of newly submitted password
	 * Return true with strength indicator if the input contain at least 8 characters 
	 * with at least one uppercase letter, one lowercase letter and one digit, 
	 * else return false with indicator and error output
	 * @param string $input
	 * @param string $error
	 * @return boolean
	 */
    public function check_strength($input, &$error)
    {
        if(strlen($input) < 8) { 
            $error = "<i class=\"fa fa-times-circle\" 
                style=\"font-size:14px;color:red\"></i>
                <font color=red size='2'>  
                Password must be at least 8 characters</font>"; 
            return false;
        } else if (is_numeric($input)) {
            $error = "<i class=\"fa fa-times-circle\" 
                style=\"font-size:14px;color:red\"></i>
                <font color=red size='2'>  
                Password must be have least one uppercase 
                letter and one lowercase letter</font>";
            return false;
        } else if (!preg_match('#[0-9]#',$input)) {
            $error  = "<i class=\"fa fa-times-circle\" 
                style=\"font-size:14px;color:red\"></i>
                <font color=red size='2'>  Password must 
                have least one number</font>";
            return false;
        } else if (!preg_match('/[A-Z]/',$input)) {
            $error = "<i class=\"fa fa-times-circle\" 
                style=\"font-size:14px;color:red\"></i>
                <font color=red size='2'>  Password must 
                have least one uppercase letter</font>";
            return false;
        } else if (!preg_match('/[a-z]/',$input)) {
            $error = "<i class=\"fa fa-times-circle\" 
                style=\"font-size:14px;color:red\"></i>
                <font color=red size='2'> Password must 
                have least one lowercase letter</font>";
            return false;
        } else {
            $error = "<i class=\"fa fa-check-circle\" 
                style=\"font-size:14px;color:green\"></i>
                <font color= green size='2'> 
                Password is strong</font>";
            return true;
        }
    }
	/**
	 * To check user is not a robot
	 * Return true of reCaptcha box has been checked, 
	 * else return false with error output
	 * @param string $error
	 * @return boolean
	 */
    public function check_captcha(&$error)
    {
        $response = $_POST["g-recaptcha-response"];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6Lf7JE8UAAAAADoGmtj8HDtC0MdiFc2VNLghOLQh',
            'response' => $_POST["g-recaptcha-response"]
        );
        $options = array(
            'http' => array (
                'method' => 'POST',
                'header'=>'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success=json_decode($verify);
        if ($captcha_success->success==false) {
            $error="<p><font color='red' size='2'>Please check the security 
                CAPTCHA box to proceed</font></p>"; 
            return false;
        }
        return true;
    }
}
?>