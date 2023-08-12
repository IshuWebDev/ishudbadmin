<!--- LAST UPDATE 05 OCT -->

<?php
// Continue session
session_start();

// Add external common script
require "common.html";

// unset the SESSION variable of SHOW TABLES. Every time user revisit homepage then
if(isset($_SESSION['s-show-tb-db-name'])) {
    unset($_SESSION['s-show-tb-db-name']);
}

// These SESSION var should available everywhere but if user clear cache the these will swipe out and session will be destroyed
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
    <title> Homepage </title>

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

// FOR DATABASE DELETIOn
// Session is already started
// Check weather database delete status session variable is declared or not
if(isset($_SESSION['s-del-db-status']))
{
    // check status of session variable
    if($_SESSION['s-del-db-status'] == "deleted-db") {

        // unset this session variale
        unset($_SESSION['s-del-db-status']);

        // Show Notice of Logout
        echo '<script> 
        var message = `SUCCESS :: Database Has Been Deleted.`;
        green_notice(message);
        </script>';
    }
}


// FOR DATABASE DELETION
// Check weather database delete status session variable is declared or not
if(isset($_SESSION['s-del-db-status']))
{
     // check status of session variable
    if($_SESSION['s-del-db-status'] == "not-delete-db") {

         // unset this session variale
        unset($_SESSION['s-del-db-status']);

       // Show Notice of No-response
       echo '<script> 
       var message = `CAUTION :: Unable To Delete Database!`;
       red_notice(message);
       </script>';
    }
}



// FOR DATABASE CREATION
// Session is already started
// Check weather database created status session variable is declared or not
if(isset($_SESSION['s-created-database-status']))
{
    // check status of session variable
    if($_SESSION['s-created-database-status'] == "created-db") {

        // unset this session variale
        unset($_SESSION['s-created-database-status']);

        // Show Notice of Logout
        echo '<script> 
        var message = `SUCCESS :: Database Has Been Created.`;
        green_notice(message);
        </script>';
    }
}

