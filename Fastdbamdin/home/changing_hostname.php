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
        <img src="./image/loader_1.svg" id="loader-1"/>
    </div>
</body>
</html>

<?php
// Continue the session
session_start();

// check if form submitted
if(
    isset($_POST['f-change_new_hostname']) &&
    isset($_POST['f-hn_cnua_cur_host']) &&
    isset($_POST['f-hn_cnua_cur_user'])
    ) {
   
    // store in SESSION variable via POST global variable
    $_SESSION['s-change_new_hostname'] = $_POST['f-change_new_hostname'];
    $_SESSION['s-hn-cnua_cur_host'] = $_POST['f-hn_cnua_cur_host'];
    $_SESSION['s-hn-cnua_cur_user'] = $_POST['f-hn_cnua_cur_user'];

    // store in loal variable
    $new_hostname =  $_SESSION['s-change_new_hostname'];
    $curr_username = $_SESSION['s-hn-cnua_cur_user'];
    $curr_hostname = $_SESSION['s-hn-cnua_cur_host'];

    if (
        // check is login session var set
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
       )
       {
        // validate and save in local variable
        $username_uach = validate($_SESSION['s-username']);
        $hostname_uach = validate($_SESSION['s-hostname']);
        $password_uach = validate($_SESSION['s-password']); 
    
        // call function 
        change_hostname($hostname_uach, $username_uach, $password_uach, $new_hostname, $curr_username, $curr_hostname);
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



function  change_hostname($hostname_uach, $username_uach, $password_uach, $new_hostname, $curr_username, $curr_hostname) {
    try {
        // establish connection
        $con = new mysqli($hostname_uach, $username_uach, $password_uach);

        // Query
        $sql = "RENAME USER" . " " . "'" .  $curr_username  . "'" . "@" . "'" . $curr_hostname . "'" . " " . "TO" . " " . "'" .$curr_username . "'" . "@" . "'" . $new_hostname . "'" . " " . ";";
      
        // run query
        try {
            $con->query($sql);
            // set SESSION variable with success status msg
            $_SESSION['s-cng-host-status'] = "changed-hostname";
          
            // unset data recieved
            unset($_SESSION['s-change_new_hostname']);
            unset($_SESSION['s-hn-cnua_cur_host']);
            unset($_SESSION['s-hn-cnua_cur_user']);

            // redirect to homepage
            echo "<script> location.href='user_account.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            // set SESSION variable with NOT success status msg
            $_SESSION['s-cng-host-status'] = "not-changed-host";
          
           // unset data recieved
           unset($_SESSION['s-change_new_hostname']);
           unset($_SESSION['s-hn-cnua_cur_host']);
           unset($_SESSION['s-hn-cnua_cur_user']);

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
