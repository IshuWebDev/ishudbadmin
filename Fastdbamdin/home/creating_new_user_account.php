<!--- LAST UPDATE 08 OCT -->

<html>
<head>
    <!--- Title --->
    <title> Processing... </title>

    <!--- STYLESHEET HREF -->
    <link rel="icon" type="image/x-icon" href="../image/logo_5px.png">
    <link rel="stylesheet" type="text/css" href="../style/homepage.css"/>
</head>
<body>
    <!-- Loading Box --->
    <div id="load-box">
        <img src="../image/loader_1.svg" id="loader-1"/>
    </div>
</body>
</html>

<?php
// Continue the session
session_start();

// Check weather Form has sent name of new database or not
if (
    isset($_POST['f-create_new_user']) &&
    isset($_POST['f-create_new_host']) &&
    isset($_POST['f-create_new_pass']) &&
    isset($_POST['f-create_new_repass'])
    ) {

    // if details was send the store in session variable
    $_SESSION['s-create_new_user'] = $_POST['f-create_new_user'];
    $_SESSION['s-create_new_host'] = $_POST['f-create_new_host'];
    $_SESSION['s-create_new_pass'] = $_POST['f-create_new_pass'];

        $username_new = $_SESSION['s-create_new_user'];
        $hostname_new = $_SESSION['s-create_new_host'];
        $password_set = $_SESSION['s-create_new_pass'];

    // check is connectors session variable are available or not
    if (
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
       )
       {
        // store values in local variable
        $username_cua = validate($_SESSION['s-username']);
        $hostname_cua = validate($_SESSION['s-hostname']);
        $password_cua = validate($_SESSION['s-password']); 
    
        // function to establish connection and create the user account
        create_user_account($hostname_cua, $username_cua, $password_cua, $username_new, $hostname_new, $password_set);
       }
}
else {
    // if form hasnt sent the name but page visit directly so redirect to loginpage
    // also destroy the session
    session_destroy();

    echo "<script> 
    alert('Do not direct access page'); 
    location.href='../index.php';
    </script>";
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
function create_user_account($hostname_cua, $username_cua, $password_cua, $username_new, $hostname_new, $password_set) {
    try {
        // establish connection
        $con = new mysqli($hostname_cua, $username_cua, $password_cua);

        // query
        $sql = "CREATE USER" . " " .  "'" . $username_new . "'" ."@" . "'" . $hostname_new .  "'" . " " . "IDENTIFIED BY" . " "  . "'" .$password_set . "'"  . " "  . ";";

        // run query within try to catch error
        try {
            // execute query
            $con->query($sql);
            // Store 'yes' status in session variable
            $_SESSION['s-created-user-status'] = "created-user";
            // unset value of get new user account
            unset($_SESSION['s-create_new_user']);
            unset($_SESSION['s-create_new_host']);
            unset($_SESSION['s-create_new_pass']);
             // redirect to homepage if user acc has create
           echo "<script> location.href='user_account.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            // if error occur means already user acc has available
            // store this message in session variable
            $_SESSION['s-created-user-status'] = "not-created-user";
             // unset value of get new user account
             unset($_SESSION['s-create_new_user']);
             unset($_SESSION['s-create_new_host']);
             unset($_SESSION['s-create_new_pass']);
              // redirect to homepage if user account has create
            echo "<script> location.href='user_account.php'; </script>";
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
