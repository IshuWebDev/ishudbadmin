<!--- LAST UPDATE 10 OCT -->

<?php
// Continue session
session_start();

// Add external common script
require "http://127.0.0.1/ishudbadmin/home/common.html";

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
        location.href='index.php';
        </script>";
        session_destroy();
    }
?>

<head>
    <!--- Title ---->
    <title> Privileges </title>

</head>
<body onload="offloader()">

<!-- loader box -->
    <div id="load-box">
        <img src="image/loader_1.svg" id="loader-1"/>
    </div>

<!--- NOTICE Box -->

<!--- Notice Box RED --->
<div id="red-notice-wrapper">
    <div id="notice-red">
        <img src="image/warning.png" class="warning-img"/>
        <div id="red-text-wrapper">
            <p id="red-text">xx</p>
        </div>
    </div>
</div>


<!--- Notice Box GREEN --->
<div id="green-notice-wrapper">
    <div id="notice-green">
        <img src="image/done.png" class="done-img"/>
        <div id="green-text-wrapper">
            <p id="green-text"></p>
        </div>  
    </div>
</div>

<!--- Always run notice function after html element to prevent defer collison --->
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
// FOR ALL PRIVLEGES GRANTED
// Session is already started
// Check weather status session variable is declared or not
if(isset($_SESSION['s-g-a-p-status']))
{
    // check status of session variable
    if($_SESSION['s-g-a-p-status'] == "done") {

        // unset this session variale
        unset($_SESSION['s-g-a-p-status']);

        // Show Notice User has created
        echo '<script> 
            var message = `SUCCESS :: All Privileges Has Been Granted Successfully.`;
            green_notice(message); 
        </script>';
    }
}

// FOR ALL PRIVILEGES GRANT
// Check weather status session variable is declared or not
if(isset($_SESSION['s-g-a-p-status']))
{
     // check status of session variable
    if($_SESSION['s-g-a-p-status'] == "failed") {

         // unset this session variale
        unset($_SESSION['s-g-a-p-status']);

       // Show Notice of User not Created
       echo '<script> 
            var message = `MYSQL SAID :: ';
       echo $_SESSION['s-g-a-p-msg'] . "`";
       echo '
           red_notice(message);
        </script>';
    }
}



// FOR PRIVLEGES GRANT
// Session is already started
// Check weather status session variable is declared or not
if(isset($_SESSION['s-g-p-status']))
{
    // check status of session variable
    if($_SESSION['s-g-p-status'] == "done") {

        // unset this session variale
        unset($_SESSION['s-g-p-status']);

        // Show Notice User has created
        echo '<script> 
                var message = `SUCCESS :: Privilege Has Been Granted Successfully.`;
                green_notice(message);
        </script>';
    }
}

// FOR PRIVILEGES GRANT
// Check weather status session variable is declared or not
if(isset($_SESSION['s-g-p-status']))
{
     // check status of session variable
    if($_SESSION['s-g-p-status'] == "failed") {

         // unset this session variale
        unset($_SESSION['s-g-p-status']);

       // Show Notice of User not Created
       echo '<script> 
            var message = `MYSQL SAID :: ';
       echo $_SESSION["s-g-p-msg"] . "`";
       echo '   
           red_notice(message);
        </script>';
    }
}







// FOR PRIVLEGES REVOKE
// Session is already started
// Check weather status session variable is declared or not
if(isset($_SESSION['s-r-a-p-status']))
{
    // check status of session variable
    if($_SESSION['s-r-a-p-status'] == "done") {

        // unset this session variale
        unset($_SESSION['s-r-a-p-status']);

        // Show Notice User has created
        echo '<script> 
            var message = `SUCCESS :: Privilege Has Been Revoked Successfully.`;
            green_notice(message);
        </script>';
    }
}

// FOR PRIVILEGES REVOKE
// Check weather status session variable is declared or not
if(isset($_SESSION['s-r-a-p-status']))
{
     // check status of session variable
    if($_SESSION['s-r-a-p-status'] == "failed") {

         // unset this session variale
        unset($_SESSION['s-r-a-p-status']);

       // Show Notice of User not Created
        echo '<script> 
            var message = `MYSQL SAID :: ';
        echo $_SESSION['s-r-a-p-msg'] . "`";
        echo '
           red_notice(message);
        </script>';
    }
}






