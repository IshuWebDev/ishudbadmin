<!--- LAST UPDATE 06 OCT -->

<?php
// Continue the session
session_start();

// Add external common script
require "common.html";

// These SESSION var should available everywhere but if user clear cache the these will swipeoutr and session will be destroyed
if (isset($_SESSION['s-hostname']) &&
    isset($_SESSION['s-username']) &&
    isset($_SESSION['s-password'])
    ) {
        echo "<script> console.log('Session has active'); </script>";
    }
    else {
        echo "<script>
        alert('Session has deactivated');
        </script>";
        echo "<script>
        location.href='../index.php';
        </script>";
        session_destroy();
    }
    
?>

<head>
    <!--- Title ---->
    <title> Browse Records </title>

</head>
<body onload="offloader()">

<!-- loader box -->
    <div id="load-box">
        <img src="../image/loader_1.svg" id="loader-1"/>
    </div>

<!--- NOTICE Box -->

<!--- Notice Box RED --->
<div id="red-notice-wrapper">
    <div id="notice-red">
        <img src="../image/warning.png" class="warning-img"/>
        <div id="red-text-wrapper">
            <p id="red-text">xx</p>
        </div>
    </div>
</div>


<!--- Notice Box GREEN --->
<div id="green-notice-wrapper">
    <div id="notice-green">
        <img src="../image/done.png" class="done-img"/>
        <div id="green-text-wrapper">
            <p id="green-text"></p>
        </div>  
    </div>
</div>

<!--- Notice Box YELLOW --->
<div id="yellow-notice-wrapper">
    <div id="notice-yellow">
        <img src="../image/yellow.png" class="yellow-img"/>
        <div id="yellow-text-wrapper">
            <p id="yellow-text"></p>
        </div>  
    </div>
</div>

<script>
function green_notice(data) {
            var message = data;
    
            document.getElementById("green-notice-wrapper").style.display = "flex";
            document.getElementById("notice-green").style.marginTop = "300px";
            document.getElementById("green-text").innerText = message;
            
            setTimeout(() => {
                document.getElementById("notice-green").style.marginTop = "10px";
            },1000);
        
            setTimeout(() => {
                document.getElementById("notice-green").style.transform = "scale(110%,110%)";
               
            },2000);
        
            setTimeout(() => {
                document.getElementById("notice-green").style.transform = "scale(90%,90%)";
                
            },3000);
        
            setTimeout(() => {
                document.getElementById("notice-green").style.marginTop = "300px";
                
            },4000);

            setTimeout(() => {
                document.getElementById("notice-green").style.transform = "scale(100%,100%)";
                document.getElementById("green-notice-wrapper").style.display = "none";
            },5000);
}

function red_notice(data) {
            var message = data;

            document.getElementById("red-notice-wrapper").style.display = "flex";
            document.getElementById("notice-red").style.marginTop = "300px";
            document.getElementById("red-text").innerText = message;

            setTimeout(() => {
                document.getElementById("notice-red").style.marginTop = "10px";
            },1000);
        
            setTimeout(() => {
                document.getElementById("notice-red").style.transform = "scale(110%,110%)";
            },2000);
        
            setTimeout(() => {
                document.getElementById("notice-red").style.transform = "scale(90%,90%)";
            },3000);
        
            setTimeout(() => {
                document.getElementById("notice-red").style.marginTop = "300px";
            },4000);

            setTimeout(() => {
                document.getElementById("notice-red").style.transform = "scale(100%,100%)";
                document.getElementById("red-notice-wrapper").style.display = "none";
            },5000);
}
</script>



<?php

