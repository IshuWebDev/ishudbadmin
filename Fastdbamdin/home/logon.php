
<!DOCTYPE html>
<html lang="en">
<head>
    <!--- STYLESHEET HREF -->
    <link rel="icon"       type="image/x-icon" href="../image/logo_5px.png">
    <link rel="stylesheet" type="text/css" href="../style/homepage.css"/>
    
    <!--- Meta --->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--- Title --->
    <title> Processing... </title>
</head>
<body>
    <!--- Loading Box --->
    <div id="load-box">
        <img src="../image/loader_1.svg" id="loader-1"/>
    </div>

</body>
</html>

<?php
// continue the session
session_start();

if(
    isset($_REQUEST['f-server-type']) &&
    isset($_REQUEST['f-username']) &&
    isset($_REQUEST['f-hostname']) &&
    isset($_REQUEST['f-password'])
)
{   
    // check if form has method POST
    if($_SERVER['REQUEST_METHOD'] == "POST") {

            // validate input values via validate function and store POST variable values in SESSION variables
            $_SESSION['s-server-type'] = validate($_POST['f-server-type']);
            $_SESSION['s-hostname'] = validate($_POST['f-hostname']);
            $_SESSION['s-username'] = validate($_POST['f-username']);
            $_SESSION['s-password'] = validate($_POST['f-password']);

            // store values of session variables in local variables
            $hostname_ck = $_SESSION['s-hostname'];
            $username_ck = $_SESSION['s-username'];
            $password_ck = $_SESSION['s-password'];

            // run function to check authentication and connection statsu
            check($hostname_ck, $username_ck, $password_ck);
    }
    else {
        echo "
        <script>
        console.log('Method is not POST');
        </script>";
    }
}
else {
    echo "
    <script>
    console.log('Form data has destroyed, You should not re-visit logon page after submition or refresh after submittion');
    alert('You have not permission to directly visit the page');
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

// This function will establish a connection and redirect to homepage
function check($hostname_ck, $username_ck, $password_ck) {

    // this statement will not let php show errors while hostname is invalid
    ini_set("display_errors","0");

    // Establish connection
    try {
        // create connection
        $con = new mysqli($hostname_ck, $username_ck, $password_ck);

        // KEEP LOGIN STATUS ACTIVE 
        $_SESSION['login-status'] = "active";

        // redirect to homepage when connected
        header("location: homepage.php");
    }

    catch(EXCEPTION $error) {
        // Null the SESSON variable values if connection failed
        $_SESSION['s-server-type'] = "";
        $_SESSION['s-hostname'] = "";
        $_SESSION['s-username'] = "";
        $_SESSION['s-password'] = "";

        // store error message
        $errorMsg = $error->getMessage();

        // Store Username/passsword incorect message in SESSION variable
        $_SESSION['login-status'] = "unable-login";
        $_SESSION['login-status-msg'] =  $errorMsg;

        // Redirect back to index page if password or username or hostname is Incorrect
            echo "<script> 
            location.href='../index.php';
            </script>";
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