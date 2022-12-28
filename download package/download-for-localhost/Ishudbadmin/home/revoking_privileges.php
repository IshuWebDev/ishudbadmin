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
    <!--- Loading -->
    <div id="load-box">
        <img src="image/loader_1.svg" id="loader-1"/>
    </div> 
</body>
</html>

<?php
// Continue the session
session_start();

// get all checkbox values in array
if(isset($_POST['f-revoke-priv'])) {

    // store array in local variable
    $array_data = $_POST['f-revoke-priv'];
        
    // convert array of data to string and seperate from ,
    $priv_str = implode(",",$array_data);
    // check if main cretidentials are defined

    if (// check is login session var set
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
        )
        {
        // validate and save in local variable
        $username = validate($_SESSION['s-username']);
        $hostname = validate($_SESSION['s-hostname']);
        $password = validate($_SESSION['s-password']); 

        if(isset($_SESSION['s-priv_cur_user'])) {
            $curr_username = $_SESSION['s-priv_cur_user'];
        }
        if(isset($_SESSION['s-priv_cur_host'])) {
             $curr_hostname = $_SESSION['s-priv_cur_host'];
        }
                            
    // call function 
    priv_revoke($hostname, $username, $password, $curr_username, $curr_hostname, $priv_str);
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



function priv_revoke($hostname, $username, $password, $curr_username, $curr_hostname, $priv_str) {


    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password);

        // Query
        $sql = "REVOKE " . $priv_str . " " . "ON *.* FROM " . "'" . $curr_username . "'" . '@' . "'" . $curr_hostname . "'" . ";";

        // run query
        try {
            $con->query($sql);

            // set SESSION variable with success status msg
            $_SESSION['s-r-p-status'] = "done";
        
            // redirect to homepage
            echo "<script> location.href='home/privileges.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            $errorMsg = $erro->getMessage();

            // set SESSION variable with NOT success status msg
            $_SESSION['s-r-p-status'] = "failed";
            $_SESSION['s-r-p-msg'] = $errorMsg;


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