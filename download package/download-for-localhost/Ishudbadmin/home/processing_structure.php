<!--- LAST UPDATE 22 OCT -->

<html>
<head>
    <!--- BASE HREF -->
    <base href="http://127.0.0.1/ishudbadmin/"/>

    <title> Processing... </title>

    <!--- STYLESHEET HREF -->
    <link rel="icon" type="image/x-icon" href="image/logo_5px.png">
    <link rel="stylesheet" type="text/css" href="style/homepage.css"/>

</head>

<body>
     <!--- Loading -->
    <div id="load-box">
        <img src="image/loader_1.svg" id="loader-1"/>
    </div>
</body>
</html>

<?php
// Continue the session
session_start();

// check if name input available submitted
if(isset($_POST['f-stucture-dbname']) &&
   isset($_POST['f-stucture-tbname'])
    ) {
   
    // store in SESSION variable
    $_SESSION['s-stucture-dbname'] = $_POST['f-stucture-dbname'];
    $_SESSION['s-stucture-tbname'] = $_POST['f-stucture-tbname'];

    echo "<script> location.href='home/structure.php'; </script>";
}
else {
    // alert and redirect to logn page if someone try to direct access
    echo "<script> 
    alert('Do not direct access page'); 
    location.href='index.php';
    </script>";
    // destroy the session
    session_destroy();
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