<!--- LAST UPDATE 04 OCT -->

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
if(
    isset($_POST['f-del-user-acc-username']) &&
    isset($_POST['f-del-user-acc-hostname'])
    ) {
   
    // store in SESSION variable
    $_SESSION['s-del-user-acc-username'] = $_POST['f-del-user-acc-username'];
    $_SESSION['s-del-user-acc-hostname'] = $_POST['f-del-user-acc-hostname'];

    // store in loal variable
    $del_user_name = $_SESSION['s-del-user-acc-username'];
    $del_host_name = $_SESSION['s-del-user-acc-hostname'];

    if (
        // check is login session var set
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
       )
       {
        // validate and save in local variable
        $username_dua = validate($_SESSION['s-username']);
        $hostname_dua = validate($_SESSION['s-hostname']);
        $password_dua = validate($_SESSION['s-password']); 
    
        // calll function who will delete user
        delete_user($hostname_dua, $username_dua, $password_dua, $del_user_name, $del_host_name);
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



function delete_user($hostname_dua, $username_dua, $password_dua, $del_user_name, $del_host_name) {
    try {
        // establish connection
        $con = new mysqli($hostname_dua, $username_dua, $password_dua);

        // Query
        $sql = "DROP USER" . " " .  "'" . $del_user_name . "'" ."@" . "'" . $del_host_name .  "'" . " "  . ";";

        // run query
        try {
            $con->query($sql);

            // set SESSION variable with deleted success status msg
            $_SESSION['s-del-user-status'] = "deleted-user";

            echo "done";

            // unset username/hostname recieved
            unset($_SESSION['s-del-user-acc-username']);
            unset($_SESSION['s-del-user-acc-hostname']);

            // redirect to user-aacount 
            echo "<script> location.href='user_account.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            // set SESSION variable with NOT deleted success status msg
            $_SESSION['s-del-user-status'] = "not-delete-user";

            echo "faild";
            
            // unset name recieved
            unset($_SESSION['s-del-user-acc-username']);
            unset($_SESSION['s-del-user-acc-hostname']);

          // redirect to user-aacount
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