// FOR PRIVLEGES REVOKE
// Session is already started
// Check weather status session variable is declared or not
if(isset($_SESSION['s-r-p-status']))
{
    // check status of session variable
    if($_SESSION['s-r-p-status'] == "done") {

        // unset this session variale
        unset($_SESSION['s-r-p-status']);

        // Show Notice User has created
        echo '<script> 
            var message = `SUCCESS :: Privilege Has Been Revoked Successfully.`;
            green_notice(message);
        </script>';
    }
}

// FOR PRIVILEGES REVOKE
// Check weather status session variable is declared or not
if(isset($_SESSION['s-r-p-status']))
{
     // check status of session variable
    if($_SESSION['s-r-p-status'] == "failed") {

         // unset this session variale
        unset($_SESSION['s-r-p-status']);

       // Show Notice of User not Created
        echo '<script> 
             var message = `MYSQL SAID :: ';
        echo $_SESSION["s-r-p-msg"] . "`";
        echo '
           red_notice(message);
        </script>';
    }
}




// FOR FLUSH
// Session is already started
// Check weather status session variable is declared or not
if(isset($_SESSION['flush-status']))
{
    // check status of session variable
    if($_SESSION['flush-status'] == "done") {

        // unset this session variale
        unset($_SESSION['flush-status']);

        // Show Notice User has created
        echo '<script> 
            var message = `SUCCESS :: Flush Privileges Query Successfull.`;
            green_notice(message);
        </script>';
    }
}

// FOR FLUSH
// Check weather status session variable is declared or not
if(isset($_SESSION['flush-status']))
{
     // check status of session variable
    if($_SESSION['flush-status'] == "failed") {

         // unset this session variale
        unset($_SESSION['flush-status']);

       // Show Notice of User not Created
       echo '<script> 
            var message = `CAUTION :: Flush Privileges Query Unable To Execute!`;
           red_notice(message);
        </script>';
    }
}






// FOR RESOURCE LIMIT
// Session is already started
// Check weather status session variable is declared or not
if(isset($_SESSION['res-lim-status']))
{
    // check status of session variable
    if($_SESSION['res-lim-status'] == "done") {

        // unset this session variale
        unset($_SESSION['res-lim-status']);

        // Show Notice User has created
        echo '<script> 
            var message = `SUCCESS :: Resources Limitations Has Been Updated Successfully.`;
            green_notice(message);      
        </script>';
    }
}

// FOR PRIVILEGES GRANT
// Check weather status session variable is declared or not
if(isset($_SESSION['res-lim-status']))
{
     // check status of session variable
    if($_SESSION['res-lim-status'] == "failed") {

         // unset this session variale
        unset($_SESSION['res-lim-status']);

       // Show Notice of User not Created
        echo '<script> 
            var message = `MYSQL SAID ::';  
        echo $_SESSION['res-lim-msg'] . "`";
        echo '
           red_notice(message);
        </script>';
    }
}



