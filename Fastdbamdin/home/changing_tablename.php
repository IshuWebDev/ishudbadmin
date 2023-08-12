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
    isset($_POST['f-rename_tb_cur_tbname']) &&
    isset($_POST['f-rename_tb_cur_dbname']) &&
    isset($_POST['f-change_new_tbname'])
    ) {
   
    // store in SESSION variable via POST global variable
    $_SESSION['s-rename_tb_cur_tbname'] = $_POST['f-rename_tb_cur_tbname'];
    $_SESSION['s-rename_tb_cur_dbname'] = $_POST['f-rename_tb_cur_dbname'];
    $_SESSION['s-change_new_tbname'] = $_POST['f-change_new_tbname'];

    // store in loal variable
    $cur_tablename =  $_SESSION['s-rename_tb_cur_tbname'];
    $cur_dbanme = $_SESSION['s-rename_tb_cur_dbname'];
    $new_tablename = $_SESSION['s-change_new_tbname'];

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
    
        // call function 
        change_tbname($hostname, $username, $password, $new_tablename, $cur_dbanme, $cur_tablename);
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



function    change_tbname($hostname, $username, $password, $new_tablename, $cur_dbanme, $cur_tablename) {
    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password, $cur_dbanme);

        // Query
        $sql = "RENAME TABLE" . " " . $cur_tablename . " " . "TO" . " " . $new_tablename . " ;";
      
        // run query
        try {
            $con->query($sql);
            // set SESSION variable with success status msg
            $_SESSION['s-change-tbname-status'] = "changed";
          
            // unset data recieved
            unset($_SESSION['s-rename_tb_cur_tbname']);
            unset($_SESSION['s-rename_tb_cur_dbname']);
            unset($_SESSION['s-change_new_tbname']);
          
            // redirect to homepage
            echo "<script> location.href='tables_browse.php'; </script>";
        }
        catch(EXCEPTION $error) {
            $msg = $error->getMessage();

            // set SESSION variable with NOT success status
            $_SESSION['s-change-tbname-status'] = "not-changed";
        
            // set SESSION variable with NOT success status msg
            $_SESSION['s-change-tbname-message'] = $msg;

           // unset data recieved
            unset($_SESSION['s-rename_tb_cur_tbname']);
            unset($_SESSION['s-rename_tb_cur_dbname']);
            unset($_SESSION['s-change_new_tbname']);

            // redirect to homepage
           echo "<script> location.href='tables_browse.php'; </script>";
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
