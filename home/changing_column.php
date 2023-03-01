<!--- LAST UPDATE 05 NOV -->

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
    <div id="load-box">
        <img src="image/loader_1.svg" id="loader-1"/>
    </div>
</body>
</html>

<?php
// Start the session
session_start();

// Check weather Form has sent and POST variable declared
if (
    isset($_POST['f-change-col-cur-tb-name']) &&
    isset($_POST['f-change-col-cur-db-name']) &&
    isset($_POST['f-change-col-cur-column']) &&
    isset($_POST['f-change-col-in-table-input-colom-name']) &&
    isset($_POST['f-change-col-in-table-input-data-type']) &&
    isset($_POST['f-change-col-in-table-input-length']) ||
    isset($_POST['f-change-col-in-table-input-attribute']) ||
    isset($_POST['f-change-col-in-table-input-colum-comment']) ||
    isset($_POST['f-change-col-in-table-input-default']) ||
    isset($_POST['f-change-col-in-table-as-defined-text-in']) ||
    isset($_POST['f-change-col-in-table-input-null']) ||
    isset($_POST['f-change-col-in-table-input-auto-increment']) 
    ) {

    // Store in SESSION variable via POST variable
    if(isset($_POST['f-change-col-cur-tb-name'])) {
        $_SESSION['s-change-col-cur-tb-name'] = $_POST['f-change-col-cur-tb-name'];
    }
    if(isset($_POST['f-change-col-cur-db-name'])) {
        $_SESSION['s-change-col-cur-db-name'] = $_POST['f-change-col-cur-db-name'];
    }
    if(isset($_POST['f-change-col-cur-column'])) {
        $_SESSION['s-change-col-cur-column'] = $_POST['f-change-col-cur-column'];
    }
    if(isset($_POST['f-change-col-in-table-input-colom-name'])) {
        $_SESSION['s-change-col-in-table-input-colom-name'] = $_POST['f-change-col-in-table-input-colom-name'];
    }
    if(isset($_POST['f-change-col-in-table-input-data-type'])) {
        $_SESSION['s-change-col-in-table-input-data-type'] = $_POST['f-change-col-in-table-input-data-type'];
    }
    if(isset($_POST['f-change-col-in-table-input-length'])) {
        $_SESSION['s-change-col-in-table-input-length'] = $_POST['f-change-col-in-table-input-length'];
    }
    if(isset($_POST['f-change-col-in-table-input-attribute'])) {
        $_SESSION['s-change-col-in-table-input-attribute'] = $_POST['f-change-col-in-table-input-attribute'];
    }
    if(isset($_POST['f-change-col-in-table-input-colum-comment'])) {
        $_SESSION['s-change-col-in-table-input-colum-comment'] = $_POST['f-change-col-in-table-input-colum-comment'];
    }
    if(isset($_POST['f-change-col-in-table-input-default'])) {
        $_SESSION['s-change-col-in-table-input-default'] = $_POST['f-change-col-in-table-input-default'];
    }
    if(isset($_POST['f-change-col-in-table-as-defined-text-in'])) {
        $_SESSION['s-change-col-in-table-as-defined-text-in'] = $_POST['f-change-col-in-table-as-defined-text-in'];
    }
    if(isset($_POST['f-change-col-in-table-input-null'])) {
        $_SESSION['s-change-col-in-table-input-null'] = $_POST['f-change-col-in-table-input-null'];
    }
   if(isset($_POST['f-change-col-in-table-input-auto-increment'])) {
        $_SESSION['s-change-col-in-table-input-auto-increment'] = $_POST['f-change-col-in-table-input-auto-increment'];
    }
   
    // Store in local variable 
    $cur_db_name = $_SESSION['s-change-col-cur-db-name'];

    // Store in local variable 
    $cur_tb_name = $_SESSION['s-change-col-cur-tb-name'];

    // Store in local variable 
    $old_col_name = $_SESSION['s-change-col-cur-column'];
    
    // Store in local variable 
    $new_column_name = $_SESSION['s-change-col-in-table-input-colom-name'];

    // Store in local variable 
    $data_type = $_SESSION['s-change-col-in-table-input-data-type'];

    // Store in local variable 
    $length =  $_SESSION['s-change-col-in-table-input-length'];

    // Store in local variable 
    $attr_val = $_SESSION['s-change-col-in-table-input-attribute'];

    // Store in local variable 
    $comment_val = $_SESSION['s-change-col-in-table-input-colum-comment'];

    // Store in local variable 
    $default_val =  $_SESSION['s-change-col-in-table-input-default'];

    // Store in local variable 
    $default_defined_in = $_SESSION['s-change-col-in-table-as-defined-text-in'];


    // filter default
    if($default_val == "none-default") {
        $default = "";
    }
    else if ($default_val == "DEFAULT NULL") {
        $default = "DEFAULT NULL";
    }
    else if ($default_val == "DEFAULT CURRENT_TIMESTAMP") {
        $default = "DEFAULT CURRENT_TIMESTAMP";
    }
    else if ($default_val == "DEFAULT DEFINED") {
        $default = "DEFAULT" . " " . "'" . $default_defined_in . "'";
    }


    // filter attribute
    if($attr_val == "none-attribute") {
        $attr = "";
    }
    else {
        $attr = $attr_val;
    }


    // filter null
    if(isset($_POST['f-change-col-in-table-input-null'])) {
        $null = "NOT NULL";
    }
    else {
        $null = "NULL";
    }

   // filter auto increment
   if(isset($_POST['f-change-col-in-table-input-auto-increment'])) {
    $ai = "AUTO_INCREMENT";
    }
    else {
        $ai = "";
    }

    // filter comment
    if(empty($comment_val)) {
        $comment = "";
    }
    else {
        $comment = "COMMENT" . " " . "'" . $comment_val . "'";
    }


       
    // $sql = "ALTER TABLE" . " " . "`" . $cur_tb_name . "`" . " " . "CHANGE" . " " . "`" . $old_col_name . "`" . " " . "`" . $new_column_name . "`" . " " . $data_type . "(" . $length . ")" . " " .
    // $attr . " " . $null . " " . $default . " " . $ai . " " .  $comment . " " . ";" ;


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
        changecol($hostname, $username, $password, $cur_db_name, $cur_tb_name, $old_col_name, $new_column_name, $data_type, $length, $attr, $null, $default, $ai, $comment);
       }
}
else {
    // if form hasnt sent the name but page visit directly so redirect to loginpage
    // also destroy the session

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

// This function will estb connection and create database
// get values in arguments
function   changecol($hostname, $username, $password, $cur_db_name, $cur_tb_name, $old_col_name, $new_column_name, $data_type, $length, $attr, $null, $default, $ai, $comment) {

    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password, $cur_db_name);
        
        // query
        $sql = "ALTER TABLE" . " " . "`" . $cur_tb_name . "`" . " " . "CHANGE" . " " . "`" . $old_col_name . "`" . " " . "`" . $new_column_name . "`" . " " . $data_type . "(" . $length . ")" . " " .
        $attr . " " . $null . " " . $default . " " . $ai . " " .  $comment . " " . ";" ;

        echo $sql;

        // run query within try to catch error
        try {
            // execute   query
            $con->query($sql);
            
            // Store 'yes' status in session variable
            $_SESSION['s-change-col-status'] = "change-table";

            // unset value of SESSION
            // do not unset database name session variable otherwise this will distroy session
            // unset($_SESSION['s-show-tb-db-name']);

            unset($_SESSION['s-change-col-cur-db-name']);
            unset($_SESSION['s-change-col-cur-tb-name']);
            unset($_SESSION['s-change-col-cur-column']);
            unset($_SESSION['s-change-col-in-table-input-colom-name']);
            unset($_SESSION['s-change-col-in-table-input-data-type']);
            unset($_SESSION['s-change-col-in-table-input-length']);
            unset($_SESSION['s-change-col-in-table-input-attribute']);
            unset($_SESSION['s-change-col-in-table-input-colum-comment']);
            unset($_SESSION['s-change-col-in-table-input-default']);
            unset($_SESSION['s-change-col-in-table-as-defined-text-in']);
            unset($_SESSION['s-change-col-in-table-input-null']);
            unset($_SESSION['s-change-col-in-table-input-auto-increment']);

            // redirect to table browse page
            echo "<script> location.href='home/structure.php'; </script>";
        }
        catch(EXCEPTION $error) {
            $msgg = $error->getMessage();
           
            // store this message in session variable
            $_SESSION['s-change-col-status'] = "failed-table-change";

            // send error message to notice
            $_SESSION['s-change-col-msg'] = $msgg;
          
            // unset value of SESSION
            // do not unset database name session variable otherwise this will distroy session
            // unset($_SESSION['s-show-tb-db-name']);
            unset($_SESSION['s-change-col-cur-db-name']);
            unset($_SESSION['s-change-col-cur-tb-name']);
            unset($_SESSION['s-change-col-cur-column']);
            unset($_SESSION['s-change-col-in-table-input-colom-name']);
            unset($_SESSION['s-change-col-in-table-input-data-type']);
            unset($_SESSION['s-change-col-in-table-input-length']);
            unset($_SESSION['s-change-col-in-table-input-attribute']);
            unset($_SESSION['s-change-col-in-table-input-colum-comment']);
            unset($_SESSION['s-change-col-in-table-input-default']);
            unset($_SESSION['s-change-col-in-table-as-defined-text-in']);
            unset($_SESSION['s-change-col-in-table-input-null']);
            unset($_SESSION['s-change-col-in-table-input-auto-increment']);

            // redirect to table browse page
            echo "<script> location.href='home/structure.php'; </script>";
        }
        // close the connection
        $con->close();
    }
    catch(EXCEPTION $error) {
        // if connection counln't establish 
        $errMsg = $error->getMessage();
       
        // store this message in session variable
        $_SESSION['s-change-col-status'] = "failed-table-change";

        // send error message to notice
        $_SESSION['s-change-col-msg'] = $errMsg;

        // unset value of SESSION
        // do not unset database name session variable otherwise this will distroy session
        // unset($_SESSION['s-show-tb-db-name']);
        unset($_SESSION['s-add-col-in-table-input-colom-name']);
        unset($_SESSION['s-add-col-in-table-input-data-type']);
        unset($_SESSION['s-add-col-in-table-input-length']);
        unset($_SESSION['s-add-col-in-table-input-colum-comment']);
        unset($_SESSION['s-add-col-in-table-input-index']);
        unset($_SESSION['s-add-col-in-table-input-attribute']);
        unset($_SESSION['s-add-col-in-table-input-default']);
        unset($_SESSION['s-add-col-in-table-as-defined-text-in']);
        unset($_SESSION['s-add-col-in-table-input-null']);
        unset($_SESSION['s-add-col-in-table-input-auto-increment']);
        unset($_SESSION['s-add-col-cur-tb-name']);
        unset($_SESSION['s-add-col-cur-db-name']);
        unset($_SESSION['s-add-col-cur-next-name']);
      
        // redirect to table browse page
        echo "<script> location.href='home/structure.php'; </script>";
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
