<?php
// Continue the session
session_start();
?>

<!--- LAST UPDATE 04 OCT --->
<!DOCTYPE html>
<html lang="en">
<head>
    <!--- BASE -->
    <base href="http://127.0.0.1/ishudbadmin/"/>

    <!--- JQUERY API --->
    <script defer="true" src="https://code.jquery.com/jquery-3.6.1.js"></script>

    <!-- JAVASCRIPT --->
    <script defer="true" src="script/login.js"></script>

    <!--- FAVICON --->
    <link rel="icon" type="image/x-icon" href="image/favocin.png">

    <!--- STYLESHEET --->
    <link rel="stylesheet" type="text/css" href="style/login.css" media="screen and (min-width: 1000px)"/>
    <link rel="stylesheet" type="text/css" href="style/mobile.css"  media="screen and (max-width: 1000px)"/>

    <!--- META --->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--- GOOGLE FONTS API --->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">

    <!--- TITLE --->
    <title> IshuDbAdmin :: Welcome </title>
</head>
<body onload="offloader()">

    <!-- loader box -->
    <div id="load-box">
        <img src="image/loader_1.svg" id="loader-1"/>
    </div>

    <!--- DESKTOP VIEW PART -->
    <div class="desktop-view">
        <div class="image-container">
            <img src="image/logo.png" class="logo"/>
        </div>
        <div class="container">
            <div class="box2">
                <p class="login-text"> Login </p>
                <form method="post" action="home/logon.php" id="main_form">
                    <div class="box1">
                        <p class="server-text"> Select Server </p>
                        <select name="f-server-type" class="server_select" id="server_typeid">
                            <option value="none"> Please Select Server </option>
                            <option value="mysql"> MySQL 8.0.30 </option>
                            <option value="mariadb"> MariaDB 10.9.3 </option>
                        </select>
                    </div>
                    <input id="hostname_id" type="text" name="f-hostname" placeholder="Hostname OR IP Address enter" class="input-1"/>
                    <input id="username_id" type="text" name="f-username" placeholder="Username enter" class="input-2"/>
                    <input id="password_id" type="password" name="f-password" placeholder="Password enter" class="input-3"/>
                    <button id="submit-btn" type="submit" class="btn"> Proceed</button>
                </form>
            </div>
        </div>
        <p class="footer-text"> IshuDbAdmin is Designed and Developed by Ishu Gupta. Powered by Core PHP 8.1 &copy 2022. Download This OpenSource Project From <a href="https://www.github.com/ishuwebdev/ishudbadmin"> Github </a></p>
    </div> <!--- DESKTOP VIEW PART -->
    
    <!--- MOBILE VIEW -->
    <div class="mobile-view">
        <div class="img-container">
            <img src="image/logo.png" id="mob-id"/>
        </div>
    </div>
    <!--- MOBILE VIEW -->


    
<!--- Notice Box RED --->
<div id="red-notice-wrapper">
    <div id="notice-red">
        <img src="image/warning.png" class="warning-img"/>
        <div id="red-text-wrapper">
            <p id="red-text">xx</p>
        </div>
    </div>
</div>


<!--- Notice Box GREEN --->
<div id="green-notice-wrapper">
    <div id="notice-green">
        <img src="image/done.png" class="done-img"/>
        <div id="green-text-wrapper">
            <p id="green-text"></p>
        </div>  
    </div>
</div>

</body>
</html>

<script>
function green_notice(data) {
            var message = data;
    
            document.getElementById("green-notice-wrapper").style.display = "flex";
            document.getElementById("notice-green").style.marginTop = "300px";
            document.getElementById("green-text").innerText = message;
            
            setTimeout(() => {
                document.getElementById("notice-green").style.marginTop = "10px";
            },1000);
        
            setTimeout(() => {
                document.getElementById("notice-green").style.transform = "scale(110%,110%)";
               
            },1500);
        
            setTimeout(() => {
                document.getElementById("notice-green").style.transform = "scale(90%,90%)";
                
            },2500);
        
            setTimeout(() => {
                document.getElementById("notice-green").style.marginTop = "300px";
                
            },3000);

            setTimeout(() => {
                document.getElementById("notice-green").style.transform = "scale(100%,100%)";
                document.getElementById("green-notice-wrapper").style.display = "none";
            },4000);
}

function red_notice(data) {
            var message = data;

            document.getElementById("red-notice-wrapper").style.display = "flex";
            document.getElementById("notice-red").style.marginTop = "300px";
            document.getElementById("red-text").innerText = message;

            setTimeout(() => {
                document.getElementById("notice-red").style.marginTop = "10px";
            },1000);
        
            setTimeout(() => {
                document.getElementById("notice-red").style.transform = "scale(110%,110%)";
            },1500);
        
            setTimeout(() => {
                document.getElementById("notice-red").style.transform = "scale(90%,90%)";
            },2500);
        
            setTimeout(() => {
                document.getElementById("notice-red").style.marginTop = "300px";
            },3000);

            setTimeout(() => {
                document.getElementById("notice-red").style.transform = "scale(100%,100%)";
                document.getElementById("red-notice-wrapper").style.display = "none";
            },4000);
}
</script>

<?php
// If session has started and declared
if(isset($_SESSION['status']))
{
    if($_SESSION['status'] == "logout-done") {

        // Unset SESSION value
        unset($_SESSION['status']);
        // Destroy session
        session_destroy();

        // Show Notice of Logout
        echo '<script> 
        var message = `Successfully Logged Out The Session`;
        green_notice(message);
        </script>';
    }
}

// Check if SESSION has declared
if(isset($_SESSION['login-status']))
{
    // check SESSION value
    if($_SESSION['login-status'] == "unable-login") {

        // Unset SESSION value
        unset($_SESSION['login-status']);

       // Show Notice of No-response
       echo '<script> 
        var message = `MySql Said : ';
       echo $_SESSION['login-status-msg'] . "`";
       echo '
        red_notice(message);
       </script>';
    }
    unset($_SESSION['login-status-msg']);
}

?>



<script>
     if(!navigator.onLine) {
       alert("Ohh you're not connected to the Internet!");
       location.href="http://127.0.0.1/";
        
     }
</script>

<noscript> 
        <div 
        style="position: fixed; top: 0; left:0; width:100%; height: 100vh; 
        background-color: rgb(255, 255, 255); z-index: 2000;
        display: flex; justify-content:center; align-items: center;">
        <h1 style="background-color: rgb(246, 167, 167); border-radius: 10px; padding: 10px; font-size: 30px;"> Please Enable Your Browser's Javascript Engine! </h1>
        </div>
</noscript>