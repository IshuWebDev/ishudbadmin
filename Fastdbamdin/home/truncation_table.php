<!--- LAST UPDATE 28 OCT -->

<html>
<head>
    <title> Processing... </title>

    <!--- STYLESHEET HREF -->
    <link rel="icon" type="image/x-icon" href="../image/logo_5px.png">
    <link rel="stylesheet" type="text/css" href="../style/homepage.css"/>

</head>

<body>
    <div id="load-box">
        <img src="../image/loader_1.svg" id="loader-1"/>
    </div>
</body>
</html>

<?php
// Continue the session
session_start();

// check if form submitted
if(isset($_SESSION['s-hostname']) && 
   isset($_SESSION['s-username']) &&
   isset($_SESSION['s-password']) &&
   isset($_SESSION['s-records-dbname']) &&
   isset($_SESSION['s-records-tbname']) 
   ) {
   
    // main username, hostname and password
    $hostname = $_SESSION['s-hostname'];
    $username = $_SESSION['s-username'];
    $password = $_SESSION['s-password'];

    // current database and table name
    $dbname = $_SESSION['s-records-dbname'];
    $tbname = $_SESSION['s-records-tbname'];

   
    if (
        // check is login session var set
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
       )
       {
        // validate and save in local variable
        $username = validate($_SESSION['s-username']);
        $hostname = validate($_SESSION['s-hostname']);
        $password = validate($_SESSION['s-password']); 
    
        // calll function who will delete db
        delete_record($hostname, $username, $password, $dbname, $tbname);
    }
}
else {
    // alert and redirect to logn page if someone try to direclt access
    echo "<script> 
    alert('Do not direct access page'); 
    location.href='../index.php';
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



function delete_record($hostname, $username, $password, $dbname, $tbname) {
    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password, $dbname);

        // Query
        $sql = "TRUNCATE TABLE" . " " . $tbname . ";";

        // run query
        try {
            $con->query($sql);
            // query has executed. No echo. No return
        }
        catch(EXCEPTION $erro) {
            // query has error. No echo. No return
            echo $erro->getMessage();
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