<?php
session_start();
include '../../../includes/security.php';

use classes\business\EmailSentManager;
use classes\entity\EmailSent;
//use classes\business\Validation;

require_once '../../../includes/autoload.php';

$EM = new EmailSentManager();
$emailsents = $EM->getAllEmailSent(); 

?>
<html>
    <head> 
        <title>Bulk Email</title>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; Bulk Email            
            <br><br></p>
            <legend><h1 align = 'center'><b>Bulk Email</b></h1></legend>
            <div class="row" style="padding-top: 5px; padding-bottom: 5px">
            	<div class="col-sm-10">
                        <div class="table-responsive">
                        <table class = "pure-table pure-table-bordered" 
                            width = "1250" style = "font-size:18px; align:top">
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
?>
                		</table>
                   		<br>	
                		</div>
                </div>
                <div class="col-sm-2">
					<div class="row">
                        <fieldset>
                        <legend>
                        <h3 align = 'center'>
                            <b><img src = "../../../images/email.png" 
                            style = "width:25px; height:25px"> 
                            Send Email</b>
                        </h3>
                        </legend>
                        <div>
                            <a href = "emailallusers.php">
                                <button type = "button" class = "btn btn-default" 
                                style = "background-color:blue; color:white; 
                            	font-size:16px; font-weight:bold; white-space:normal; 
                                width:65%">To All Users</button>
                            </a>
                        </div>
                        <br>
                        <div>
                            <a href = "emailsubscribers.php">
                                <button type = "button" class = "btn btn-default" 
                                style = "background-color:blue; color:white; 
                            	font-size:16px; font-weight:bold; white-space:normal; 
                                width:65%">To Subscribers</button>
                            </a>
                        </div>
                        <br>
                        </fieldset>
					</div>
					<br>
					<div class="row">
						<form action = "emailsearchlist.php" name = "myForm" 
                            method = "get" class = "pure-form pure-form-stacked">
						<fieldset>
                        <legend>
                        <h3 align = 'center'><b><img src = "../../../images/search.png" 
                            style = "width:25px; height:25px"> 
                            Find Email</b>
                        </h3>
                        </legend>
                        <table style = "font-size:18px">
                            <tr>
                                <input type = "text" name = "date" id = "date" 
                                    placeholder = "Date: YYYY-MM-DD" value = "" 
                                    style = "margin:2; width:80%">
                            </tr>
                            <tr>
                                <input type = "text" name = "subject" id = "subject" 
                                    placeholder = "Subject containing..." value = "" 
                                    style = "margin:2; width:80%">
                            </tr>
                            <tr>
                                <input type = "text" name = "message" id = "message" 
                                    placeholder = "Message containing..." value = "" 
                                    style = "margin:2; width:80%">
                            </tr>                        
                            <tr>
                                <input type = "text" name = "recipient" id = "recipient" 
                                    placeholder = "Recipient" value = "" 
                                    style = "margin:2; width:80%">
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <br>
                                    <input type = "submit" name = "submitted" 
                                        value = "Search" class = "btn btn-default" 
                                        style = "background-color:green; color:white; 
                                        font-size:16px; font-weight:bold;">
                                    <input type = "reset" name = "reset" 
                                        value = "Reset" class = "btn btn-default" 
                                        style = "background-color:red; color:white; 
                                        font-size:16px; font-weight:bold;">
                                </td>
                            </tr>
                        </table>
                        </fieldset>
                    	</form>
					</div>
                </div>
            </div>


<?php include '../../../includes/footer.php'; ?>
