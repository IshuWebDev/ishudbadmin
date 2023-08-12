<!--- LAST UPDATE 10 OCT -->

<?php
// Continue session
session_start();

// Add external common script
require "common.html";

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
    <title> User Account </title>

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
            <p id="red-text"></p>
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
// FOR USER ACCOUNT CREATION
// Session is already started
// Check weather status session variable is declared or not
if(isset($_SESSION['s-created-user-status']))
{
    // check status of session variable
    if($_SESSION['s-created-user-status'] == "created-user") {

        // unset this session variale
        unset($_SESSION['s-created-user-status']);

        // Show Notice User has created
        echo  '<script> 
            var message = `SUCCESS :: User Acccount Has Been Created Successfully.`;
            green_notice(message);
                </script>';
    }
}

// FOR USER ACCOUNT CREATION
// Check weather status session variable is declared or not
if(isset($_SESSION['s-created-user-status']))
{
     // check status of session variable
    if($_SESSION['s-created-user-status'] == "not-created-user") {

         // unset this session variale
        unset($_SESSION['s-created-user-status']);

       // Show Notice of User not Created
       echo '<script>  
        var message = `CAUTION :: New User Account Could Not Be Created!`;
        red_notice(message);
        </script>';
    }
}




// FOR USER ACCOUNT DELETION
// Session is already started
// Check weather status session variable is declared or not
if(isset($_SESSION['s-del-user-status']))
{
    // check status of session variable
    if($_SESSION['s-del-user-status'] == "deleted-user") {

        // unset this session variale
        unset($_SESSION['s-del-user-status']);

        // Show Notice User has created
        echo '<script> 
            var message = `SUCCESS :: User Acccount Has Been Deleted Successfully.`;
            green_notice(message);
            </script>';
    }
}


// FOR USER ACCOUNT DELETION
// Check weather status session variable is declared or not
if(isset($_SESSION['s-del-user-status']))
{
     // check status of session variable
    if($_SESSION['s-del-user-status'] == "not-delete-user") {

         // unset this session variale
        unset($_SESSION['s-del-user-status']);

       // Show Notice of User not Created
       echo '<script> 
            var message = `CAUTION :: User Account Could Not Be Delete!`;
            red_notice(message);
        </script>';
    }
}




// FOR USERNAME EDIT 
// Check weather status session variable is declared or not
if(isset($_SESSION['s-cng-user-status']))
{
     // check status of session variable
    if($_SESSION['s-cng-user-status'] == "not-changed-user") {

         // unset this session variale
        unset($_SESSION['s-cng-user-status']);

       // Show Notice of User not Created
       echo '<script> 
       var message = `CAUTION :: Username Could Not Be Changed!`;
       red_notice(message);
        </script>';
    }
}

// FOR USERNAME EDIT
// Check weather status session variable is declared or not
if(isset($_SESSION['s-cng-user-status']))
{
    // check status of session variable
    if($_SESSION['s-cng-user-status'] == "changed-username") {

        // unset this session variale
        unset($_SESSION['s-cng-user-status']);

        // Show Notice User has created
        echo '<script> 
            var message = `SUCCESS :: Username Has Been Changed Successfully.`;
            green_notice(message);  
        </script>';
    }
}






// FOR HOSTNAME EDIT 
// Check weather status session variable is declared or not
if(isset($_SESSION['s-cng-host-status']))
{
     // check status of session variable
    if($_SESSION['s-cng-host-status'] == "not-changed-host") {

         // unset this session variale
        unset($_SESSION['s-cng-host-status']);

       // Show Notice of User not Created
       echo '<script> 
           var message = `CAUTION :: Hostname Could Not Be Changed!`;
           red_notice(message);
            </script>';
    }
}

// FOR HOSTNAME EDIT
// Check weather status session variable is declared or not
if(isset($_SESSION['s-cng-host-status']))
{
    // check status of session variable
    if($_SESSION['s-cng-host-status'] == "changed-hostname") {

        // unset this session variale
        unset($_SESSION['s-cng-host-status']);

        // Show Notice User has created
        echo '<script> 
            var message = `SUCCESS :: Hostname Has Been Changed Successfully.`;
            green_notice(message);
        </script>';
    }
}










// FOR PASSWORD EDIT 
// Check weather status session variable is declared or not
// Failure
if(isset($_SESSION['s-cng-pass-status']))
{
     // check status of session variable
    if($_SESSION['s-cng-pass-status'] == "not-changed-pass") {

         // unset this session variale
        unset($_SESSION['s-cng-pass-status']);

       // Show Notice of User not Created
       echo '<script> 
        var message = `CAUTION :: Password Could Not Be Changed!`;
        red_notice(message);
        </script>';
    }
}