?>



    <!-- Top banner section  --->
    <div class='topbox'>

        <a href="home/homepage.php">
            <img src='image/logo.png' class='logimg'/>
        </a>

        <div class="server-soft-box">
            <img src="image/computer_1.png" class="ser-soft-img"/>
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
            <img src="image/dbSOft.png" class="ser-ip-soft-img"/>
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
            <img src="image/username_1.png" class="ser-user-soft-img"/>
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

        <button onclick="location.href='home/homepage.php';" class="top-btn" id="home_btn">
            <i class="fa fa-home" style="margin-right: 3px;" aria-hidden=""></i>
             Home </button>
        <button onclick="location.href='home/user_account.php';" class="top-btn" id="user_btn"> 
            <i class="fa fa-user" style="margin-right: 3px;" aria-hidden="true"></i>
            User account </button>
        <button  onclick="location.href='logout.php';" class="top-btn" id="logout_btn"> 
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

                                            <form style='display:inline-block' action='home/fetching_tables.php' method='POST'>
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
                                                        <form style='display:inline-block' action='home/pre_processing_records.php' method='post'>
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
                                                        <p class='table-text'>" ."0 Table(s) Found" .
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
             
            <!--- privilege  table -->
            <div class="priv-box">
                <div class="priv-head-box">
                    <p class="priv-heading"> Privileges of User-Account : </p>
                    <p class="priv-heading-value-username">  
                        <!--- php script start --->
                        <?php
                        if(
                            isset($_SESSION['s-priv_cur_user']) &&
                            isset($_SESSION['s-priv_cur_host'])
                            )
                            {
                                echo $_SESSION['s-priv_cur_user'];
                            }   
                        ?>
                        <!--- php script end --->
                    </p>
                    <p class="priv-heading-at">  @ </p>
                    <p class="priv-heading-value-hostname">  
                    <!--- php script start --->
                    <?php
                        if(
                            isset($_SESSION['s-priv_cur_user']) &&
                            isset($_SESSION['s-priv_cur_host'])
                            )
                            {
                                echo $_SESSION['s-priv_cur_host'];
                            }   
                        ?>
                        <!--- php script end --->
                    </p>
                </div> <!--- priv head box --->

                <!--- This box contain privilege buttons --->
                <div class="priv-btn-box">
            
                    <!--- grant privilege button -->
                    <button id="grant-priv-btn"> 
                        Grant Privileges 
                    </button>

                    <!--- revoke privilege bitton -->
                    <button id="revok-priv-btn"> 
                        Revoke Privileges
                    </button>

                    <!--- revoke privilege bitton -->
                    <button id="resource-limit-btn"> 
                        Resource Limit
                    </button>

                     <!--- flush privilege button -->
                     <button onClick="location.href='home/flush_privileges.php';" id="flush-priv-btn"> 
                        Flush Privileges
                    </button>
                </div>
                
                            
                    <!--- new Stuff --> 
                    <?php
                        if(
                            isset($_SESSION['s-priv_cur_user']) &&
                            isset($_SESSION['s-priv_cur_host'])
                        )
                        {   
                            if(
                                isset($_SESSION['s-hostname']) &&
                                isset($_SESSION['s-username']) &&
                                isset($_SESSION['s-password'])
                            )
                           {    
                                $main_username = $_SESSION['s-username'];
                                $main_hostname = $_SESSION['s-hostname'];
                                $main_password = $_SESSION['s-password'];

                                $check_username = $_SESSION['s-priv_cur_user'];
                                $check_hostname = $_SESSION['s-priv_cur_host'];

                                try {
                                    $con = new mysqli($main_hostname, $main_username, $main_password);

                                    $sql = "SHOW GRANTS FOR" . " " . "'" . $check_username . "'" . "@" . "'" . $check_hostname . "'" . " " . ';';

                                    try {
                                        $result = $con->query($sql);
                                        if($result->num_rows > 0) {
                                            
                                            while($data = $result->fetch_assoc()){
                                                $v_username = $_SESSION['s-priv_cur_user'];
                                                $v_hostname = $_SESSION['s-priv_cur_host'];
                                                
                                                $cur_index = "Grants for " . $v_username . "@" .  $v_hostname;
                                                echo 
                                                "<div class='priv_each_box'>
                                                    <p class='priv-text'>" 
                                                    . $data[$cur_index] . 
                                                    "</p>
                                                </div>";
                                            }
                                        }
                                    }
                                    catch(EXCEPTION $error) {
                                        echo $error->getMessage();
                                    } 

                                }
                                catch(EXCEPTION $error) {
                                    $errMsg = $error->getMessage();
                                    echo "<script> console.log('{$errMsg}'); </script>";
                                }
                           }
                        }
                    ?>
                    <!--- new stuff will be here -->

        </div><!--- priv main box ---->





