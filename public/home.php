<?php
session_start();
include '../includes/security.php';

require_once '../includes/autoload.php';

$message = "<b>Welcome ".$_SESSION['firstName']." ".$_SESSION['lastName']."!
    <br>Last login: </b>".$_SESSION['login']; 

?>
<html>
    <head> 
        <title>My Home Page</title>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php include '../includes/header.php'; ?>
            <p><?=$message?></p>
            <h1><b>This is your Community Portal Home Page</b></h1>
            <br>
            <div class="row">
            	<div class="col-sm-10">
                <!--Carousel-->
                <div class = "row">
                    <div class = "col-sm-12" style = "width:100%;">
                        <div id = "myCarousel" class = "carousel slide" data-ride = "carousel" style = "width:70%;">
                            <!-- Indicators -->
                            <ol class = "carousel-indicators">
                                <li data-target = "#myCarousel" data-slide-to = "0" class = "active"></li>
                                <li data-target = "#myCarousel" data-slide-to = "1"></li>
                                <li data-target = "#myCarousel" data-slide-to = "2"></li>
                                <li data-target = "#myCarousel" data-slide-to = "3"></li>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class = "carousel-inner">
                                <div class = "item active">
                                    <img src = "../images/user.png" alt = "Developer" style = "width:100%; opacity:0.5">
                                    <div class = "carousel-caption">
                                        <h2 style = "color:#34495E"><b>DEVELOPER</b></h2>
                                        <h4 style = "color:#34495E"><b>View Profiles | Get Connected</b></h4>
                                        <a href = "modules/user/register.php"><button type = "button" class = "btn btn-default" 
                                            style = "background-color:#458688; color: white; font-size: 16px;">
                                            <b>Register</b></button></a>
                                    </div>
                                </div>
                                <div class = "item">
                                    <img src = "../images/jobs.png" alt = "Job Opportunity" style = "width:100%; opacity:0.5">
                                    <div class = "carousel-caption">
                                        <h2 style = "color:#34495E"><b>JOB</b></h2>
                                        <h4 style = "color:#34495E"><b>Post Opening | Find Match</b></h4>
                                        <a href = "modules/user/register.php"><button type = "button" class = "btn btn-default" 
                                            style = "background-color:#458688; color: white; font-size: 16px;">
                                            <b>Register</b></button></a>
                                    </div>
                                </div>
                                <div class = "item">
                                    <img src = "../images/softwareDev.png" alt = "Forum" style = "width:100%; opacity:0.5">
                                    <div class = "carousel-caption">
                                        <h2 style = "color:#34495E"><b>FORUM</b></h2>
                                        <h4 style = "color:#34495E"><b>Post Query | Share Tips</b></h4>
                                        <a href = "modules/user/register.php"><button type = "button" class = "btn btn-default" 
                                            style = "background-color:#458688; color: white; font-size: 16px;">
                                            <b>Register</b></button></a>
                                    </div>
                                </div>
                                <div class = "item">
                                    <img src = "../images/projCollab.png" alt = "Project Collaboration" style = "width:100%; opacity:0.5">
                                    <div class = "carousel-caption">
                                        <h2 style = "color:#34495E"><b>PROJECT</b></h2>
                                        <h4 style = "color:#34495E"><b>Initiate Project | Join Collaboration</b></h4>
                                        <a href = "modules/user/register.php"><button type = "button" class = "btn btn-default" 
                                            style = "background-color:#458688; color: white; font-size: 16px;">
                                            <b>Register</b></button></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Left and right controls -->
                            <a class = "left carousel-control" href = "#myCarousel" data-slide = "prev">
                                <span class = "glyphicon glyphicon-chevron-left"></span>
                                <span class = "sr-only">Previous</span>
                            </a>
                            <a class = "right carousel-control" href = "#myCarousel" data-slide = "next">
                                <span class = "glyphicon glyphicon-chevron-right"></span>
                                <span class = "sr-only">Next</span>
                            </a>
                        </div>
                        <br>
                    </div>
                </div>
                </div>                
            	<div class="col-sm-2">            	
					<div class="row">
                	<form action = "modules/user/usersearchlist.php" name = "myForm" 
                        method = "get" class = "pure-form pure-form-stacked">
                        <fieldset>
                        <legend>
                        <h3 align = 'center'>
                            <b><img src = "../images/search.png" style = "width:25px; 
                            height:25px"> Find Developers</b>
                        </h3>
                        </legend>
                        <table style = "font-size:10px">
                            <tr>
                                <input type = "text" name = "firstName" 
                                    id = "firstName" placeholder = "First Name" 
                                    value = "" style = "margin:2; width:80%">
                            </tr>
                            <tr>
                                <input type = "text" name = "lastName" 
                                    id = "lastName" placeholder = "Last Name" 
                                    value = "" style = "margin:2; width:80%">
                            </tr>
                            <tr>
                                <input type = "text" name = "email" 
                                    id = "email" placeholder = "Email" value = "" 
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
<?php include '../includes/footer.php'; ?>
