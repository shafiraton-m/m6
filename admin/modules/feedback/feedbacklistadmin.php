<?php
session_start();
require_once '../../../includes/autoload.php';

ob_start();
include '../../../includes/security.php';

use classes\business\FeedbackManager;
use classes\entity\Feedback;

$FM = new FeedbackManager();
$feedbacks = $FM->getAllFeedback();

if(isset($feedbacks)){
?>
<html>
    <head> 
        <title>Feedbacks</title>
        <?php include '../../../includes/header.php'; ?>
            <p style = "font-size:14px" align='left'>
                <a href='../../home.php'>My Home Page</a>
                &nbsp;&#187;&nbsp; Feedbacks
            </p>
            <br/>
            <h3>Below is the list of feedbacks submitted in the community portal<h3>
            <table class = "pure-table pure-table-bordered" width = "1100" 
                style = "font-size:18px">
                <col width = "250">
                <col width = "250">
                <col width = "250">
                <col width = "350">
                    <tr>
                    <thead>
                       <th><b>First Name</b></th>
                       <th><b>Last Name</b></th>
                       <th><b>Email</b></th>
                       <th><b>Comment</b></th>
                   </thead>
                    </tr>    
<?php 
    foreach ($feedbacks as $feedback) {
        if($feedback != NULL){
?>
            <tr>
               <td><?=$feedback->firstName?></td>
               <td><?=$feedback->lastName?></td>
               <td><?=$feedback->email?></td>
			   <td><?=$feedback->comments?></td>			   
            </tr>
<?php 
        }
    }
?>
            </table><br/><br/>
<?php 
}
include '../../../includes/footer.php';
?>