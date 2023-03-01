<!--- LAST UPDATE 22 OCT -->
<!--- PROCESSING RECORDS --->

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
// Continue the session
session_start();

// check if name input available submitted
if(isset($_POST['f-records-dbname']) &&
   isset($_POST['f-records-tbname'])
    ) {
   
    // store in SESSION variable
    $_SESSION['s-records-dbname'] = $_POST['f-records-dbname'];
    $_SESSION['s-records-tbname'] = $_POST['f-records-tbname'];

    $dbname = $_SESSION['s-records-dbname'];
    $tbname = $_SESSION['s-records-tbname'];

    $hostname = $_SESSION['s-hostname'];
    $username = $_SESSION['s-username'];
    $password  = $_SESSION['s-password'];

    // get column names and column count
    try {
        $con = new mysqli($hostname, $username, $password);

        $sql = "DESC" . " " . $dbname . "." . $tbname . " " . ";";

        $result = $con->query($sql);
        if($result-> num_rows > 0 ) {
            $fields_array = array();
            $key_array = array();
            while($data = $result->fetch_assoc()) {
                array_push($fields_array,$data['Field']);
                array_push($key_array,$data['Key']);
            }

            $aray_count = count($fields_array);
            
            $_SESSION['s-record-fields-name-array'] = $fields_array;
            $_SESSION['s-records-field-count'] = $aray_count;
            $_SESSION['s-records-key-array'] = $key_array;
           
 
          echo "<script> location.href='home/browse_records.php'; </script>";
        }
    }
    catch(EXCEPTION $error) {
        $errmsg = $error->getMessage();
        echo "<script> alert({$errmsg}); </script>";
    }
}
else {
    // alert and redirect to logn page if someone try to direct access
    echo "<script> 
    alert('Do not direct access page'); 
    location.href='index.php';
    </script>";
    // destroy the session
    session_destroy();
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