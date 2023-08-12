<!--- LAST UPDATE 10 OCT -->

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
session_start();

// check if form submitted
if(
    isset($_POST['f-change_new_user_pass']) &&
    isset($_POST['f-ps_cnua_cur_user']) &&
    isset($_POST['f-ps_cnua_cur_host'])
    ) {
   
    // store in SESSION variable via POST global variable
    $_SESSION['s-change_new_user_pass'] = $_POST['f-change_new_user_pass'];
    $_SESSION['s-ps_cnua_cur_user'] = $_POST['f-ps_cnua_cur_user'];
    $_SESSION['s-ps_cnua_cur_host'] = $_POST['f-ps_cnua_cur_host'];

    // store in loal variable
    $new_password =  $_SESSION['s-change_new_user_pass'];
    $curr_username = $_SESSION['s-ps_cnua_cur_user'];
    $curr_hostname = $_SESSION['s-ps_cnua_cur_host'];

    if (
        // check is login session var set
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
       )
       {
        // validate and save in local variable
        $username_uaps = validate($_SESSION['s-username']);
        $hostname_uaps = validate($_SESSION['s-hostname']);
        $password_uaps = validate($_SESSION['s-password']); 
    
        // call function 
        change_password($hostname_uaps, $username_uaps, $password_uaps, $new_password, $curr_username, $curr_hostname);
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



function  change_password($hostname_uaps, $username_uaps, $password_uaps, $new_password, $curr_username, $curr_hostname) {
    try {
        // establish connection
        $con = new mysqli($hostname_uaps, $username_uaps, $password_uaps);

        // Query
        $sql = "ALTER USER" . " " . "'" .  $curr_username  . "'" . "@" . "'" . $curr_hostname . "'" . " " . "IDENTIFIED BY" . " " . "'" . $new_password . "'" . ";";
      
        // run query
        try {
            $con->query($sql);
            // set SESSION variable with success status msg
            $_SESSION['s-cng-pass-status'] = "changed-pass";
          
            // unset data recieved
            unset($_SESSION['s-change_new_user_pass']);
            unset($_SESSION['s-ps_cnua_cur_user']);
            unset($_SESSION['s-ps_cnua_cur_host']);

            // redirect to homepage
            echo "<script> location.href='user_account.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            // set SESSION variable with NOT success status msg
            $_SESSION['s-cng-pass-status'] = "not-changed-pass";
          
           // unset data recieved
           unset($_SESSION['s-change_new_user_pass']);
           unset($_SESSION['s-ps_cnua_cur_user']);
           unset($_SESSION['s-ps_cnua_cur_host']);

            // redirect to homepage
            echo "<script> location.href='user_account.php'; </script>";
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
