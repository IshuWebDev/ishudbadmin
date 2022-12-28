<!--- LAST UPDATE 12 OCT -->

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
    <div id="load-box">
        <img src="image/loader_1.svg" id="loader-1"/>
    </div> 
</body>
</html>

<?php
session_start();

// check if form submitted
if 
    (
    // check is login session var set
    isset($_SESSION['s-username']) &&
    isset($_SESSION['s-hostname']) &&
    isset($_SESSION['s-password'])
    )
{
        $username = $_SESSION['s-username'];
        $hostname = $_SESSION['s-hostname'];
        $password = $_SESSION['s-password'];

    // call function 
    flushh($hostname, $username, $password);    

}
else 
{
    // alert and redirect to logn page if someone try to direclt access
    echo "<script> 
    alert('Do not direct access page'); 
    location.href='index.php';
    </script>";
    // destroy the session
    session_destroy();
}


function flushh($hostname, $username, $password) {


    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password);

        // Query
        $sql = "FLUSH PRIVILEGES;";

        // run query
        try {
            $con->query($sql);

            // set SESSION variable with success status msg
            $_SESSION['flush-status'] = "done";

            // redirect to homepage
            echo "<script> location.href='home/privileges.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            $errorMsg = $erro->getMessage();

            // set SESSION variable with NOT success status msg
            $_SESSION['flush-status'] = "failed";
          
            // redirect to homepage
            echo "<script> location.href='home/privileges.php'; </script>";
        }
        $con->close();
    }
    catch(EXCEPTION $err) {
        $errMsg = $err->getMessage();
        echo "<script> console.log('{$errMsg}'); </scritp>";
    }
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