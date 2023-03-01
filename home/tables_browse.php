<!--- LAST UPDATE 19 OCT -->

<?php
// Continue session
session_start();

// Add external common script
require "http://127.0.0.1/ishudbadmin/home/common.html";


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
        location.href='index.php';
        </script>";
        session_destroy();
    }
?>

<head>
    <!--- Title ---->
    <title> Tables Browse </title>

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
// FOR TABLE CREATION
// Check weather table createe status session variable is declared or not
if(isset($_SESSION['s-create-table-status']))
{
     // check status of session variable
    if($_SESSION['s-create-table-status'] == "failed-table-create") {

        // unset this session variale
        unset($_SESSION['s-create-table-status']);

       // Show Notice of No-response
       echo "<script> 
       var message = `{$_SESSION['s-create-table-msg']}`;
       red_notice(message);
       </script>";
    }
}



// FOR TABLE CREATION
// Session is already started
// Check weather table created status session variable is declared or not
if(isset($_SESSION['s-create-table-status']))
{
    // check status of session variable
    if($_SESSION['s-create-table-status'] == "created-table") {

        // unset this session variale
        unset($_SESSION['s-create-table-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Table Has Been Created Successfully.';
        green_notice(message);
        </script>";
    }
}



// FOR TABLE DELETE
// Check weather table createe status session variable is declared or not
if(isset($_SESSION['s-table-delete-status']))
{
     // check status of session variable
    if($_SESSION['s-table-delete-status'] == "not-deleted-table") {


        // unset this session variale
        unset($_SESSION['s-table-delete-status']);

       // Show Notice of No-response
       echo "<script> 
       var message = `CAUTION :: Unable To Delete Table!`;
       red_notice(message);
       </script>";
    }
}



// FOR TABLE DELETE
// Session is already started
// Check weather table created status session variable is declared or not
if(isset($_SESSION['s-table-delete-status']))
{
    // check status of session variable
    if($_SESSION['s-table-delete-status'] == "deleted-table") {

        // unset this session variale
        unset($_SESSION['s-table-delete-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Table Has Been Deleted Successfully.';
        green_notice(message);
        </script>";
    }
}




// FOR TABLE RENAME
// Check weather table createe status session variable is declared or not
if(isset($_SESSION['s-change-tbname-status']))
{
     // check status of session variable
    if($_SESSION['s-change-tbname-status'] == "not-changed") {

        // unset this session variale
        unset($_SESSION['s-change-tbname-status']);

       // Show Notice of No-response
       echo "<script> 
       var message = `{$_SESSION['s-change-tbname-message']}`;
       red_notice(message);
       </script>";
    }
}



// FOR TABLE RENAME
// Session is already started
// Check weather table created status session variable is declared or not
if(isset($_SESSION['s-change-tbname-status']))
{
    // check status of session variable
    if($_SESSION['s-change-tbname-status'] == "changed") {

        // unset this session variale
        unset($_SESSION['s-change-tbname-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Table Has Been Renamed Successfully.';
        green_notice(message);
        </script>";
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

            <!--- table list -->
            <div class="database-table-list-main-box"><!---table list -->
                <div class="db-table-list-top-box">
                    <p class="db-table-heading-txt"> Database selected : </p> <!--- table list heading-->
                    <p class="db-table-list-selected-db"> 
                        <!--- php script started --->
                        <?php 
                         if(isset($_SESSION['s-show-tb-db-name'])) {
                            // show this value as selected database
                           echo $_SESSION['s-show-tb-db-name'];
                         }
                        ?>
                        <!--- php script ends --->
                     </p>
                        <button onclick="location.href='home/table_create.php'" id="create-new-table-btn">
                            <i class="fa fa-plus" style="margin-right: 5px;" aria-hidden="true"></i>
                            Create New Table 
                        </button>
                </div>
                    <div class="db-table-list-heading-bar"> <!--- table list heading container box -->
                        <p class="db-table-list-table-heading"> Tables </p> 
                        <p class="db-table-list-action-heading"> Actions </p>
                    </div>

                    <!--- FETCH CODE -->
                <?php 
                    // Check weather Form has sent name of new database or not
                    if(isset($_SESSION['s-show-tb-db-name'])) {

                        // Store session variable in a local variable
                        $db_name = $_SESSION['s-show-tb-db-name'];

                        // check is connectors session variable are available or not
                        if (
                            isset($_SESSION['s-username']) &&
                            isset($_SESSION['s-hostname']) &&
                            isset($_SESSION['s-password'])
                        )
                        {
                            // store values in local variable
                            $username_stb = validate($_SESSION['s-username']);
                            $hostname_stb = validate($_SESSION['s-hostname']);
                            $password_stb = validate($_SESSION['s-password']); 
                        
                            // function to establish connection and create the database
                            show_tables($hostname_stb, $username_stb, $password_stb, $db_name);
                        }
                    }
                    else {
                        // if form hasnt sent the name but page visit directly so redirect to loginpage
                        echo "<script>  
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
                    function show_tables($hostname_stb, $username_stb, $password_stb, $db_name) {
                        try {
                            // establish connection
                            $con = new mysqli($hostname_stb, $username_stb, $password_stb, $db_name);

                            // query
                            $sql = "SHOW TABLES;";

                            // run query within try to catch error
                            try {
                                // execute query
                                $result = $con->query($sql);
                                if($result->num_rows > 0) {
                                    while($data = $result->fetch_assoc()) {
                                        $curr_table = $data["Tables_in_{$db_name}"];

                                        echo "
                                        <div class='db-table-list-box'>
                           
                                        <p class='db-table-list-name-value'>" . $data["Tables_in_{$db_name}"] . "</p>

                                        <div class='db-table-action-box'> <!--- each table action container box -->

                                            <form style='display:inline-block' action='home/pre_processing_records.php' method='post'>
                                                <input style='display:none' name='f-records-dbname' value='{$db_name}'>
                                                <input style='display:none' name='f-records-tbname' value='{$curr_table}'>
                                                <button class='db-table-list-dbtn' id='db-table-list-browser-btn'>
                                                    <i class='fa fa-sign-in' aria-hidden='true' style='margin-right:5px;'></i>
                                                    Browse
                                                </button>
                                            </form>

                                            <button onclick='rename_table(`{$curr_table}`,`{$db_name}`)' class='db-table-list-dbtn' id='db-table-list-rename-btn'>
                                                <i class='fa fa-pencil' aria-hidden='true' style='margin-right:5px;'></i>
                                                Rename 
                                            </button>
                                            
                                            <button onclick='delete_table(`{$curr_table}`,`{$db_name}`)' class='db-table-list-dbtn' id='db-table-list-delete-btn'>
                                                <i class='fa fa-trash' aria-hidden='true' style='margin-right:5px;'></i>
                                                Delete 
                                            </button>

                                            <form style='display:inline-block' action='home/processing_structure.php' method='post'>
                                                <input style='display:none' name='f-stucture-dbname' value='{$db_name}'>
                                                <input style='display:none' name='f-stucture-tbname' value='{$curr_table}'>
                                                <button type='submit' class='db-table-list-dbtn' id='db-table-list-edit-btn'>
                                                    <i class='fa fa-pencil'  aria-hidden='true' style='margin-right:2px;''></i>
                                                    Structure
                                                </button>
                                            </form>

                                            <button onclick='export_table(`{$curr_table}`,`{$db_name}`)' class='db-table-list-dbtn' id='db-table-list-export-btn'>
                                                <i class='fa fa-exchange' aria-hidden='true' style='margin-right:5px;'></i>
                                                Export
                                            </button>
                                        </div> 
                                     </div>";
                                    }
                                }
                                else {
                                    echo " <div class='db-table-list-box'>
                           
                                    <p class='db-table-list-name-value'> No Tables Found </p>

                                    </div> 
                                 </div>";
                                }
                                // unset value of get new database name
                                unset($_SESSION['show-tb-db-name']);
                            }
                            catch(EXCEPTION $erro) {
                                // unset value of get new database name
                                unset($_SESSION['show-tb-db-name']);
                            }
                            // close the connection
                            $con->close();
                        }
                        catch(EXCEPTION $err) {
                            $errMsg = $err->getMessage();
                            echo "<script> console.log('{$errMsg}'); </scritp>";
                        }
                    }
                ?>
                
                <!--- new stuff will be here -->
            </div><!--- Database table list -->


        <!---  DELETE A TABLE dailog box -->
<div class="del-tab-wrapper"></div>
<div class="del-tab-box-bk">
    <div id="del-tab-dbx">
        <button id="close-del-tab"> X </button>
        <p class="del-tab-headtext"> DELETE TABLE </p>
        <p class="del-tab-text"> 
           Are You Sure Want To Delete the Selected Table '
           <text id='del-tab-selected-text'></text>'. 
           <br> REMEBER :: This Process Cannot Be Undo?
        </p>
        <form style='display:inline-block;' action='home/deleting_table.php' method='post' id='del-table-fid'>
        <input style='display:none;' name='f-del-table-name' id='del-tab-name-in'/>
        <input style='display:none;'name='f-del-dbname-name' id='del-tab-dbname-in'/>
        <button id="del-tab-btn">
            <i class="fa fa-trash" style="margin-right: 5px;" aria-hidden="true"></i>
             Confirm Delete </button>
        </form>
    </div>
</div>



<!---  CHANGE TABLE NAME dailog box  --->
<div class="renametb-wrapper"></div>
<div class="renametb-box-bk">
    <div id="renametb-dbx">
        <button id="close-renametb"> X </button>
        <p class="renametb-headtext"> CHANGE TABLE NAME </p>

        <form action="home/changing_tablename.php" method="post" id="renametb_form_id">
            <input type="text" id="renametb_newame" name="f-change_new_tbname" placeholder="Enter New Table Name"/>
            <input style="display:none;" id="renametb_cur_tbname" name="f-rename_tb_cur_tbname">
            <input style="display:none;" id="renametb_cur_dbname" name="f-rename_tb_cur_dbname">
            <button type="submit" id="renametb-btn">
                <i class="fa fa-pencil" aria-hidden="true"></i>
                Proceed to Change Table Name 
            </button>
        </form>
    </div>
</div>


<!--- EXPORT TABLE dailog box -->
<div class="export-tab-wrapper"></div>
<div class="export-tab-box-bk">
    <div id="export-tab-dbx">
        <button id="close-export-table"> X </button>
        <p class="export-table-headtext"> EXPORT TABLE </p>
        <p class="export-tab-selected-tab-name-head"> Selected Table </p>
        <p class="export-tab-selected-tab-name-value" id="export-table-selected"></p>
        <p class="export-tab-selecter-tab-name-head"> File Format Type </p>
        <p class="export-tab-selected-tab-type-value" id="export-table-selected"> Microsoft Excel [.CSV] </p>
        <form style="display:inline-block" action="home/exporting.php" method="POST">
            <input style="display:none;" name="f-export-cur-dbname" id="export-cur-db-name"/>
            <input style="display:none;" name="f-export-cur-tbname" id="export-cur-tb-name"/>
            <button id="export-tab-btn">
                <i class="fa fa-download" style="margin-right: 5px;" aria-hidden="true"></i>
                Export and Download 
            </button>
        </form>
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