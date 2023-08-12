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
session_start();

// check if form submitted
if(isset($_POST['f-del-col-tbname']) &&
   isset($_POST['f-del-col-dbname']) &&
   isset($_POST['f-del-col-field'])
   ) {
   
    // store in SESSION variable
    $_SESSION['s-del-col-tbname'] = $_POST['f-del-col-tbname'];
    $_SESSION['s-del-col-dbname'] = $_POST['f-del-col-dbname'];
    $_SESSION['s-del-col-field'] = $_POST['f-del-col-field'];

    // store in loal variable
    $del_col_tbname = $_SESSION['s-del-col-tbname'];
    $del_col_dbname = $_SESSION['s-del-col-dbname'];
    $del_col_fieldname = $_SESSION['s-del-col-field'];

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
        delete_col($hostname, $username, $password, $del_col_tbname, $del_col_dbname, $del_col_fieldname);
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



function delete_col($hostname, $username, $password, $del_col_tbname, $del_col_dbname, $del_col_fieldname) {
    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password, $del_col_dbname);

        // Query
        $sql = "ALTER TABLE" . " " .  "`" . $del_col_tbname . "`" . " " . "DROP" . "`" .  $del_col_fieldname . "`;";

        // run query
        try {
            $con->query($sql);

            // set SESSION variable with deleted success status msg
            $_SESSION['s-del-col-status'] = "deleted-col";

            // unset name recieved
            unset($_SESSION['s-del-col-tbname']);
            unset($_SESSION['s-del-col-dbname']);
            unset($_SESSION['s-del-col-field']);

            // redirect to structure
            echo "<script> location.href='structure.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            // set SESSION variable with NOT deleted success status msg
            $_SESSION['s-del-col-status'] = "not-delete-col";

            // unset name recieved
            unset($_SESSION['s-del-col-tbname']);
            unset($_SESSION['s-del-col-dbname']);
            unset($_SESSION['s-del-col-field']);

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
