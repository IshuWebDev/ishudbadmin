<!--- LAST UPDATE 05 OCT -->
<html>
<head>
    <!--- BASE HREF -->
    <base href="http://127.0.0.1/ishudbadmin/"/>

    <!--- Title --->
    <title> Processing... </title>

    <!--- STYLESHEET HREF -->
    <link rel="icon" type="image/x-icon" href="image/logo_5px.png">
    <link rel="stylesheet" type="text/css" href="style/homepage.css"/>
</head>
<body>
    <!--- Loading Box --->
    <div id="load-box">
        <img src="image/loader_1.svg" id="loader-1"/>
    </div>

</body>
</html>

<?php
// Start the session
session_start();

// Check weather Form has sent name of new database or not
if(isset($_POST['cdb-f-name'])) {

    // if name was send the store in session variable
    $_SESSION['new-db-name-input'] = $_POST['cdb-f-name'];

    // Store session variable in a local variable
    $db_new_name = $_SESSION['new-db-name-input'];

    // check is connectors session variable are available or not
    if (
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
       )
       {
        // store values in local variable
        $username_cdb = validate($_SESSION['s-username']);
        $hostname_cdb = validate($_SESSION['s-hostname']);
        $password_cdb = validate($_SESSION['s-password']); 
    
        // function to establish connection and create the database
        create_database($hostname_cdb, $username_cdb, $password_cdb, $db_new_name);
       }
}
else {
    // if form hasnt sent the name but page visit directly so redirect to loginpage
    // also destroy the session
    session_destroy();

    echo "<script> 
    alert('Do not direct access page'); 
    location.href='index.php';
    </script>";

    // destroy the session
    session_destroy();
}


// This function will remove impurities from form input
function validate($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


// This function will estb connection and create database
// get values in arguments
function create_database($hostname_cdb, $username_cdb, $password_cdb, $db_new_name) {
    try {
        // establish connection
        $con = new mysqli($hostname_cdb, $username_cdb, $password_cdb);

        // query
        $sql = "CREATE DATABASE" . " " .  $db_new_name . ";";

        // run query within try to catch error
        try {
            // execute query
            $con->query($sql);
            // Store 'yes' status in session variable
            $_SESSION['s-created-database-status'] = "created-db";
            // unset value of get new database name
            unset($_SESSION['new-db-name-input']);
             // redirect to homepage if database has create
            echo "<script> location.href='home/homepage.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            // if error occur means already db has available
            // store this message in session variable
            $_SESSION['s-created-database-status'] = "not-created-db";
            // unset the value of new database name
            unset($_SESSION['new-db-name-input']);
            // redirect to homepage
            echo "<script> location.href='home/homepage.php'; </script>";
        }
        // close the connection
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