<!---  GRANT USER_PRIVILEGES dailog box -->
<div class="priv-gran-wrapper"></div>
<div class="priv-gran-box-bk">
    <div id="priv-gran-dbx">
        <button id="close-priv-gran"> X </button>
        <p class="priv-gran-headtext"> GRANT PRIVILEGES </p>
        <form id="grant-all-priv-form-id" action="home/granting_privileges.php" method="POST">

            <div class="all-box">
                <p class="all-priv-tag"> All Privileges </p>
                <label> 
                    <input onClick="grant_all_priv('<?php echo $_SESSION['s-priv_cur_user'];?>','<?php echo $_SESSION['s-priv_cur_host'];?>')" id="all-priv-in-chkbox" class="all-box-check" type="checkbox" name="f-grant-all-priv" value="grant-all-priv-true-value">
                    <input style="display:none;" name="f-cur-username-for-grant-all-priv" id="i_cur_username_grant_all_priv">
                    <input style="display:none;" name="f-cur-hostname-for-grant-all-priv" id="i_cur_hostname_grant_all_priv">
                    <p class="all-box-text"> Grant All Privileges </p>
                </label>
            </div>

           <div class="data-box">
           <p class="data-box-tag"> Data </p>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> SELECT </p>
                        <input id="data-box-chkbx-id-1" class="data-box-check" type="checkbox" name="f-grant-priv[]" value="SELECT">
                    </label>
                </div>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> INSERT </p>
                        <input id="data-box-chkbx-id-2"class="data-box-check" type="checkbox" name="f-grant-priv[]" value="INSERT">
                    </label>
                </div>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> UPDATE </p>
                        <input id="data-box-chkbx-id-3" class="data-box-check" type="checkbox" name="f-grant-priv[]" value="UPDATE">
                    </label>
                </div>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> DELETE </p>
                        <input  id="data-box-chkbx-id-4" class="data-box-check" type="checkbox" name="f-grant-priv[]" value="DELETE">
                    </label>
                </div>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> FILE </p>
                        <input id="data-box-chkbx-id-5" class="data-box-check" type="checkbox" name="f-grant-priv[]" value="FILE">
                    </label>
                </div>
        </div>

        <div class="role-box">
           <p class="role-box-tag"> Role </p>
                <div class="role-box-each-box">
                    <label> 
                        <p class="role-box-text"> CREATE ROLE </p>
                        <input id="role-box-chkbx-id-1" class="role-box-check" type="checkbox" name="f-grant-priv[]" value="CREATE ROLE">
                    </label>
                </div>
                <div class="role-box-each-box">
                    <label> 
                        <p class="role-box-text"> DROP ROLE </p>
                        <input id="role-box-chkbx-id-2" class="role-box-check" type="checkbox" name="f-grant-priv[]" value="DROP ROLE">
                    </label>
                </div>
        </div>

        <div class="structure-box">
           <p class="structure-box-tag"> Structure </p>

               <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> CREATE </p>
                        <input id="structure-box-chkbx-id-1" class="structure-box-chkbx" type="checkbox" name="f-grant-priv[]" value="CREATE">
                    </label>
               </div>
               <div class="structure-box-each-box">
                <label> 
                    <p class="structure-box-text"> ALTER </p>
                    <input id="structure-box-chkbx-id-2" class="structure-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="ALTER">
                </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> INDEX </p>
                        <input id="structure-box-chkbx-id-3" class="structure-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="INDEX">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> DROP </p>
                        <input id="structure-box-chkbx-id-4" class="structure-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="DROP">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> CREATE TEMPORARY TABLES </p>
                        <input id="structure-box-chkbx-id-5" class="structure-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="CREATE TEMPORARY TABLES">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> SHOW VIEWS </p>
                        <input id="structure-box-chkbx-id-6"  class="structure-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="SHOW VIEW">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> CREATE ROUTINE </p>
                        <input id="structure-box-chkbx-id-7"  class="structure-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="CREATE ROUTINE">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> ALTER ROUTINE </p>
                        <input id="structure-box-chkbx-id-8" class="structure-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="ALTER ROUTINE">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> EXECUTE </p>
                        <input id="structure-box-chkbx-id-9" class="structure-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="EXECUTE">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> CREATE VIEW </p>
                        <input id="structure-box-chkbx-id-10" class="structure-box-chkbx" type="checkbox" name="f-grant-priv[]" value="CREATE VIEW">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> EVENTS </p>
                        <input id="structure-box-chkbx-id-11" class="structure-box-chkbx" type="checkbox" name="f-grant-priv[]" value="EVENT">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> TRIGGER </p>
                        <input id="structure-box-chkbx-id-12"  class="structure-box-chkbx" type="checkbox" name="f-grant-priv[]" value="TRIGGER">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> RELOAD </p>
                        <input id="structure-box-chkbx-id-13"  class="structure-box-chkbx" type="checkbox" name="f-grant-priv[]" value="RELOAD">
                    </label>
                </div>
        </div>

        <div class="admin-box">
           <p class="admin-box-tag"> Administration </p>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> GRANT </p>
                        <input id="admin-box-chkbx-id-1" class="admin-box-chkbx" type="checkbox" name="f-grant-priv[]" value="GRANT OPTION">
                    </label>
               </div>
               <div class="admin-box-each-box">
                <label> 
                    <p class="admin-box-text"> SUPER </p>
                    <input id="admin-box-chkbx-id-2" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="SUPER">
                </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> PROCESS </p>
                        <input id="admin-box-chkbx-id-3" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="PROCESS">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> RELOAD </p>
                        <input id="admin-box-chkbx-id-4" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="RELOAD">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> SHUTDOWN </p>
                        <input id="admin-box-chkbx-id-5" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="SHUTDOWN">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> SHOW DATABASES </p>
                        <input id="admin-box-chkbx-id-6" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="SHOW DATABASES">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> LOCK TABLES </p>
                        <input id="admin-box-chkbx-id-7" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="LOCK TABLES">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> REFERENCES </p>
                        <input id="admin-box-chkbx-id-8" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="REFERENCES">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> REPLICATION CLIENT </p>
                        <input id="admin-box-chkbx-id-9" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="REPLICATION CLIENT">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> REPLICATION SLAVE </p>
                        <input id="admin-box-chkbx-id-10"class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="REPLICATION SLAVE">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> CREATE USER </p>
                        <input id="admin-box-chkbx-id-11" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="CREATE USER">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> CREATE TABLE SPACE </p>
                        <input id="admin-box-chkbx-id-12" class="admin-box-chkbx" type="checkbox"  name="f-grant-priv[]" value="CREATE TABLESPACE">
                    </label>
                </div>
        </div>

            <button type="submit" id="priv-gran-btn" name="f-grant-priv-submit" value="grant-priv-submitted">
                <i class="fa fa-save" style="margin-right: 5px;" aria-hidden="true"></i>
                Grant Privileges
            </button>
        </form>

    </div>
