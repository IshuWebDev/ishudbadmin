<!--- LAST UPDATE 06 OCT -->
<html>
<head>
    <script defer="true" type="text/javascript" src="./script/home.js"></script>

    <title> Processing... </title>

    <!--- STYLESHEET HREF -->
    <link rel="icon" type="image/x-icon" href="../image/logo_5px.png"/>
    <link rel="stylesheet" type="text/css" href="../style/homepage.css"/>

</head>

<body>
    <div id="load-box">
        <img src="../image/loader_1.svg" id="loader-1"/>
    </div>
</body>
</html>

<?php
// Continue session
session_start();

// check if form submited or not
if(isset($_POST['f-db-tb-show-name'])) {

    // assign form value in SESSION variable
    $_SESSION['s-show-tb-db-name'] = $_POST['f-db-tb-show-name'];

}
else {
// if form not submited the redirect to login page
echo "<script> location.href='../index.php'; </script>";

// destroy session
session_destroy();
}

// redirect to table show page
echo "<script> location.href='tables_browse.php'; </script>";

?>

<script>
     if(!navigator.onLine) {
       alert("Ohh you're not connected to the Internet!");
       location.href="../";
        
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