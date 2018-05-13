<?php
session_start();
require_once '../../../includes/autoload.php';

use classes\business\EmailSentManager;
use classes\entity\EmailSent;

ob_start();
include '../../../includes/security.php';

if(isset($_GET["date"])) {
    $date = $_GET["date"];
}
if(isset($_GET["subject"])) {
    $subject  = $_GET["subject"];
}
if(isset($_GET["message"])) {
    $message     = $_GET["message"];
}
if(isset($_GET["recipient"])) {
    $recipient     = $_GET["recipient"];
}

$EM = new EmailSentManager();
$emailsents = $EM->searchEmailSent($date,$subject,$message,$recipient);

if(    $date      == "" 
    && $subject   == "" 
    && $message   == ""
    && $recipient == ""
) {
?>
<html>
    <head> 
        <title>Bulk Email Search Result</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; 
                <a href='../../modules/email/bulkemail.php'>Bulk Email</a>
                &nbsp;&#187;&nbsp; 
                Search for Bulk Email Sent
            </p>
            <br>
            <h3>
                <b><img src = "../../../images/search.png" alt = "Search" 
                    style = "width:25px; height:25px"> 
                    Search for Bulk Email Sent</b>
            <h3>
            <form action = "bulkemail.php" class = "pure-form pure-form-stacked">
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
                            <input type = "submit" name = "back" 
                                value = "Back" class = "btn btn-default" 
                                style = "background-color:green; color:white; 
                                font-size:16px; font-weight:bold;">
                        </td>
                    </tr>
                </table>
            </form>
<?php
} else if(isset($emailsents)) {
?>
<html>
    <head> 
        <title>Bulk Email Search Result</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; 
                <a href='../../modules/email/bulkemail.php'>Bulk Email</a>
                &nbsp;&#187;&nbsp; 
                Search for Bulk Email Sent
            </p>
            <br>
            <h3>
                <b><img src = "../../../images/search.png" alt = "Search" 
                    style = "width:25px; height:25px"> 
                    Search Result for Bulk Email Sent</b>
            <h3>
            <div class="row" style="padding-top: 5px; padding-bottom: 5px">
            	<div class="col-sm-12">
                    <div class="table-responsive">
                    <table class = "pure-table pure-table-bordered" width = "1250" 
                        style = "font-size:18px; align:top">
                        <col width = "150">
                        <col width = "150">
                        <col width = "800">
                        <col width = "150">
                            <tr>
                            <thead>
                               <th><b>Date</b></th>
                               <th><b>Type</b></th>
                               <th><b>Message</b></th>
                               <th><b>Sender and Recipients</b></th>
                               </thead>
                            </tr>                  
<?php   
    foreach ($emailsents as $emailsent) {
        if($emailsent != null) {
?>
            				<tr>
                               <td rowspan="2"><?=$emailsent->date?></td>
                               <td rowspan="2"><?=$emailsent->type?></td>
                               <td><b>Subject: </b><?=$emailsent->subject?></td>
                               <td><b>By: </b><?=$emailsent->sent_by?></td>          
                            </tr>
                            <tr>
                               <td><?=$emailsent->message?></td> 
                               <td><b>To: </b><?=$emailsent->recipient?></td>            
                            </tr>
<?php 
        }
    }                
    if($emailsents[0] == NULL && !isset($emailsents[1])) {
?>
                            <tr>
                                <td colspan = "4" align = 'center'>
                                    <font color = 'red'>No Email found.</font>
                                </td>
                            </tr>
<?php
    }
?>
    				</table>
					</div>
                    <br>
                    <form action = "bulkemail.php" 
                        class = "pure-form pure-form-stacked">
                        <table width = "600" align = "right">
                            <tr align = "right">
                                <input type = "submit" name = "back" 
                                    value = "Back" class = "btn btn-default" 
                                    style = "background-color:green; color:white; 
                                    font-size:16px; font-weight:bold;">
                            </tr>
                        </table>
                    </form>
        		</div>
    		</div>
<?php
}
include '../../../includes/footer.php';
?>