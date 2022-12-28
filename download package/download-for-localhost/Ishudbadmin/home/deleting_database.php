<!--- LAST UPDATE 04 OCT -->

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
// Continue the session
session_start();

// check if form submitted
if(isset($_POST['f-del-db-value'])) {
   
    // check if deletion selected db name recieved using GLOBAL POST variable
    // store in SESSION variable
    $_SESSION['del-db-name-input'] = $_POST['f-del-db-value'];

    // store in loal variable
    $del_db_name = $_SESSION['del-db-name-input'];

    if (
        // check is login session var set
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
       )
       {
        // validate and save in local variable
        $username_cdb = validate($_SESSION['s-username']);
        $hostname_cdb = validate($_SESSION['s-hostname']);
        $password_cdb = validate($_SESSION['s-password']); 
    
        // calll function who will delete db
        delete_database($hostname_cdb, $username_cdb, $password_cdb, $del_db_name);
       }
}
else {
    // alert and redirect to logn page if someone try to direclt access
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



function delete_database($hostname_cdb, $username_cdb, $password_cdb, $del_db_name) {
    try {
        // establish connection
        $con = new mysqli($hostname_cdb, $username_cdb, $password_cdb);

        // Query
        $sql = "DROP DATABASE" . " " .  $del_db_name . ";";

        // run query
        try {
            $con->query($sql);

            // set SESSION variable with deleted success status msg
            $_SESSION['s-del-db-status'] = "deleted-db";

            // unset name recieved
            unset($_SESSION['del-db-name-input']);

            // redirect to homepage
            echo "<script> location.href='home/homepage.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            // set SESSION variable with NOT deleted success status msg
            $_SESSION['s-del-db-status'] = "not-delete-db";

            // unset name recieved
            unset($_SESSION['del-db-name-input']);

            // redirect to homepage
            echo "<script> location.href='home/homepage.php'; </script>";
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