</div>



<!---  REVOKE USER_PRIVILEGES dailog box -->
<div class="priv-revok-wrapper"></div>
<div class="priv-revok-box-bk">
    <div id="priv-revok-dbx">
        <button id="close-priv-revok"> X </button>
        <p class="priv-revok-headtext"> REVOKE PRIVILEGES </p>

        <form id="revoke-all-priv-form-id" action="home/revoking_privileges.php" method="POST">

            <div class="all-box">
                <p class="all-priv-tag"> All Privileges </p>
                <label> 
                    <input onClick="revoke_all_priv('<?php echo $_SESSION['s-priv_cur_user'];?>','<?php echo $_SESSION['s-priv_cur_host'];?>')" id="revoke-all-id-chkbx" name="f-revoke-all-priv" class="all-box-check" type="checkbox">
                    <input style="display:none;" name="f-cur-username-for-revoke-all-priv" id="i_cur_username_revoke_all_priv">
                    <input style="display:none;" name="f-cur-hostname-for-revoke-all-priv" id="i_cur_hostname_revoke_all_priv">
                    <p class="all-box-text"> Revoke All Privileges </p>
                </label>
            </div>

           <div class="data-box">
           <p class="data-box-tag"> Data </p>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> SELECT </p>
                        <input id="data-box-chkbx-rv-id-1" class="data-box-check" type="checkbox" name="f-revoke-priv[]" value="SELECT">
                    </label>
                </div>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> INSERT </p>
                        <input id="data-box-chkbx-rv-id-2" class="data-box-check" type="checkbox" name="f-revoke-priv[]" value="INSERT">
                    </label>
                </div>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> UPDATE </p>
                        <input id="data-box-chkbx-rv-id-3" class="data-box-check" type="checkbox"  name="f-revoke-priv[]" value="UPDATE">
                    </label>
                </div>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> DELETE </p>
                        <input id="data-box-chkbx-rv-id-4" class="data-box-check" type="checkbox"  name="f-revoke-priv[]" value="DELETE">
                    </label>
                </div>
                <div class="data-box-each-box">
                    <label> 
                        <p class="data-box-text"> FILE </p>
                        <input id="data-box-chkbx-rv-id-5" class="data-box-check" type="checkbox"  name="f-revoke-priv[]" value="FILE">
                    </label>
                </div>
        </div>

        <div class="role-box">
           <p class="role-box-tag"> Role </p>
                <div class="role-box-each-box">
                    <label> 
                        <p class="role-box-text"> CREATE ROLE </p>
                        <input id="role-box-chkbx-rv-id-1" class="role-box-check" type="checkbox" name="f-revoke-priv[]" value="CREATE ROLE">
                    </label>
                </div>
                <div class="role-box-each-box">
                    <label> 
                        <p class="role-box-text"> DROP ROLE </p>
                        <input id="role-box-chkbx-rv-id-2" class="role-box-check" type="checkbox" name="f-revoke-priv[]" value="DROP ROLE">
                    </label>
                </div>
        </div>

        <div class="structure-box">
           <p class="structure-box-tag"> Structure </p>

               <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> CREATE </p>
                        <input id="structure-box-chkbx-rv-id-1" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="CREATE">
                    </label>
               </div>
               <div class="structure-box-each-box">
                <label> 
                    <p class="structure-box-text"> ALTER </p>
                    <input id="structure-box-chkbx-rv-id-2" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="ALTER">
                </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> INDEX </p>
                        <input id="structure-box-chkbx-rv-id-3" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="INDEX">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> DROP </p>
                        <input id="structure-box-chkbx-rv-id-4" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="DROP">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> CREATE TEMPORARY TABLES </p>
                        <input id="structure-box-chkbx-rv-id-5" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="CREATE TEMPORARY TABLES">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> SHOW VIEWS </p>
                        <input id="structure-box-chkbx-rv-id-6" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="SHOW VIEW">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> CREATE ROUTINE </p>
                        <input id="structure-box-chkbx-rv-id-7" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="CREATE ROUTINE">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> ALTER ROUTINE </p>
                        <input id="structure-box-chkbx-rv-id-8" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="ALTER ROUTINE">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> EXECUTE </p>
                        <input id="structure-box-chkbx-rv-id-9" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="EXECUTE">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> CREATE VIEW </p>
                        <input id="structure-box-chkbx-rv-id-10" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="CREATE VIEW">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> EVENTS </p>
                        <input id="structure-box-chkbx-rv-id-11" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="EVENT">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> TRIGGER </p>
                        <input id="structure-box-chkbx-rv-id-12" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="TRIGGER">
                    </label>
                </div>
                <div class="structure-box-each-box">
                    <label> 
                        <p class="structure-box-text"> RELOAD </p>
                        <input id="structure-box-chkbx-rv-id-13" class="structure-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="RELOAD">
                    </label>
                </div>
        </div>

        <div class="admin-box">
           <p class="admin-box-tag"> Administration </p>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> GRANT </p>
                        <input id="admin-box-chkbx-rv-id-1" class="admin-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="GRANT OPTION">
                    </label>
               </div>
               <div class="admin-box-each-box">
                <label> 
                    <p class="admin-box-text"> SUPER </p>
                    <input id="admin-box-chkbx-rv-id-2" class="admin-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="SUPER">
                </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> PROCESS </p>
                        <input id="admin-box-chkbx-rv-id-3" class="admin-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="PROCESS">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> RELOAD </p>
                        <input id="admin-box-chkbx-rv-id-4" class="admin-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="RELOAD">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> SHUTDOWN </p>
                        <input id="admin-box-chkbx-rv-id-5" class="admin-box-chkbx" type="checkbox" name="f-revoke-priv[]" value="SHUTDOWN">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> SHOW DATABASES </p>
                        <input id="admin-box-chkbx-rv-id-6" class="admin-box-chkbx" type="checkbox" name="f-revoke-priv[]" value="SHOW DATABASES">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> LOCK TABLES </p>
                        <input id="admin-box-chkbx-rv-id-7" class="admin-box-chkbx" type="checkbox" name="f-revoke-priv[]" value="LOCK TABLES">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> REFERENCES </p>
                        <input id="admin-box-chkbx-rv-id-8" class="admin-box-chkbx" type="checkbox" name="f-revoke-priv[]" value="REFERENCES">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> REPLICATION CLIENT </p>
                        <input id="admin-box-chkbx-rv-id-9" class="admin-box-chkbx" type="checkbox" name="f-revoke-priv[]" value="REPLICATION CLIENT">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> REPLICATION SLAVE </p>
                        <input id="admin-box-chkbx-rv-id-10" class="admin-box-chkbx" type="checkbox" name="f-revoke-priv[]" value="REPLICATION SLAVE">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> CREATE USER </p>
                        <input id="admin-box-chkbx-rv-id-11" class="admin-box-chkbx" type="checkbox" name="f-revoke-priv[]" value="CREATE USER">
                    </label>
                </div>
                <div class="admin-box-each-box">
                    <label> 
                        <p class="admin-box-text"> CREATE TABLE SPACE </p>
                        <input id="admin-box-chkbx-rv-id-12" class="admin-box-chkbx" type="checkbox"  name="f-revoke-priv[]" value="CREATE TABLESPACE">
                    </label>
                </div>
        </div>

            <button type="submit" id="priv-revok-btn" name="f-revoke-priv-submit" value="revoke-priv-submitted">
                <i class="fa fa-save" style="margin-right: 5px;" aria-hidden="true"></i>
                Revoke Privileges
            </button>
        </form>
 
    </div>