// FOR SUCCESS INSERTION RECORDS
// Session is already started
// Check weather database delete status session variable is declared or not
if(isset($_SESSION['s-record-insert-status']))
{
    // check status of session variable
    if($_SESSION['s-record-insert-status'] == "inserted") {

        // unset this session variale
        unset($_SESSION['s-record-insert-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Records Has Been Inserted Successfully.';
        green_notice(message);
        </script>";
    }
}


// FOR NOT INSERTION RECORDS
// Check weather database delete status session variable is declared or not
if(isset($_SESSION['s-record-insert-status']))
{
    // check status of session variable
    if($_SESSION['s-record-insert-status'] == "not-inserted") {

       // unset this session variale
       unset($_SESSION['s-record-insert-status']);

       // store in local variables
       $error_message = $_SESSION['s-record-insert-message'];

      // Show Notice of No-response
      echo "<script> 
      var message =  `MySQL Said :: {$error_message}` ;
      red_notice(message);;
      </script>";
   }
   // unset error message
   unset($_SESSION['s-record-insert-message']);
}




// FOR SUCCESS EDIT RECORDS
// Session is already started
// Check weather database delete status session variable is declared or not
if(isset($_SESSION['s-record-edit-status']))
{
    // check status of session variable
    if($_SESSION['s-record-edit-status'] == "updated") {

        // unset this session variale
        unset($_SESSION['s-record-edit-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Record has Been Updated Successfully.';
        green_notice(message);
        </script>";
    }
}


// FOR NOT EDIT RECORDS
// Check weather database delete status session variable is declared or not
if(isset($_SESSION['s-record-edit-status']))
{
    // check status of session variable
    if($_SESSION['s-record-edit-status'] == "not-updated") {

       // unset this session variale
       unset($_SESSION['s-record-edit-status']);

       // store in local variables
       $error_message = $_SESSION['s-record-edit-message'];

      // Show Notice of No-response
      echo "<script> 
      var message =  `MySQL Said :: {$error_message}` ;
      red_notice(message);
      </script>";
   }
   // unset error message
   unset($_SESSION['s-record-edit-message']);
}

?>

    <!-- Top banner section  --->
    <div class='topbox'>

        <a href="homepage.php">
            <img src='../image/logo.png' class='logimg'/>
        </a>

        <div class="server-soft-box">
            <img src="../image/computer_1.png" class="ser-soft-img"/>
            <p id="ser-soft-head">Status: </p>
            <p id="ser-soft-text">
                   <!--- start php script --->
                <?php 
                     if  (
                        isset($_SESSION['s-hostname']) &&
                        isset($_SESSION['s-username']) &&
                        isset($_SESSION['s-password'])
                        )
                        {
                            $username_st = $_SESSION['s-username'];
                            $hostname_st = $_SESSION['s-hostname'];
                            $password_st = $_SESSION['s-password'];
    
                            connect_status($hostname_st, $username_st, $password_st);
                        }
                        // function to establish connection and show databases and tables
                        function connect_status($hostname_st, $username_st, $password_st) {
                            // establish connection
                            try {
                                $con = new mysqli($hostname_st, $username_st, $password_st);
                                echo "Connected";
                            }
                            catch(EXCEPTION $error) {
                                $errMsg = $error->getMessage();
                                echo "<script> console.log(`{$errMsg}`); </script>";
                                echo "Disconnected";
                            } 
                        }
            ?>
             <!--- end php script --->
            </p>
        </div>
        <div class="ipaddress-box">
            <img src="../image/dbSOft.png" class="ser-ip-soft-img"/>
            <p id="ser-ip-soft-head"> Host: </p>
            <p id="ser-ip-soft-text"> 
                <!--- start php script --->
                <?php 
                if(isset($_SESSION['s-hostname'])) {
                echo $_SESSION['s-hostname'];
                }
                else {
                    echo "";
                }
                ?>
                 <!--- end php script --->
            </p>
        </div>
        <div class="username-box">
            <img src="../image/username_1.png" class="ser-user-soft-img"/>
            <p id="ser-user-soft-head"> User: </p>
            <p id="ser-user-soft-text">
                  <!--- start php script --->
                <?php 
                if(isset($_SESSION['s-username'])) {
                echo $_SESSION['s-username'];
                }
                else {
                    echo "";
                }
                ?>
                  <!--- end php script --->
            </p>   
        </div>

        <button onclick="location.href='homepage.php';" class="top-btn" id="home_btn">
            <i class="fa fa-home" style="margin-right: 3px;" aria-hidden=""></i>
             Home </button>
        <button onclick="location.href='user_account.php';" class="top-btn" id="user_btn"> 
            <i class="fa fa-user" style="margin-right: 3px;" aria-hidden="true"></i>
            User account </button>
        <button  onclick="location.href='../logout.php';" class="top-btn" id="logout_btn"> 
            <i class="fa fa-sign-out" style="margin-right: 3px;" aria-hidden="true"></i>
            Logout </button>
    </div>

    <!--- SIDE AND MAIN SECTION BAR CONTAINER -->
    <div class="main-wrapper">
        <!-- Side bar secion  --->
        <div class="sidebox">

            <div class="database-container">

                <!--- php script to show databases --->
                <?php
                if  (
                    isset($_SESSION['s-hostname']) &&
                    isset($_SESSION['s-username']) &&
                    isset($_SESSION['s-password'])
                    )
                    {
                        $username_dt = $_SESSION['s-username'];
                        $hostname_dt = $_SESSION['s-hostname'];
                        $password_dt = $_SESSION['s-password'];

                        show_db_tb($hostname_dt, $username_dt, $password_dt);
                    }
                    // function to establish connection and show databases and tables
                    function show_db_tb($hostname_dt, $username_dt, $password_dt) {
                        // establish connection
                        try {
                            $con = new mysqli($hostname_dt, $username_dt, $password_dt);

                            // SQL statement to get database 
                            $query = "SHOW DATABASES;";
                            // Run query
                            $result = $con->query($query);
                            // Fetch data
                            if($result->num_rows > 0) {
                                while($data = $result->fetch_assoc()) {
                                    // get database each name on every fetch cycle
                                    $dbname = $data['Database'];

                                // To show list of databases
                                // show the database box
                                echo 
                                    "<button class='db-togle-btn-show' onClick='show(`{$data['Database']}`)' id='{$dbname}_btn_show'> expand </button>
                                    <button class='db-togle-btn-hide' onClick='hide(`{$data['Database']}`)' id='{$dbname}_btn_hide'> collapse </button>
                                    <div class='database-box' id='{$dbname}'>
                                        <i class='fa fa-database'></i>

                                            <form style='display:inline-block' action='fetching_tables.php' method='POST'>
                                            <input style='display:none;' name='f-db-tb-show-name' value='{$dbname}'>
                                                <button class='database-text-cum-btn' type='submit'>
                                                " . $data['Database'] . "</button>
                                            </form>
                                    </div>";
                                    
                                    // Start table hider div
                                    echo "<div class='table-hider' id='{$dbname}'>  <!---table hider start--->";

                                    // To show tables list. show all table boxes in each batabase box
                                    try {
                                        // estbalish connection
                                        $con = new mysqli($hostname_dt, $username_dt, $password_dt, $dbname);

                                        // query statement
                                        $sql = "SHOW TABLES;";
                                        
                                        // execute query
                                        $output = $con->query($sql);

                                        // check output has or not
                                        if($output-> num_rows > 0) {
                                            // fetch all records
                                            while($data = $output->fetch_assoc()) {
                                                // echo all table boxes
                                                $cur_tb = $data["Tables_in_{$dbname}"];
                                                echo 
                                                "<div class='table-box'>
                                                    <i class='fa fa-table'></i>
                                                        <form style='display:inline-block' action='pre_processing_records.php' method='post'>
                                                            <input style='display:none' name='f-records-dbname' value='{$dbname}'>
                                                            <input style='display:none' name='f-records-tbname' value='{$cur_tb}'>
                                                            <button type='submit' class='table-text-cum-btn'>
                                                                <p class='table-text'>" . $data["Tables_in_{$dbname}"] . 
                                                                "</p>
                                                            </button>
                                                        </form>
                                                </div>";
                                                }
                                        }
                                        else {
                                            echo 
                                            "<div class='table-box'>
                                                        <i class='fa fa-table'></i>
                                                        <p class='table-text'>" ."0 Tables Found" .
                                                        "</p>
                                                    </div>
                                                "; 
                                        }
                                    }
                                    catch(EXCEPTION $error) {
                                        $msg = $error->getMessage();
                                        echo $msg;
                                    }
                                    // close the table hider div box
                                    echo "</div> <!---table hider ends--->";
                                }
                                // close connection
                                $con->close();
                            }
                        }
                        catch(EXCEPTION $error) {
                            $errMsg = $error->getMessage();
                            echo "<script> console.log(`{$errMsg}`); </script>";
                        } 
                    }
                ?>
            </div>

        </div> <!-- Side bar secion  --->

        
        <!--- COMMON SCRIPT --->

        <!-- Top banner section  --->
        <div class="mainbox">

            <!--- table records list -->
            <div class="browse-table-main-box"><!--- table records list main box -->

                <div class="browse-table-heading-box"> <!--- table records header box-->
                    <p class="browse-table-heading-text"> Records of Table :</p>
                    <p class="browse-table-selected-text"><?php echo $_SESSION['s-records-tbname']; ?> </p>
                    <div class="browse-table-btn-container">
                        <input id="search_records_in" onkeyup="search_records()" type="search" class="browse-seach-bar" placeholder="Search Records Here...">
                        <button onclick="location.href='insert_records.php';" class="browse-btn">
                            <i class="fa fa-plus" style="" aria-hidden="true"></i>
                            Insert Records 
                        </button> 
                        <button onclick='browse_records_ajax()' class="browse-btn">
                            <i class="fa fa-refresh" style="" aria-hidden="true"></i>
                            Refresh 
                        </button> 
                        <!--- php script start. if no pri key found then not show button --->
                        <?php 
                            $key_array = $_SESSION['s-records-key-array'];
                            $PrikeyIndex = array_search('PRI', $key_array);

                            if($PrikeyIndex == "") {
                                echo "<button id='delete_all_btn' style='display:none;' class='browse-btn delete-button-hover'>
                                        <i class='fa fa-trash' aria-hidden='true'></i>
                                        Delete
                                    </button>";
                            }
                            else {
                                echo "<button id='delete_all_btn' class='browse-btn delete-button-hover'>
                                        <i class='fa fa-trash' aria-hidden='true'></i>
                                        Delete
                                    </button>"; 
                            }
                        ?>
                        <!--- php script start. if no pri key found then not show button --->
                        <?php 
                            $key_array = $_SESSION['s-records-key-array'];
                            $PrikeyIndex = array_search('PRI', $key_array);
                            
                            if($PrikeyIndex == "") {
                                echo "<button style='display:none;' id='select_all_btn' class='browse-btn'>
                                            <p style='display: inline-block;' id='select-all-text'>
                                                Select All 
                                            </p>
                                        </button>";
                            }
                            else {
                                echo "<button id='select_all_btn' class='browse-btn'>
                                            <i class='fa fa-check' aria-hidden='true'></i>
                                            <p style='display: inline-block;' id='select-all-text'>
                                                Select All 
                                            </p>
                                    </button>"; 
                            }
                        ?>
                          <!--- php script end --->
                    </div>
                </div><!--- browse table header box-->

                <!--- MAIN TABLE FETHCED -->
                <div class="table-conatiner">
                        <!--- This is tag where all dynamic data came --->
                    <table id="ajax-return-reciever" class="table-main" cellspacing="0px">

                        <!--- CLONING  --->
                            
                       
                        <!--- CLONING  --->
        
                        </tbody>
                    </table>
                </div>
            </div><!--- browse records list -->


                           


<!---  MULTI DELETE RECORD dailog box -->
<div id="del-mul-rec-wrapper" class="del-rec-wrapper"></div>
<div id="del-mul-rec-box-bk" class="del-rec-box-bk">
    <div id="del-multi-rec-dbx">
        <button id="close-del-mul-rec" class="close-del-rec"> X </button>
        <p class="del-rec-headtext"> DELETE RECORDS </p>
        <p class="del-rec-text"> 
           Are You Sure Want To Delete the Records
           <br> CAUTION :: This Process Cannot Be Undo?
        </p>
        <button id="del-mul-rec" class="del-rec-btn">
            <i class="fa fa-trash" style="margin-right: 5px;" aria-hidden="true"></i>
            Confirm Delete 
        </button>
    </div>
</div>


<!---  SINGLE DELETE RECORD dailog box -->
<div id='del-single-rec-wrapper' class="del-rec-wrapper"></div>
<div id='del-single-record-box-dbk' class="del-rec-box-bk">
    <div id="del-single-rec-dbx">
        <button id='close-single-del-rec' class="close-del-rec"> X </button>
        <p class="del-rec-headtext"> DELETE RECORD </p>
        <p class="del-rec-text"> 
           Are You Sure Want To Delete this Record
           <br> CAUTION :: This Process Cannot Be Undo?
        </p>
        <button id="del-sin-rec" class="del-rec-btn">
            <i class="fa fa-trash" style="margin-right: 5px;" aria-hidden="true"></i>
             Confirm Delete 
        </button>
    </div>
</div>

</body>

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

</html>