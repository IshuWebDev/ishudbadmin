<!--- LAST UPDATE 22 OCT -->
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
if(isset($_POST['f-add-key-tbname']) &&
   isset($_POST['f-add-key-dbname']) &&
   isset($_POST['f-add-key-field']) &&
   isset($_POST['f-add-key-type'])
   ) {
   
    // store in SESSION variable
    $_SESSION['s-add-key-tbname'] = $_POST['f-add-key-tbname'];
    $_SESSION['s-add-key-dbname'] = $_POST['f-add-key-dbname'];
    $_SESSION['s-add-key-field'] = $_POST['f-add-key-field'];
    $_SESSION['s-add-key-type'] = $_POST['f-add-key-type'];

    // store in loal variable
    $add_key_tbname = $_SESSION['s-add-key-tbname'];
    $add_key_dbname = $_SESSION['s-add-key-dbname'];
    $add_key_fieldname = $_SESSION['s-add-key-field'];
    $add_key_type = $_SESSION['s-add-key-type'];

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
        addkey($hostname, $username, $password, $add_key_tbname, $add_key_dbname, $add_key_fieldname, $add_key_type);
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



function addkey($hostname, $username, $password, $add_key_tbname, $add_key_dbname, $add_key_fieldname, $add_key_type) {
    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password, $add_key_dbname);

        // Query
        $sql = "ALTER TABLE" . " " .  "`" . $add_key_tbname . "`" . " " . "ADD" . " " . $add_key_type . "(`" .  $add_key_fieldname . "`);";

        // run query
        try {
            $con->query($sql);
          
            // set SESSION variable with added success status msg
            $_SESSION['s-add-key-status'] = "added-key";

            // unset name recieved
            unset($_SESSION['s-add-key-tbname']);
            unset($_SESSION['s-add-key-dbname']);
            unset($_SESSION['s-add-key-field']);
            unset($_SESSION['s-add-key-type']);

            //redirect to structure
            echo "<script> location.href='structure.php'; </script>";
        }
        catch(EXCEPTION $error) {
            $msg = $error->getMessage();

            // set SESSION variable with NOT added success status msg
            $_SESSION['s-add-key-status'] = "not-added-key";
            $_SESSION['s-add-key-msg'] = $msg;

            // unset name recieved
            unset($_SESSION['s-add-key-tbname']);
            unset($_SESSION['s-add-key-dbname']);
            unset($_SESSION['s-add-key-field']);
            unset($_SESSION['s-add-key-type']);

            // redirect to structure
            echo "<script> location.href='structure.php'; </script>";
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
