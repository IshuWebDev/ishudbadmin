<!--- LAST UPDATE 29 OCT -->

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
// Start the session
session_start();

// Check weather Form has sent and POST variable declared
if (isset($_POST['f_cur_tbname_insert']) &&
    isset($_POST['f_cur_dbname_insert']) &&
    isset($_POST['f_columns']) &&
    isset($_POST['f-records']) &&
    isset($_POST['f_colNums'])
    ) {

    // Store in SESSION variable via POST variable
    if(isset($_POST['f_cur_tbname_insert'])) {
        $_SESSION['s_cur_tbname_insert'] = $_POST['f_cur_tbname_insert'];
    }

    // Store in SESSION variable via POST variable
    if(isset($_POST['f_cur_dbname_insert'])) {
        $_SESSION['s_cur_dbname_insert'] = $_POST['f_cur_dbname_insert'];
    }

    // Store in SESSION variable via POST variable
    if(isset($_POST['f_columns'])) {
        $_SESSION['s_columns'] = $_POST['f_columns'];
    }

    // Store in SESSION variable via POST variable
    if(isset($_POST['f-records'])) {
        $_SESSION['s-records'] = $_POST['f-records'];
    }

    // Store in SESSION variable via POST variable
    if(isset($_POST['f_colNums'])) {
        $_SESSION['s_colNums'] = $_POST['f_colNums'];
    }

    // store arrays from SESSION to local variable
    // This variable has table name
    $table_name = $_SESSION['s_cur_tbname_insert'];

    // store arrays from SESSION to local variable
    // This variable has database names
    $dbname = $_SESSION['s_cur_dbname_insert'];
    
    // store arrays from SESSION to local variable
    // This variable has column names
    $columns = $_SESSION['s_columns'];

    // store arrays from SESSION to local variable
    // This variable has column count
    $colCount = $_SESSION['s_colNums'];

    // store arrays from SESSION to local variable
    // This variable has records values
    $records_array = $_SESSION['s-records'];
    
    // This variable has count of combined rows.
    $combinedRowCount = count($records_array);

    // This variable has value of how many total rows to be inserted
    $value_brackets = $combinedRowCount / $colCount;

    // create a empty array
    $main_array = array();

    // run this loop until total numbers of rows
    for($i=1; $i<=$value_brackets; $i++) {
        // This formula return initial value variable for where should array should slice
        // $ini-val = 0 + $colCount * $i - $colCount
        //example let $colCount = 3
        // 0 + 3 * 0 - 3 = 0
        // 0 + 3 * 1 - 3 = 0
        // 0 + 3 * 2 - 3 = 3
        // 0 + 3 * 3 - 3 = 6
        // ...

        $ini_val = 0 + $colCount * $i - $colCount;
       
        // This array contain the sliced values of $records_array
        $sliced_records_array = array_slice($records_array,  $ini_val, $colCount);

        // This is empty array
        $values_array = array();

        // run foreach loop for all values of $sliced_records_array
        foreach($sliced_records_array as $value) {
            // add quotation for every value of $sliced_records_array
            $records_value = "'" . $value . "'";

            // insert these values in $values_array 
            array_push($values_array, $records_value);
        }

        // impolde $values_array array
        $all_values = implode(",", $values_array);

        // push all quotaioned values to $main_array
        array_push($main_array, $all_values);
    }

    // records value array
    $records_values_array = array();

    // run this loop for all values of $main_array 
    foreach($main_array as $values) {
        // add bracket to all values 
        $each_record = "(" . $values . ")";

        // push $each_record values in $records_values_array
        array_push($records_values_array, $each_record);
    }

    // implode the $records_values_array to make ready VALUES
    $all_records_value = implode(",",$records_values_array);
    // transfer to main function
    $values = $all_records_value;

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
        insert($hostname, $username, $password, $dbname, $table_name, $columns, $values);
       }
}
else {
    // if form hasnt sent the name but page visit directly so redirect to loginpage
    // also destroy the session

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

// This function will estb connection and create database
// get values in arguments
function  insert($hostname, $username, $password, $dbname, $table_name, $columns, $values) {

    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password, $dbname);
        
        // query
        $sql = "INSERT INTO" . " " . "`" . $table_name . "`" . " " . "(" . " " . $columns . " " . ")" . " " . "VALUES" . " " . $values . ";";
       
        // run query within try to catch error
        try {
            // execute query
            $con->query($sql);

            // Store 'yes' status in session variable
            $_SESSION['s-record-insert-status'] = "inserted";

            // unset value of SESSION
            unset($_SESSION['s_cur_tbname_insert']);
            unset($_SESSION['s_cur_dbname_insert']);
            unset($_SESSION['s_columns']);
            unset($_SESSION['s-records']);
            unset($_SESSION['s_colNums']);

            // redirect to records browse page
            echo "<script> location.href='browse_records.php'; </script>";
        }
        catch(EXCEPTION $error) {
            $message = $error->getMessage();
            echo "<br>";
            echo  $message;

            // store this message in session variable
            $_SESSION['s-record-insert-status'] = "not-inserted";

            // send notice with error message
            $_SESSION['s-record-insert-message'] = $message;

            // unset value of SESSION
            // do not unset database name session variable otherwise this will distroy session
            // unset($_SESSION['s-show-tb-db-name']);
            unset($_SESSION['s_cur_tbname_insert']);
            unset($_SESSION['s_cur_dbname_insert']);
            unset($_SESSION['s_columns']);
            unset($_SESSION['s-records']);
            unset($_SESSION['s_colNums']);
           
            // redirect to records browse page
            echo "<script> location.href='browse_records.php'; </script>";
        }
        // close the connection
        $con->close();
    }
    catch(EXCEPTION $error) {
        // if connection counln't establish 
        $message = $error->getMessage();

        // store this message in session variable
        $_SESSION['s-record-insert-status'] = "not-inserted";
         
        // store this message in session variable
        $_SESSION['s-record-insert-message'] = $message;

        // unset value of SESSION
        // do not unset database name session variable otherwise this will distroy session
        // unset($_SESSION['s-show-tb-db-name']);

         // unset value of SESSION
         unset($_SESSION['s_cur_tbname_insert']);
         unset($_SESSION['s_cur_dbname_insert']);
         unset($_SESSION['s_columns']);
         unset($_SESSION['s-records']);
         unset($_SESSION['s_colNums']);

        // redirect to records browse page
        echo "<script> location.href='browse_records.php'; </script>";
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