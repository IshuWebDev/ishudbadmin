<!--- LAST UPDATE 22 OCT -->
<!--- PROCESSING RECORDS --->

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

// check if name input available submitted
if(isset($_POST['f-edit-record-cur-dbname']) &&
    isset($_POST['f-edit-record-cur-tbname']) &&
    isset($_POST['f-edit-record-pri-col-name']) &&
    isset($_POST['f-edit-record-pri-col-value'])
    ) {
   
    // store in SESSION variable
    $_SESSION['s-edit-record-cur-dbname'] = $_POST['f-edit-record-cur-dbname'];
    $_SESSION['s-edit-record-cur-tbname'] = $_POST['f-edit-record-cur-tbname'];
    $_SESSION['s-edit-record-pri-col-name'] = $_POST['f-edit-record-pri-col-name'];
    $_SESSION['s-edit-record-pri-col-value'] = $_POST['f-edit-record-pri-col-value'];

    $dbname = $_SESSION['s-edit-record-cur-dbname'];
    $tbname = $_SESSION['s-edit-record-cur-tbname'];

    // check is connectors session variable are available or not
    if (
        isset($_SESSION['s-username']) &&
        isset($_SESSION['s-hostname']) &&
        isset($_SESSION['s-password'])
    )
    {
        // store values in local variable
        $username = $_SESSION['s-username'];
        $hostname = $_SESSION['s-hostname'];
        $password = $_SESSION['s-password']; 
        
        // call function to create table
        con($hostname, $username, $password, $dbname, $tbname);
    }
}
else {
    // alert and redirect to logn page if someone try to direct access
    echo "<script> 
    alert('Do not direct access page'); 
    location.href='../index.php';
    </script>";
    // destroy the session
    session_destroy();
}

function con($hostname, $username, $password, $dbname, $tbname) {
      
      try {
            // establish a connection
            $con = new mysqli($hostname, $username, $password);

            // sql statement
            $sql = "DESC" . " " .$dbname . "." . $tbname . " " . ";";

            // execute query
            $result = $con->query($sql);
            // if any column found
            if($result-> num_rows > 0 ) {
                // declare empty array
                $columns_array = array();

                // until recouds are fethcing
                while($data = $result->fetch_assoc()) {
                    $cols = $data['Field'];
                    // alocate data to array
                    array_push($columns_array,$cols);
                }
                // store array in SESSION var
                $_SESSION['s-edit-record-columns'] = $columns_array;

                // redirect to edit record page
                echo "<script> location.href='edit_record.php'; </script>";
            }
      }
    catch(EXCEPTION $error) {
        $errormsg = $error->getMessage();

        echo "<script> alert({$errormsg}); </script>";
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