// FOR DATABASE CREATION
// Check weather database created status session variable is declared or not
if(isset($_SESSION['s-created-database-status']))
{
     // check status of session variable
    if($_SESSION['s-created-database-status'] == "not-created-db") {

         // unset this session variale
        unset($_SESSION['s-created-database-status']);

       // Show Notice of No-response
       echo '<script> 
       var message = `CAUTION :: Already Available Database Cannot Be Created Again!`;
       red_notice(message);
       </script>';
    }
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

            <!--- Database table -->
            <div class="database-table">
                <button id="createdb-btn">
                    <i class="fa fa-database cndb" id="fa-db-cndb-btn" aria-hidden="true"></i>
                     CREATE NEW DATABASE </button>

                <!--- new stuff will be here -->  

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

                            // this function will show databases
                            show_dbs($hostname_dt, $username_dt, $password_dt);
                        }

                // function to establish connection and show databases
                function show_dbs($username_dt, $hostname_dt, $password_dt) {
                        // establish connection
                        try {
                            // establish connection
                            $con = new mysqli($username_dt, $hostname_dt, $password_dt);

                            // SQL statement to get database 
                            $query = "SHOW DATABASES;";

                            // Run query
                            $result = $con->query($query);

                            // Fetch data
                            if($result->num_rows > 0) {
                                while($data = $result->fetch_assoc()) {
                                
                                    $dbname = $data['Database'];

                                // print all boxes
                                echo  
                                "<div class='db-list-bx'>
                                <p class='db-list-txt'>" . $data['Database'] . "</p>

                                        <!--- Rename function is not available in mysql 
                                        <button class='db-btn' id='db-list-edit-btn'>
                                            <i class='fa fa-pencil'></i>
                                            Rename </button>
                                        --->
                                        <!--- this box contain both buttons --->
                                    <div class='db-list-btn-container'>  
                                        <form style='display:inline-block' action='fetching_tables.php' method='POST'>
                                            <input style='display:none;' name='f-db-tb-show-name' value='{$dbname}'>
                                            <button class='db-list-open-btn' type='submit'>
                                                <i class='fa fa-sign-in' aria-hidden='true'></i>
                                                Browse 
                                            </button>
                                        </form>
                                        <button class='db-list-delete-btn' onClick='delete_database(`{$dbname}`)'>
                                            <i class='fa fa-trash'></i>
                                            Delete 
                                        </button>
                                    </div> <!---END : this box contain both buttons --->
                                </div> <!---END : db list box --->";
                                }
                            }
                            // close connection
                            $con->close();
                        }
                        catch(EXCEPTION $error) {
                            $errMsg = $error->getMessage();
                            echo "<script> console.log(`{$errMsg}`); </script>";
                        } 
                    }
                ?>
                <!--- new stuff will be here -->
            </div>

            <!--- Soft Info table -->
            <div class="soft-info">
                <p class="soft-text-heading"> General Information </p>
                <table class="soft-tab">
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> Database Type </td>
                        <td class="soft-info-tde">
                           <!--- start php script --->
                            <?php 
                            if(isset($_SESSION['s-server-type'])) {
                                if ($_SESSION['s-server-type'] == "mysql") {
                                    echo "MySQL Server Community GPL";
                                    }
                                else if($_SESSION['s-server-type'] == "mariadb") {
                                    echo "Mariab Server";
                                }
                            }
                            else {
                                echo "";
                            }
                            ?>
                            <!--- end php script --->
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> Database Address </td>
                        <td class="soft-info-tde">  
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
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> Server Version </td>
                        <td class="soft-info-tde"> 
                             <!--- start php script --->
                             <?php 
                            if(isset($_SESSION['s-server-type'])) {
                                // Make connection to get server version info
                                $hostname_s = $_SESSION['s-hostname'];
                                $username_s = $_SESSION['s-username'];
                                $password_s = $_SESSION['s-password'];

                                try {
                                    // establish connection
                                    $con = new mysqli($hostname_s, $username_s, $password_s);
                                    //Query
                                    $query = "SELECT @@VERSION;";
                                    // Execute query
                                    $result = $con->query($query);
                                    // Get data output
                                    if($result->num_rows > 0){
                                        // Fetch data as array
                                        $data = $result->fetch_assoc();
                                        // display data/array using '@@VERSION' as index
                                        echo $data['@@VERSION'];
                                    }
                                    else {
                                        echo 'No data found!';
                                    }
                                }
                                catch(EXCEPTION $error) {
                                    $errmsg = $error->getMessage();
                                    echo "<script> console.log('{$errmsg}'); </script>";
                                }
                            }
                            else {
                                echo "";
                            }
                            ?>
                            <!--- end php script --->
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> Protocol Version </td>
                        <td class="soft-info-tde"> 
                        <!--- php script start --->
                        <?php
                        echo $_SERVER['SERVER_PROTOCOL'];
                        ?>
                        <!-- end php script --->
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> User </td>
                        <td class="soft-info-tde">
                              <!--- php script start --->
                        <?php
                        if(
                            isset($_SESSION['s-username']) && 
                            isset($_SESSION['s-hostname'])
                          ) 
                          {
                            echo $_SESSION['s-username'] . "@" . $_SESSION['s-hostname'];
                          }
                        else {
                            echo "";
                        }
                        ?>
                        <!-- end php script --->
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> Web server </td>
                        <td class="soft-info-tde">
                        <!--- php script start --->
                        <?php
                            echo $_SERVER['SERVER_SOFTWARE'];
                        ?>
                        <!-- end php script --->
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> Database Driver </td>
                        <td class="soft-info-tde">  
                        <!--- php script start --->
                        <?php
                            // store array in variable
                            $array = get_loaded_extensions();
                            echo $array['15'];
                        ?>
                        <!-- end php script --->
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> Gateway Interface </td>
                        <td class="soft-info-tde">
                        <!--- php script start --->
                        <?php
                            echo $_SERVER['GATEWAY_INTERFACE'];
                        ?>
                        <!-- end php script --->
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> PHP Extension </td>
                        <td class="soft-info-tde"> 
                            <!--- php script start --->
                        <?php
                            // store array in variable
                            $array = get_loaded_extensions();
                            echo $array['28'];
                        ?>
                        <!-- end php script --->
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> PHP Version </td>
                        <td class="soft-info-tde">
                            <!--- php script start --->
                        <?php
                            // store array in variable
                            echo phpversion();
                        ?>
                        <!-- end php script --->
                        </td>
                    </tr>
                    <tr class="soft-info-tre">
                        <td class="soft-info-tde-head"> IshuDBUI version </td>
                        <td class="soft-info-tde"> 1.0.1 </td>
                    </tr>
                </table>
                <p class="soft-info-f-text"> 
                    Designed & Developed by Ishu Gupta &copy 2022 </br>
                    Powered by Core PHP 8.1.0. </br>
                    Download This OpenSource Project from <a href="https://www.github.com/ishuweb/ishudbadmin" target="blank"> Github </a> </br>
                    Please Download Latest Version. Deploy on either Localhost or Liveserver via move folder to Root Directory </br>
                    Access by domain/ishudbadmin OR localhost/ishudbadmin </p>
            </div>
        </div>
    </div>
</div>

<!--- create new database dailog box -->
<div class="cndb-wrapper"></div>
<div class="cndb-box-bk">
    <div id="cndb-dbx">
        <button id="close-cndb"> X </button>
        <p class="cndb-headtext"> Create New Database </p>
        <form id="cndb_form_id" action="creating_database.php" method="POST">
        <input type="text" id="cndb-txt-in" name="cdb-f-name" placeholder="Enter new database name" maxlength="60"/>
        <button type="submit" id="cndb-btn">
            <i class="fa fa-plus" aria-hidden="true"></i>
             CREATE NEW DATABASE </button>
        </form>
    </div>
</div>
   


<!---  DATABASE DELETE dailog box -->
<div class="db-del-wrapper"></div>
<div class="db-del-box-bk">
    <div id="db-del-dbx">
        <button id="close-db-del"> X </button>
        <p class="db-del-headtext"> DELETE DATABASE</p>
        <p class="db-del-text"> 
            WARNING :: Deletion Process Of Database "<text id='dbname_for_del'></text>" 
            Will Erase All Tables and Allied Data In The Selected Database 
            Permanently! <br> Are you Sure Want To Delete Database?
        </p>

        <form id="del-f" action="deleting_database.php" method="POST">
            <input style="display:none" id="del-input-id" name="f-del-db-value">
            <button id="db-del-btn">
            <i class="fa fa-trash" style="margin-right: 5px;" aria-hidden="true"></i>
             Proceed to Delete 
            </button>
        </form>    
    </div>
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