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
    isset($_POST['f-new-table-input-table-name']) &&
    isset($_POST['f-new-table-storage-engine']) &&
    isset($_POST['f-new-table-input-colom-name']) &&
    isset($_POST['f-new-table-input-data-type']) &&
    isset($_POST['f-new-table-input-length']) &&
    isset($_POST['f-new-table-submit-btn']) &&
    isset($_POST['f-table-cols-num']) ||
    isset($_POST['f-new-table-input-comment']) ||
    isset($_POST['f-new-table-input-attribute']) ||
    isset($_POST['f-new-table-input-colum-comment']) ||
    isset($_POST['f-new-table-input-index']) ||
    isset($_POST['f-new-table-input-default']) ||
    isset($_POST['f-new-table-input-null']) ||
    isset($_POST['f-new-table-input-auto-increment']) 
    ) {

    // Store in SESSION variable via POST variable
    if(isset($_POST['f-new-table-input-table-name'])) {
        $_SESSION['s-new-table-input-table-name'] = $_POST['f-new-table-input-table-name'];
    }
    if(isset($_POST['f-new-table-input-comment'])) {
        $_SESSION['s-new-table-input-comment'] = $_POST['f-new-table-input-comment'];
    }
    if(isset($_POST['f-new-table-storage-engine'])) {
        $_SESSION['s-new-table-storage-engine'] = $_POST['f-new-table-storage-engine'];
    }
    if(isset($_POST['f-new-table-input-colom-name'])) {
        $_SESSION['s-new-table-input-colom-name'] = $_POST['f-new-table-input-colom-name'];
    }
    if(isset($_POST['f-new-table-input-data-type'])) {
        $_SESSION['s-new-table-input-data-type'] = $_POST['f-new-table-input-data-type'];
    }
    if(isset($_POST['f-new-table-input-length'])) {
        $_SESSION['s-new-table-input-length'] = $_POST['f-new-table-input-length'];
    }
    if(isset($_POST['f-new-table-input-attribute'])) {
        $_SESSION['s-new-table-input-attribute'] = $_POST['f-new-table-input-attribute'];
    }
    if(isset($_POST['f-new-table-input-colum-comment'])) {
        $_SESSION['s-new-table-input-colum-comment'] = $_POST['f-new-table-input-colum-comment'];
    }
    if(isset($_POST['f-new-table-input-index'])) {
        $_SESSION['s-new-table-input-index'] = $_POST['f-new-table-input-index'];
    }
    if(isset($_POST['f-new-table-input-default'])) {
        $_SESSION['s-new-table-input-default'] = $_POST['f-new-table-input-default'];
    }
    if(isset($_POST['f-new-table-input-null'])) {
        $_SESSION['s-new-table-input-null'] = $_POST['f-new-table-input-null'];
    }
    if(isset($_POST['f-new-table-input-auto-increment'])) {
        $_SESSION['s-new-table-input-auto-increment'] = $_POST['f-new-table-input-auto-increment'];
    }
    if(isset($_POST['f-table-cols-num'])) {
        $_SESSION['s-table-cols-num'] = $_POST['f-table-cols-num'];
    }
   
    
    // store arrays from SESSION to local variable
    // This array has column names
    // mandatory
    if(!empty($_SESSION['s-new-table-input-colom-name'])) {
        $array_1 = $_SESSION['s-new-table-input-colom-name'];
    }
    else {
        $array_1 = array("");
    }

    // This array has data types
    // mandatory
    if(!empty($_SESSION['s-new-table-input-data-type'])) {
        $array_2 = $_SESSION['s-new-table-input-data-type'];
    }
    else {
        $array_2 = array("");
    }
   
    // This array has table column length
    // mandatory
    if(!empty($_SESSION['s-new-table-input-length'])) {
        $array_3 = $_SESSION['s-new-table-input-length'];
    }
    else {
        $array_3 = array("");
    }
  
    // This array has column attributes
    // Optional
    if(!empty($_SESSION['s-new-table-input-attribute'])) {
        $array_4 = $_SESSION['s-new-table-input-attribute']; 
    }
    else {
        $array_4 = array("");
    }
   
    // This array has columns comments
    // Optional
    if(!empty($_SESSION['s-new-table-input-colum-comment'])) {
        $array_5 = $_SESSION['s-new-table-input-colum-comment'];
    }
    else {
        $array_5 = array("");
    }
   
    // This array has index select values
    // Optional
    // its default value is already null
    if(!empty($_SESSION['s-new-table-input-index'])) {
        $array_6 = $_SESSION['s-new-table-input-index'];
    }
    else {
        $array_6 = array("");
    }
 
    // This aray has default values
    // Optional
    // its default value is already null
    if(!empty($_SESSION['s-new-table-input-default'])) {
        $array_7 = $_SESSION['s-new-table-input-default'];
    }
    else {
        $array_7 = array("");
    }
   
    // This array has nul checkbox values
    // Checkbox    
    // Optional
    if(!empty($_SESSION['s-new-table-input-null'])) {
        $array_8 = $_SESSION['s-new-table-input-null']; 
    }
    else {
        $array_8 = array("");
    }
  
    // This array has auto_increment checkbox values
    // Optional
    if(!empty($_SESSION['s-new-table-input-auto-increment'])) {
        $array_9 = $_SESSION['s-new-table-input-auto-increment']; 
    }
    else {
        $array_9 = array("");
    }

    // Database name store in local variable from SESSION variable
    $dbname = $_SESSION['s-show-tb-db-name'];
     // Table Name value store in local variable from SESSION variable
    $table_name =  $_SESSION['s-new-table-input-table-name'];
    // Num of cols store in local variable from SESSION variable
    $colCount = $_SESSION['s-table-cols-num'];
    // Storage enine value store in local variable from SESSION variable
    $storageEngine = $_SESSION['s-new-table-storage-engine'];
    // make table comment in format if not empty else set as null
    if(!empty($_SESSION['s-new-table-input-comment'])) {
        $table_comment  = "," . " " . "COMMENT =" . " " . "'" . $_SESSION['s-new-table-input-comment'] . "'";
    }
    else {
        // initiate variable as null
        $table_comment = "";
    }

    // // remove 1 bcox foreach loop will start from 0
    $realcolCount =  $colCount - 1;

    // create a empty array
    $array_main = array();

    // run loop until count value
    for($i=0;$i<=$realcolCount;$i++) {
        // assign value of i to x
        $x = $i;
        // check if array of perticular index is set
        if(isset($array_1[$x])) {
            // if set then store in local vari
            $colom_name = $array_1[$x];
        } 
        else {
            // if not then initiate var as null
            $colom_name = "";
        }
            // check if array of perticular index is set
        if(isset($array_2[$x])) {
            $dataType = $array_2[$x];
        } 
        else {
             // if not then initiate var as null
            $dataType = "";
        }

        // check if array of perticular index is set
        if(isset($array_3[$x])) {
            $length = $array_3[$x];
        } 
        else {
              // if not then initiate var as null
            $length = "";
        }

        // check if array of perticular index is set
        if(isset($array_4[$x])) {
            $attr = $array_4[$x];
        } 
        else {
              // if not then initiate var as null
            $attr = "";
        }

        // check if array of perticular index is set
        if(isset($array_5[$x])) {
            $col_comment = "COMMENT" . " " . "'" . $array_5[$x];
        } 
        else {
              // if not then initiate var as null
            $col_comment = "";
        }

        // check if array of perticular index is set
        if(isset($array_6[$x])) {
            $col_index = $array_6[$x];
        } 
        else {
              // if not then initiate var as null
            $col_index = "";
        }

        // check if array of perticular index is set
        if(isset($array_7[$x])) {
            $col_default = $array_7[$x];
        } 
        else {
              // if not then initiate var as null
            $col_default = "";
        }

        // check if array of perticular index is set
        if(isset($array_8[$x])) {
            $null = $array_8[$x];
        } 
        else {
              // if not then initiate var as null
            $null = "";
        }

        // check if array of perticular index is set
        if(isset($array_9[$x])) {
            $increment = $array_9[$x];
        } 
        else {
              // if not then initiate var as null
            $increment = "";
        }


        // crete complete column command
        $data = 
        "`" . 
        $colom_name
         . "`" . " " . 
        $dataType 
        . "(" . 
        $length
         . ")" . " " . 
        $attr
         . " " . 
        $null
         . " " . 
        $col_default
         . " " . 
        $increment
         . " " . 
        $col_comment
         . "'" . " " . 
        $col_index;

        // insert data var value in array on every value of i
        array_push($array_main,$data);

        // store master data imploded in SESSION variable
        $_SESSION['s-coloms'] = implode(",",$array_main);
    }

    // store each column master data in local variable from SESSION
    $coloms = $_SESSION['s-coloms'];
    
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
        create_table($hostname, $username, $password, $dbname, $table_name, $coloms, $storageEngine, $table_comment);
       }
}
else {
    // if form hasnt sent the name but page visit directly so redirect to loginpage
    // also destroy the session

    echo "<script> 
    alert('Do not direct access page'); 
    location.href='index/index.php';
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
function  create_table($hostname, $username, $password, $dbname, $table_name, $coloms, $storageEngine, $table_comment) {

    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password);
        
        // query
        $sql = "CREATE TABLE " . "`" . $dbname . "`" . "." . "`"  . $table_name . "`" . " " . "(" 
               . $coloms . ")" . " " . "ENGINE =" . " " . $storageEngine  . $table_comment . ";" ;

        // run query within try to catch error
        try {
            // execute   query
            $con->query($sql);

            // Store 'yes' status in session variable
            $_SESSION['s-create-table-status'] = "created-table";

            // unset value of SESSION
            unset($_SESSION['s-new-table-input-table-name']);
            // do not unset database name session variable otherwise this will distroy session
            // unset($_SESSION['s-show-tb-db-name']);
            unset($_SESSION['s-new-table-input-comment']);
            unset($_SESSION['s-new-table-storage-engine']);
            unset($_SESSION['s-table-cols-num']);

            unset($_SESSION['s-new-table-input-colom-name']);
            unset($_SESSION['s-new-table-input-data-type']);
            unset($_SESSION['s-new-table-input-length']);
            unset($_SESSION['s-new-table-input-attribute']); 
            unset($_SESSION['s-new-table-input-colum-comment']);
            unset($_SESSION['s-new-table-input-index']);  
            unset($_SESSION['s-new-table-input-default']);     
            unset($_SESSION['s-new-table-input-null']); 
            unset($_SESSION['s-new-table-input-auto-increment']); 

            // redirect to table browse page
            echo "<script> location.href='home/tables_browse.php'; </script>";
        }
        catch(EXCEPTION $erro) {
            $msgg = $erro->getMessage();
            echo $msgg;
            // store this message in session variable
            $_SESSION['s-create-table-status'] = "failed-table-create";

            // send error message to notice
            $_SESSION['s-create-table-msg'] = $msgg;
          
            // unset value of SESSION
            unset($_SESSION['s-new-table-input-table-name']);
            // do not unset database name session variable otherwise this will distroy session
            // unset($_SESSION['s-show-tb-db-name']);
            unset($_SESSION['s-new-table-input-comment']);
            unset($_SESSION['s-new-table-storage-engine']);
            unset($_SESSION['s-table-cols-num']);
            
            unset($_SESSION['s-new-table-input-colom-name']);
            unset($_SESSION['s-new-table-input-data-type']);
            unset($_SESSION['s-new-table-input-length']);
            unset($_SESSION['s-new-table-input-attribute']); 
            unset($_SESSION['s-new-table-input-colum-comment']);
            unset($_SESSION['s-new-table-input-index']);  
            unset($_SESSION['s-new-table-input-default']);     
            unset($_SESSION['s-new-table-input-null']); 
            unset($_SESSION['s-new-table-input-auto-increment']); 

            // redirect to table browse page
            echo "<script> location.href='home/tables_browse.php'; </script>";
        }
        // close the connection
        $con->close();
    }
    catch(EXCEPTION $err) {
        // if connection counln't establish 
        $errMsg = $err->getMessage();

        // store this message in session variable
        $_SESSION['s-create-table-status'] = "failed-table-create";


        // unset value of SESSION
        unset($_SESSION['s-new-table-input-table-name']);
        // do not unset database name session variable otherwise this will distroy session
        // unset($_SESSION['s-show-tb-db-name']);
        unset($_SESSION['s-new-table-input-comment']);
        unset($_SESSION['s-new-table-storage-engine']);
        unset($_SESSION['s-table-cols-num']);
        
        unset($_SESSION['s-new-table-input-colom-name']);
        unset($_SESSION['s-new-table-input-data-type']);
        unset($_SESSION['s-new-table-input-length']);
        unset($_SESSION['s-new-table-input-attribute']); 
        unset($_SESSION['s-new-table-input-colum-comment']);
        unset($_SESSION['s-new-table-input-index']);  
        unset($_SESSION['s-new-table-input-default']);     
        unset($_SESSION['s-new-table-input-null']); 
        unset($_SESSION['s-new-table-input-auto-increment']); 

        // redirect to table browse page
        echo "<script> location.href='home/tables_browse.php'; </script>";
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
