<!--- LAST UPDATE 12 OCT -->

<html>
<head>
    <title> Processing... </title>

    <!--- STYLESHEET HREF -->
    <link rel="icon" type="image/x-icon" href="../image/logo_5px.png">
    <link rel="stylesheet" type="text/css" href="../style/homepage.css"/>

</head>

<body>
      <!--- Loading -->
    <div id="load-box">
        <img src="../image/loader_1.svg" id="loader-1"/>
    </div> 
</body>
</html>

<?php
// Continue the session
session_start();

// check if form submitted
if  (
    isset($_POST['f-resource-max_queries']) &&
    isset($_POST['f-resource-max_update']) &&
    isset($_POST['f-resource-max_con']) &&
    isset($_POST['f-resource-max_user_con'])
    ) {

        // Store Post input values in SESSION
        $_SESSION['s-max-queries'] = $_POST['f-resource-max_queries'];
        $_SESSION['s-max-update'] = $_POST['f-resource-max_update'];
        $_SESSION['s-max-connection'] = $_POST['f-resource-max_con'];
        $_SESSION['s-max-user-con'] = $_POST['f-resource-max_user_con'];

    // check if main session var available
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

            // store in local variable the selected user 
            if(isset($_SESSION['s-priv_cur_user'])) {
                $curr_username = $_SESSION['s-priv_cur_user'];
            }
            if(isset($_SESSION['s-priv_cur_host'])) {
                $curr_hostname = $_SESSION['s-priv_cur_host'];
            }
                 
            $max_qiery =  $_SESSION['s-max-queries'];
            $max_update =  $_SESSION['s-max-update'];
            $max_con = $_SESSION['s-max-connection'];
            $max_user_con = $_SESSION['s-max-user-con'];

            // call function 
            resource_limit($hostname, $username, $password, $curr_username, $curr_hostname, $max_qiery, $max_update, $max_con, $max_user_con);
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



function  resource_limit($hostname, $username, $password, $curr_username, $curr_hostname, $max_qiery, $max_update, $max_con, $max_user_con) {


    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password);

        // Query
        $sql = "ALTER USER" . " " . "'" . $curr_username . "'" . "@" . "'" . $curr_hostname . "'" . " " 
                        . "WITH MAX_QUERIES_PER_HOUR" . " " . $max_qiery  . " "
                        . "MAX_UPDATES_PER_HOUR" . " " . $max_update . " "
                        . "MAX_CONNECTIONS_PER_HOUR" . " " . $max_con  . " "
                        . "MAX_USER_CONNECTIONS" . " " . $max_user_con  . ";";

        echo $sql;
        echo "<br>";
        // run query
        try {
            $con->query($sql);

            // set SESSION variable with success status msg
            $_SESSION['res-lim-status'] = "done";

            // redirect to homepage
            echo "<script> location.href='privileges.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            $errorMsg = $erro->getMessage();
          
            // set SESSION variable with NOT success status msg
            $_SESSION['res-lim-status'] = "failed";
            $_SESSION['res-lim-msg'] = $errorMsg;
          
            // redirect to homepage
            echo "<script> location.href='privileges.php'; </script>";
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