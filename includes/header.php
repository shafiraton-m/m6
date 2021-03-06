<!-- Navigation Bar -->
<?php 
    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == "Admin") {
?>
        <link rel = "stylesheet" href = "https://www.w3schools.com/w3css/4/w3.css">
        <link rel = "stylesheet" href = "/m6/css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel = "stylesheet" href = "/m6/css/pure-release-1.0.0/pure-min.css">
    </head>
    <body>
        <div class = "w3-bar w3-black w3-large" align = "center">
            <img src = "/m6/images/logo1.png"  
                alt= "Community Portal Logo"
                style = "width:100px; height:100px; margin-top:10px; 
                margin-bottom:10px" >
        </div>
        <div class = "w3-bar w3-black w3-large">
            <a href = "/m6/admin/home.php" 
                class = "w3-bar-item w3-button w3-mobile">
                <i class = "w3-margin-right"></i>Home
            </a>
            <a href = "/m6/admin/modules/user/updateprofile.php" 
                class = "w3-bar-item w3-button w3-mobile">Update Profile
            </a>
            <a href = "/m6/admin/modules/user/userlistadmin.php" 
                class = "w3-bar-item w3-button w3-mobile">Administer User
            </a>
            <a href = "/m6/admin/modules/email/bulkemail.php" 
                class = "w3-bar-item w3-button w3-mobile">Bulk Email
            </a>
            <a href = "/m6/admin/modules/job/joblistadmin.php" 
                class = "w3-bar-item w3-button w3-mobile">Administer Job
            </a>
            <a href = "/m6/admin/modules/forum/forumlistadmin.php" 
                class = "w3-bar-item w3-button w3-mobile">Administer Forum
            </a>
            <a href = "/m6/admin/modules/project/projectlistadmin.php" 
                class = "w3-bar-item w3-button w3-mobile">Administer Project
            </a>
            <a href = "/m6/admin/modules/feedback/feedbacklistadmin.php" 
                class = "w3-bar-item w3-button w3-mobile">Feedbacks</a>
            <a href = "/m6/public/logout.php" 
                class = "w3-bar-item w3-button w3-right w3-light-grey 
                w3-mobile">Logout
            </a>
        </div>
        <div class = "container" align = "center" 
            style = "width:90%; padding:50px 0px; margin:0 auto;">
<?php
		} else {
?>
        <link rel = "stylesheet" href = "https://www.w3schools.com/w3css/4/w3.css">
        <link rel = "stylesheet" href = "/m6/css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel = "stylesheet" href = "/m6/css/pure-release-1.0.0/pure-min.css">
    </head>
    <body>
        <div class = "w3-bar w3-black w3-large" align = "center">
            <img src = "/m6/images/logo1.png"  alt= "Community Portal Logo"
                style = "width:100px; height:100px; margin-top:10px; 
                margin-bottom:10px" >
        </div>
        <div class = "w3-bar w3-black w3-large">
            <a href = "/m6/public/home.php" 
                class = "w3-bar-item w3-button w3-mobile">
                <i class = "w3-margin-right"></i>Home
            </a>
            <a href = "/m6/public/modules/user/updateprofile.php" 
                class = "w3-bar-item w3-button w3-mobile">Update Profile
            </a>
            <a href = "/m6/public/modules/user/userlist.php" 
                class = "w3-bar-item w3-button w3-mobile">Developer
            </a>
            <a href = "/m6/public/modules/job/joblist.php" 
                class = "w3-bar-item w3-button w3-mobile">Job
            </a>
            <a href = "/m6/public/modules/forum/forumlist.php" 
                class = "w3-bar-item w3-button w3-mobile">Forum
            </a>
            <a href = "/m6/public/modules/project/projectlist.php" 
                class = "w3-bar-item w3-button w3-mobile">Project
            </a>
            <a href = "/m6/public/contactus.php" 
                class = "w3-bar-item w3-button w3-mobile">Contact
            </a>
            <a href = "/m6/public/logout.php" 
                class = "w3-bar-item w3-button w3-right w3-light-grey 
                w3-mobile">Logout
            </a>
        </div>
        <div class = "container" align = "center" 
            style = "width:90%; padding:50px 0px; margin:0 auto;">
<?php 
        }
    } else {
?>
        <link rel = "stylesheet" href = "https://www.w3schools.com/w3css/4/w3.css">
        <link rel = "stylesheet" href = "/m6/css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel = "stylesheet" href = "/m6/css/pure-release-1.0.0/pure-min.css">
    </head>
    </body>
        <div class = "w3-bar w3-black w3-large" align = "center">
            <img src = "/m6/images/logo1.png"  alt= "Community Portal Logo"
                style = "width:100px; height:100px; margin-top:10px; 
                margin-bottom:10px" >
        </div>
        <div class = "w3-bar w3-black w3-large">
            <a href = "/m6/public/index.php" 
                class = "w3-bar-item w3-button w3-mobile">
                <i class = "w3-margin-right"></i>Home
            </a>
            <a href = "/m6/public/aboutus.php" 
                class = "w3-bar-item w3-button w3-mobile">About Us
            </a>
            <a href = "/m6/public/contactus.php" 
                class = "w3-bar-item w3-button w3-mobile">Contact
            </a>
            <a href = "/m6/public/login.php" 
                class = "w3-bar-item w3-button w3-right w3-light-grey 
                w3-mobile">Login
            </a>
        </div>
        <div class = "container" align = "center" 
            style = "width:90%; padding:50px 0px; margin:0 auto;">
<?php 
    } 
?>