</div>


<!---- Resource Limit Dailog Box --->



<!---  GRANT USER_PRIVILEGES dailog box -->
<div class="resource-wrapper"></div>
<div class="resource-box-bk">
    <div id="resource-dbx">
        <button id="close-resource"> X </button>
        <p class="resource-headtext"> RESOURCES LIMIT </p>

            <div class="resource-box">
                <form id="resource-form-id" action="home/resource_limit.php" method="POST">
                    <div class="resource-box-each-box">
                        <label> 
                            <p class="resource-box-text"> Maximum Queries Per Hour </p>
                            <input id="resource-in-id-1" class="resource-in" type="number" value="0"  name="f-resource-max_queries">
                        </label>
                    </div>
                    <div class="resource-box-each-box">
                        <label> 
                            <p class="resource-box-text"> Maximum Update Per Hour </p>
                            <input id="resource-in-id-2" class="resource-in" type="number" value="0" name="f-resource-max_update">
                        </label>
                    </div>
                    <div class="resource-box-each-box">
                        <label> 
                            <p class="resource-box-text"> Maximum Connection </p>
                            <input id="resource-in-id-3" class="resource-in" type="number" value="0" name="f-resource-max_con">
                        </label>
                    </div>
                    <div class="resource-box-each-box">
                        <label> 
                            <p class="resource-box-text"> Maximum User_Connection </p>
                            <input id="resource-in-id-4" class="resource-in" type="number" value="0" name="f-resource-max_user_con">
                        </label>
                    </div>
                    <button id="resource-submit-button" type="submit" name="f-resource-submit-btn"> <i class='fa fa-save' style="margin-right:5px; font-size:15px;" ></i> Update </button>
                </form>
            </div>
    </div>
</div>

</body>

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


</html>