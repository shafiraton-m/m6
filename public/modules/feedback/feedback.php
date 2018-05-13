<?php
use classes\entity\Feedback;
use classes\business\FeedbackManager;
use classes\business\Validation;

require_once '../includes/autoload.php';
$formerror = "";

if(!isset($_SESSION['email'])) {
	$email     = "";
	$firstname = "";
	$lastname  = "";
} else {
	$email     = $_SESSION['email'];
	$firstname = $_SESSION['firstName'];
	$lastname  = $_SESSION['lastName'];
}

$error_firstname = "";
$error_lastname  = "";
$error_passwd    = "";
$error_email     = "";
$error_comments  = "";
$validate = new Validation();

if(isset($_POST["submitted"])) {
    $email     = strip_tags($_POST["email"]);
    $lastname  = strip_tags($_POST["lastname"]);
    $firstname = strip_tags($_POST["firstname"]);	
	$comments  = strip_tags($_POST["comments"]);	
	
	$validate->check_name($firstname, $error_firstname);
	$validate->check_name($lastname,  $error_lastname);
	if(    empty($error_firstname) 
        && empty($error_lastname) 
        && empty($error_email) 
        && empty($error_comments)
    ) {
        $feedback = new Feedback();
        $feedback->firstname = $firstname;
        $feedback->lastname  = $lastname;
        $feedback->email     = $email;
        $feedback->comments  = $comments;
		$FM = new FeedbackManager();
		$FM->insertFeedback($feedback);
        $formerror = "<font color = green size = '2'>Your feedback submitted 
            successfully!</font>";
	}
}
?>
            <form name = "myForm" method = "post" 
                class = "pure-form pure-form-stacked">
                <fieldset>
                <legend>
                <h1 align = 'center'><b>Feedback Form</b></h1>
                </legend>
                <div><?=$formerror?></div>
                <div class="table-responsive">
                <table border = '0' width = "530" style = "font-size:18px">
                    <col width = "200">
                    <col width = "330">
                    <tr>
                        <td>First Name</td>
                        <td>
                            <input type = "text" name = "firstname" 
                                value = "<?=$firstname?>" size = "30"></td>
                        <td><?=$error_firstname?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>
                            <input type = "text" name = "lastname" 
                                value = "<?=$lastname?>" size = "30"></td>
                        <td><?=$error_lastname?></td>
                    </tr>
                    <tr>    
                        <td>Email</td>
                        <td>
                            <input type = "email" name = "email" 
                                value = "<?=$email?>" size = "30"></td>
                    </tr>
                    <tr>    
                        <td>Comments</td>
                        <td>
                            <textarea name = "comments" rows = "7" cols = "32.5">
                            </textarea>
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
                            <input type = "reset" name = "reset" 
                                value = "Reset" class = "btn btn-default" 
                                style = "background-color:red; color:white; 
                                font-size:16px; font-weight:bold;">
                        </td>
                    </tr>
                </table>
                </div>
                </fieldset>
            </form>