<!--- LAST UPDATE 01 NOV -->

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

// Check weather Form has sent and POST variable declared
if (isset($_POST['f_cur_dbname_edit']) &&
    isset($_POST['f_cur_tbname_edit']) &&
    isset($_POST['f_edit_colNums']) &&
    isset($_POST['f_pri_col']) &&
    isset($_POST['f_pri_val']) &&
    isset($_POST['f-edit-records'])
    ) {

    // Store in SESSION variable via POST variable
    if(isset($_POST['f_cur_dbname_edit'])) {
        $_SESSION['s_cur_dbname_edit'] = $_POST['f_cur_dbname_edit'];
    }

    // Store in SESSION variable via POST variable
    if(isset($_POST['f_cur_tbname_edit'])) {
        $_SESSION['s_cur_tbname_edit'] = $_POST['f_cur_tbname_edit'];
    }

    // Store in SESSION variable via POST variable
    if(isset($_POST['f_edit_colNums'])) {
        $_SESSION['s_edit_colNums'] = $_POST['f_edit_colNums'];
    }

    // Store in SESSION variable via POST variable
    if(isset($_POST['f_pri_col'])) {
        $_SESSION['s_pri_col'] = $_POST['f_pri_col'];
    }

     // Store in SESSION variable via POST variable
    if(isset($_POST['f_pri_val'])) {
        $_SESSION['s_pri_val'] = $_POST['f_pri_val'];
    }

    // Store in SESSION variable via POST variable
    if(isset($_POST['f-edit-records'])) {
        $_SESSION['s-edit-records'] = $_POST['f-edit-records'];
    }



    // store arrays from SESSION to local variable
    // This variable has table name
    $dbname = $_SESSION['s_cur_dbname_edit'];

    // store arrays from SESSION to local variable
    // This variable has database names
    $tbname = $_SESSION['s_cur_tbname_edit'];
    
    // store arrays from SESSION to local variable
    // This variable has column names
    // this array come from processing page
    $columns_arr = $_SESSION['s-edit-record-columns'];

    // store arrays from SESSION to local variable
    // This variable has column count
    $colsCount = $_SESSION['s_edit_colNums'];

    // store arrays from SESSION to local variable
    // This variable has records values
    $pri_col = $_SESSION['s_pri_col'];

    // store arrays from SESSION to local variable
    // This variable has records values
    $pri_val = $_SESSION['s_pri_val'];

    // store arrays from SESSION to local variable
    // This variable has records values
    $set_val_arr = $_SESSION['s-edit-records'];

    // declaare a empty array
    $edit_val_array = array();

    // run loop until colscount
    for($i=0;$i<$colsCount;$i++) {
        $x = $i;
        // assign values from a array to b array as per $x value
        $var = $columns_arr[$x] . "=" . "'" . $set_val_arr[$x] . "'";
        // push values to empty array
        array_push($edit_val_array, $var);
    }

    // omplode array
    $edit_vals = implode(",",$edit_val_array);

    // check is connectors session variable are available or not
    if (
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
       )
       {
        // store values in local variable
        $username = validate($_SESSION['s-username']);
        $hostname = validate($_SESSION['s-hostname']);
        $password = validate($_SESSION['s-password']); 
        
        // call function to create table
        update($hostname, $username, $password, $dbname, $tbname, $pri_col,  $pri_val, $edit_vals);
       }
}
else {
    // if form hasnt sent the name but page visit directly so redirect to loginpage
    // also destroy the session
    echo "<script> 
    alert('Do not direct access page'); 
    location.href='index.php';
    </script>";

    // // destroy the session
    session_destroy();
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
function  update($hostname, $username, $password, $dbname, $tbname, $pri_col,  $pri_val, $edit_vals) {

    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password, $dbname);
        
        // query
        $sql = "UPDATE" . " " . "`" . $tbname . "`" . " " . "SET" . " " . $edit_vals . " " . "WHERE" . " " . $pri_col . "=" . " " . "'" . $pri_val . "'" .  " " . ";";

        // run query within try to catch error
        try {
            // execute query
            $con->query($sql);
        
            // Store 'yes' status in session variable
            $_SESSION['s-record-edit-status'] = "updated";

            // unset value of SESSION
            unset($_SESSION['s_cur_dbname_edit']);
            unset($_SESSION['s_cur_tbname_edit']);
            unset($_SESSION['s_edit_colNums']);
            unset($_SESSION['s_pri_col']);
            unset($_SESSION['s_pri_val']);
            unset($_SESSION['s-edit-records']);

            // redirect to records browse page
            echo "<script> location.href='home/browse_records.php'; </script>";
        }
        catch(EXCEPTION $error) {
            $message = $error->getMessage();
            echo "<br>";
            echo  $message;

            // store this message in session variable
            $_SESSION['s-record-edit-status'] = "not-updated";

            // send notice with error message
            $_SESSION['s-record-edit-message'] = $message;
            

            // unset value of SESSION
            // do not unset database name session variable otherwise this will distroy session
            // unset($_SESSION['s-show-tb-db-name']);
            unset($_SESSION['s_cur_dbname_edit']);
            unset($_SESSION['s_cur_tbname_edit']);
            unset($_SESSION['s_edit_colNums']);
            unset($_SESSION['s_pri_col']);
            unset($_SESSION['s_pri_val']);
            unset($_SESSION['s-edit-records']);
          
            // redirect to records browse page
            echo "<script> location.href='home/browse_records.php'; </script>";
        }
        // close the connection
        $con->close();
    }
    catch(EXCEPTION $error) {
        // if connection counln't establish 
        $message = $error->getMessage();

        // store this message in session variable
        $_SESSION['s-record-edit-status'] = "not-updated";
         
        // store this message in session variable
        $_SESSION['s-record-edit-message'] = $message;

        // unset value of SESSION
        // do not unset database name session variable otherwise this will distroy session
        // unset($_SESSION['s-show-tb-db-name']);

        // unset value of SESSION

        // redirect to records browse page
        echo "<script> location.href='home/browse_records.php'; </script>";
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