// FOR PASSWORD EDIT
// Check weather status session variable is declared or not
// Success
if(isset($_SESSION['s-cng-pass-status']))
{
    // check status of session variable
    if($_SESSION['s-cng-pass-status'] == "changed-pass") {

        // unset this session variale
        unset($_SESSION['s-cng-pass-status']);

        // Show Notice User has created
        echo '<script> 
            var message = `SUCCESS :: Password Has Been Changed Successfully.`;
            green_notice(message);
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
                    echo "Disconnected";
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
                    echo "Disconnected";
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
                            
                            // Check if returned array has at least data or not
                            if($result->num_rows > 0) {
                                // Fetch data until all data not fethced
                                // variable data is a associative array
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
             
            
            <!--- User account table -->
             <div class="user-table">
                <p class="user-acc-heading"> User Account </p>
                <!--- Create new database button -->
                <button id="add-new-user-btn"> 
                    <i style="margin: 5px;" class="fa fa-user" aria-hidden="true"></i>
                    ADD NEW USER 
                </button>

                <!--- new Stuff -->

                <?php
                  if  (
                    isset($_SESSION['s-hostname']) &&
                    isset($_SESSION['s-username']) &&
                    isset($_SESSION['s-password'])
                    )
                    {
                        $username_ua = $_SESSION['s-username'];
                        $hostname_ua = $_SESSION['s-hostname'];
                        $password_ua = $_SESSION['s-password'];

                        show_users($hostname_ua, $username_ua, $password_ua);
                    }
                    // function to establish connection and show databases and tables
                    function show_users($hostname_ua, $username_ua, $password_ua) {
                        // establish connection

                        try {

                            $con = new mysqli($hostname_ua, $username_ua, $password_ua);

                            // SQL statement to get database 
                            $query = "SELECT user, host FROM mysql.user;";
                           
                            try {
                                // Run query
                                $result = $con->query($query);
                                // Fetch data 
                                if($result->num_rows > 0) {
                                    while($data = $result->fetch_assoc()) {
                                        // get current username and hostname info
                                        $username_is = $data['user'];
                                        $hostname_is = $data['host'];

                                        // get users list each name on every fetch cycle
                                        echo "
                                        <div class='user-list-bx'>
                                            <p class='user-list-username-text'>
                                            " . $data['user'] . "
                                            </p>
                                            <p class='user-list-rate-text'> @ </p>
                                            <p class='user-list-hostname-text'>
                                            " . $data['host'] . "
                                            </p>

                                            <div class='btn-container'>
                                                <button onclick='change_username(`$username_is`,`$hostname_is`)' class='user-btn'>
                                                    <i class='fa fa-pencil' aria-hidden='true'></i>
                                                    Change Username 
                                                </button>   
                                                <button onclick='change_hostname(`$username_is`,`$hostname_is`)'class='user-btn' id='user-list-hostrename-btn'>
                                                    <i class='fa fa-pencil' aria-hidden='true'></i>
                                                    Change Hostname 
                                                </button>
                                                <button onclick='change_password(`$username_is`,`$hostname_is`)' class='user-btn' id='user-list-changepass-btn'>
                                                    <i class='fa fa-pencil'  aria-hidden='true'></i>
                                                    Change Password
                                                </button>
                                                <button onClick='user_acount_delete(`{$username_is}`,`{$hostname_is}`)' class='user-btn'>
                                                    <i class='fa fa-trash' aria-hidden='true'></i>
                                                    Delete User 
                                                </button>

                                                <form style='display:inline-block;'action='processing_privileges.php' method='post'>
                                                    <input value='{$username_is}' style='display:none;' name='f-priv_cur_user'>
                                                    <input value='{$hostname_is}' style='display:none;' name='f-priv_cur_host'>
                                                    <button type='submit' class='user-btn'>
                                                        <i class='fa fa-lock' style='margin-right:3px;' aria-hidden='true'></i>
                                                        Privileges 
                                                    </button>
                                                </form>
                                            </div>  
                                        </div>"; 
                                    }
                                    // close connection
                                    $con->close();
                                }
                                else {
                                    echo 
                                    "<div class='user-list-bx'>
                                        <p class='user-list-username-text'>
                                        0 Record(s) Found.
                                        </p>
                                    </div>";
                                }
                            }
                            catch(EXCEPTION $error) {
                                $errMsg = $error->getMessage();
                                echo 
                                    "<div class='user-list-bx'>
                                        <p style='color:red;' class='user-list-username-text'>"
                                        .  $errMsg .
                                        "</p>
                                    </div>";
                            }
                        }
                        catch(EXCEPTION $error) {
                            $errMsg = $error->getMessage();
                            echo "<script> console.log(`{$errMsg}`); </script>";
                        } 
                    }
                ?>

                <!--- new stuff will be here -->
            </div>
        </div>




  <!--- start php script --->
<?php 
    if(isset($_SESSION['s-hostname'])) {
        $cuurent_host =  $_SESSION['s-hostname'];
    //  USER ACCOUNT dailog box -->

            echo "
            <div class='cnua-wrapper'></div>
            <div class='cnua-box-bk'>
                <div id='cnua-dbx'>
                    <button id='close-cnua'> X </button>
                    <p class='cnua-headtext'> ADD NEW USER ACCOUNT </p>
                    <form action='creating_new_user_account.php' method='POST' id='cnu-form'>
                        <input type='text' id='cnua-user-in' name='f-create_new_user' placeholder='Enter Username' maxlength='30'/>
                        <input type='text' id='cnua-host-in' name='f-create_new_host' placeholder='Enter Hostname' maxlength='100' value='{$cuurent_host}'/>
                        <input type='password' id='cnua-pass-in' name='f-create_new_pass' placeholder='Enter Password' maxlength='100'/>
                        <input type='password' id='cnua-repass-in' name='f-create_new_repass' placeholder='Re-enter Password' maxlength='100'/>
                        <button type='submit' id='cnua-btn-proceed' name='f-create_new-user_submit' value='submit-true'>
                            <i class='fa fa-plus' style='margin-right:3px;' aria-hidden='true'></i>
                            ADD NEW USER ACCOUNT 
                        </button>
                    </form>
                </div>
            </div>";
    }

// use form and javascript within php to store php variable in js
?>


        <!---  USER ACCOUNT/ CHANGE USERNAME dailog box -->
        <div class="cnuaname-wrapper"></div>
<div class="cnuaname-box-bk">
    <div id="cnuaname-dbx">
        <button id="close-cnuaname"> X </button>
        <p class="cnuaname-headtext"> CHANGE USERNAME </p>

        <form action="changing_username.php" method="post" id="chang_user_form_id">
            <input type="text" id="cnuaname_new_name" name="f-change_new_user_name" placeholder="Enter New Username" maxlength="100"/>
            <input style="display:none;" id="un_cnua_cur_host" name="f-un_cnua_cur_host">
            <input style="display:none;" id="un_cnua_cur_user" name="f-un_cnua_cur_user">
            <button type="submit" id="cnuaname-btn">
                <i class="fa fa-key" aria-hidden="true"></i>
                Proceed to Change Username 
            </button>
        </form>

    </div>
</div>



        <!---  USER ACCOUNT/ CHANGE HOSTNAME dailog box -->
        <div class="cnuahost-wrapper"></div>
<div class="cnuahost-box-bk">
    <div id="cnuahost-dbx">
        <button id="close-cnuahost"> X </button>
        <p class="cnuahost-headtext"> CHANGE HOSTNAME </p>

        <form action="changing_hostname.php" method="post" id="chang_host_form_id">
            <input type="text" id="cnuahost_new_hostname" name="f-change_new_hostname" placeholder="Enter New Hostname"/>
            <input style="display:none;" id="hn_cnua_cur_host" name="f-hn_cnua_cur_host">
            <input style="display:none;" id="hn_cnua_cur_user" name="f-hn_cnua_cur_user">
            <button type="submit" id="cnuahost-btn">
                <i class="fa fa-key" aria-hidden="true"></i>
                Proceed to Change Hostname 
            </button>
        </form>

    </div>
</div>



        <!--- USER ACCOUNT/ CHANGE PASSWORD dailog box -->
<div class="cnuacp-wrapper"></div>
<div class="cnuacp-box-bk">
    <div id="cnuacp-dbx">
        <button id="close-cnuacp"> X </button>
        <p class="cnuacp-headtext"> CHANGE PASSWORD </p>

        <form action="changing_password.php" method="post" id="change_pass_form_id">
            <input type="text" id="cnuacp_newpass" name="f-change_new_user_pass" placeholder="Enter New Password"/>
            <input type="text" id="cnuacp_repass" name="change_new_user_repass" placeholder="Confirm New Password"/>
            <input style="display:none;" id="pass_cnua_cur_host" name="f-ps_cnua_cur_host">
            <input style="display:none;" id="pass_cnua_cur_user" name="f-ps_cnua_cur_user">
            <button type="submit" id="cnuacp-btn">
                <i class="fa fa-key" style="margin-right:3px;" aria-hidden="true"></i>
                Proceed to Change Password 
            </button>
        </form>

    </div>
</div>


        <!---  USER ACCOUNT/ DELETE USER ACCOUNT dailog box -->
<div class="cnuadel-wrapper"></div>
<div class="cnuadel-box-bk">
    <div id="cnuadel-dbx">
        <button id="close-cnuadel"> X </button>
        <p class="cnuadel-headtext"> DELETE USER ACCOUNT</p>

        <form id="delete_user_acc_form_id" action="deletion_user_account.php" method="POST">
            <input style="display:none;" name="f-del-user-acc-username" id="username-in-id">
            <input style="display:none;" name="f-del-user-acc-hostname" id="hostname-in-id">

            <p class="cnua-del-text"> 
            WARNING :: Deletion Process Of User-Account "<text id='ua_for_del'></text>" 
            Will Erase All The Data In Belongs To The Selected User-Account 
            Permanently! <br> Are you Sure Want To Delete User-Account?
            </p>
            <button id="cnuadel-btn">
                <i class="fa fa-trash" style="margin-right: 5px;" aria-hidden="true"></i>
                Proceed Delete 
            </button>
        </form>

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