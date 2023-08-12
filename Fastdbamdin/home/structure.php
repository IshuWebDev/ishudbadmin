<!--- LAST UPDATE 22 OCT -->

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
    <title> Structure Browse </title>
    <script defer="true" type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script defer="true" type="text/javascript" src="../script/structure.js"></script>
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

// FOR COLUMN DELETION
// Check weather database delete status session variable is declared or not
if(isset($_SESSION['s-del-col-status']))
{
     // check status of session variable
    if($_SESSION['s-del-col-status'] == "not-delete-col") {

         // unset this session variale
        unset($_SESSION['s-del-col-status']);

       // Show Notice of No-response
       echo "<script> 
       var message = 'CAUTION :: You Cannot Delete All Column in Table!';
       red_notice(message);
       </script>";
    }
}



// FOR COLUMN DELETION
// Session is already started
// Check weather database created status session variable is declared or not
if(isset($_SESSION['s-del-col-status']))
{
    // check status of session variable
    if($_SESSION['s-del-col-status'] == "deleted-col") {

        // unset this session variale
        unset($_SESSION['s-del-col-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Column Has Been Deleted Successfully.';
        green_notice(message);
        </script>";
    }
}




// FOR NOT ADD KEYS
// Check weather database delete status session variable is declared or not
if(isset($_SESSION['s-add-key-status']))
{
     // check status of session variable
    if($_SESSION['s-add-key-status'] == "not-added-key") {

         // unset this session variale
        unset($_SESSION['s-add-key-status']);

       // Show Notice of No-response
       echo "<script> 
       var message = `CAUTION :: {$_SESSION['s-add-key-msg']}!`;
       red_notice(message);
       </script>";
    }
    // unset message one executed
    unset($_SESSION['s-add-key-msg']);
}



// FOR YES ADD KEYS
// Session is already started
// Check weather database created status session variable is declared or not
if(isset($_SESSION['s-add-key-status']))
{
    // check status of session variable
    if($_SESSION['s-add-key-status'] == "added-key") {

        // unset this session variale
        unset($_SESSION['s-add-key-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Key Has Added Successfully.';
        green_notice(message);
        </script>";
    }
}



// FOR NOT DELETE KEYS
// Check weather table createe status session variable is declared or not
if(isset($_SESSION['s-rem-key-status']))
{
     // check status of session variable
    if($_SESSION['s-rem-key-status'] == "not-rem-key") {

        // unset this session variale
        unset($_SESSION['s-rem-key-status']);

       // Show Notice of No-response
       echo "<script> 
       var message = `CAUTION :: {$_SESSION['s-rem-key-msg']}!`;
       red_notice(message);
       </script>";

        // unset message one executed
        unset($_SESSION['s-rem-key-msg']);
    }
}



// FOR YES DELETE KEYS
// Session is already started
// Check weather table created status session variable is declared or not
if(isset($_SESSION['s-rem-key-status']))
{
    // check status of session variable
    if($_SESSION['s-rem-key-status'] == "rem-key") {

        // unset this session variale
        unset($_SESSION['s-rem-key-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Keys Has Been Removed Successfully.';
        green_notice(message);
        </script>";
    }
}


// FOR COLUMN NOT ADDED
// Check weather table createe status session variable is declared or not
if(isset($_SESSION['s-added-col-status']))
{
     // check status of session variable
    if($_SESSION['s-added-col-status'] == "failed-table-add") {

        // unset this session variale
        unset($_SESSION['s-added-col-status']);

       // Show Notice of No-response
       echo "<script> 
       var message = `MySQL Said :: {$_SESSION['s-added-col-msg']}!`;
       red_notice(message);
       </script>";

        // unset message one executed
        unset($_SESSION['s-added-col-msg']);
    }
}



// FOR COLUMN ADDED
// Session is already started
// Check weather table created status session variable is declared or not
if(isset($_SESSION['s-added-col-status']))
{
    // check status of session variable
    if($_SESSION['s-added-col-status'] == "added-table") {

        // unset this session variale
        unset($_SESSION['s-added-col-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Column Has Been Added Successfully.';
        green_notice(message);
        </script>";
    }
}







// FOR COLUMN CHNAGED NO
// Check weather table createe status session variable is declared or not
if(isset($_SESSION['s-change-col-status']))
{
     // check status of session variable
    if($_SESSION['s-change-col-status'] == "failed-table-change") {

        // unset this session variale
        unset($_SESSION['s-change-col-status']);

       // Show Notice of No-response
       echo "<script> 
       var message = `MySQL Said :: {$_SESSION['s-change-col-msg']}!`;
       red_notice(message);
       </script>";

        // unset message one executed
        unset($_SESSION['s-change-col-msg']);
    }
}



// FOR COLUMN CHANGED YES
// Session is already started
// Check weather table created status session variable is declared or not
if(isset($_SESSION['s-change-col-status']))
{
    // check status of session variable
    if($_SESSION['s-change-col-status'] == "change-table") {

        // unset this session variale
        unset($_SESSION['s-change-col-status']);

        // Show Notice of Logout
        echo "<script> 
        var message = 'SUCCESS :: Column Has Been Updated Successfully.';
        green_notice(message);
        </script>";
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
                            $username = $_SESSION['s-username'];
                            $hostname = $_SESSION['s-hostname'];
                            $password = $_SESSION['s-password'];
    
                            connect_status($hostname, $username, $password);
                        }
                        // function to establish connection and show databases and tables
                        function connect_status($hostname, $username, $password) {
                            // establish connection
                            try {
                                $con = new mysqli($hostname, $username, $password);
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

            <!---structure list -->
            <div class="browse-table-main-box"><!--- structure list main box -->

                <div class="structure-table-heading-box"> <!---structures header box-->
                    <p class="structure-table-heading-text"> Browse Table Structure :</p>
                    <p class="structure-table-selected-text"> <?php echo $_SESSION['s-stucture-tbname']; ?> </p>

                    <?php
                    if(isset($_SESSION['s-stucture-tbname']) &&
                       isset($_SESSION['s-stucture-dbname'])) {
                        $cur_dbname = $_SESSION['s-stucture-dbname'];
                        $cur_tbname = $_SESSION['s-stucture-tbname'];
                    }
                    echo "<button onClick='remprikey(`$cur_tbname`,`$cur_dbname`)' class='rem_pri_btn'> Primary Key Remove </button>";
                    ?>
                    
                </div>

                <!--- MAIN STRUCTURE TABLE FETHCED -->
                <div class="table-conatiner-structure">
                    <table class="table-main" cellspacing="0px">
                        <thead class="table-head">
                            <tr class="head-table-row">
                                <th class="head-table-data-structure"> Field</th>
                                <th class="head-table-data-structure"> Type </th>
                                <th class="head-table-data-structure"> Null </th>
                                <th class="head-table-data-structure"> Key </th>
                                <th class="head-table-data-structure"> Default </th>
                                <th class="head-table-data-structure"> Extra </th>
                                <th class="head-table-data-structure-action"> Action(s) </th>
                            </tr>
                        </thead>

                            <!--- CLONING  --->
                            <!--- php script will show data --->
                            <?php 
                                $hostname_desc = $_SESSION['s-hostname'];
                                $username_desc = $_SESSION['s-username'];
                                $password_desc = $_SESSION['s-password'];

                                $dbname = $_SESSION['s-stucture-dbname'];
                                $tbname = $_SESSION['s-stucture-tbname'];

                                try {
                                    $con = new mysqli($hostname_desc, $username_desc, $password_desc);

                                    $sql = "DESC" . " " .  $dbname . "." . $tbname . " " . ";";

                                    try {
                                        $result= $con->query($sql);
                                        if($result-> num_rows > 0 ) {
                                            while($data = $result->fetch_assoc()) {
                                                $cur_col_name = $data['Field'];
                                                echo "<tbody>
                                                <tr class='table-rows-structure'>
                                                    <td class='table-data-structure'>" . $data['Field'] . "</td>
                                                    <td class='table-data-structure'>" . $data['Type'] . "</td>
                                                    <td class='table-data-structure'>" . $data['Null'] . "</td>
                                                    <td class='table-data-structure'>" . $data['Key'] . "</td>
                                                    <td class='table-data-structure'>" . $data['Default'] . "</td>
                                                    <td class='table-data-structure'>" . $data['Extra'] . "</td>
                                                    <td class='table-data-structure' style='min-width: 290px;'>

                                                        <form style='display:inline-block;' action='processing_add_col.php' method='POST'>
                                                            <input style='display:none' value='$tbname' name='f-add-col-tbname'/>
                                                            <input style='display:none' value='$dbname' name='f-add-col-dbname'/>
                                                            <input style='display:none' value='$cur_col_name' name='f-col-add-after'/>
                                                            <button type='submit' class='add_structure_btn'> Add </button>
                                                        </form>
                                                        <form style='display:inline-block;' action='processing_change_column.php' method='POST'>
                                                            <input style='display:none' value='$tbname' name='f-change-col-tbname'/>
                                                            <input style='display:none' value='$dbname' name='f-change-col-dbname'/>
                                                            <input style='display:none' value='$cur_col_name' name='f-change-cur_col'/>
                                                            <button type='submit' class='edit_structure_btn'> Change </button>
                                                        </form>
                                                        <button onClick='delete_col(`$tbname`,`$dbname`,`$cur_col_name`)' class='delete_structure_btn'> Delete </button>
                                                        <button onClick='addkey(`$tbname`,`$dbname`,`$cur_col_name`)' class='addkeys_structure_btn'> Key </button>
                                                    </td>
                                                </tr>";
                                            }
                                        }
                                        else {
                                            echo "<tbody>
                                            <tr class='table-rows'>
                                                <td class='table-data'> No Description Available. </td>
                                            </tr>";
                                        }
                                    }
                                    catch(EXCEPTION $error) {
                                        echo $erro->getMessage();
                                    }
                                }
                                catch(EXCEPTION $error) {
                                    echo $erro->getMessage();
                                }
                            ?>
                        <!--- php script will show data --->
                        <!--- CLONING  --->
        
                        </tbody>
                    </table>
                </div>
            </div><!--- browse table structure -->




<!---  DELETE COLUMN dailog box -->
<div class="del-col-wrapper"></div>
<div class="del-col-box-bk">
    <div id="del-col-dbx">
        <button id="close-del-col"> X </button>
        <p class="del-col-headtext"> DELETE COLUMN </p>
        <p class="del-col-text"> 
           Are You Sure Want To Delete the Column.
           <text id='selected-table-del-col'></text>
           <br> CAUTION :: This Process Cannot Be Undo?
        </p>
        <form id="delete_column_form_id" style='display:inline-block;' action='deleting_column.php' method='post'>
        <input style='display:none;' name='f-del-col-tbname' id='del-col-tbname-in'/>
        <input style='display:none;'name='f-del-col-dbname' id='del-col-dbname-in'/>
        <input style='display:none;'name='f-del-col-field' id='del-col-field-in'/>
        <button id="del-col-btn">
            <i class="fa fa-trash" style="margin-right: 5px;" aria-hidden="true"></i>
             Confirm Delete </button>
        </form>
    </div>
</div>


<!---  ADD KEYS dailog box -->
<div class="add-key-wrapper"></div>
<div class="add-key-box-bk">
    <div id="add-key-dbx">
        <button id="close-add-key"> X </button>
        <p class="add-key-headtext"> ADD KEY </p>
        <p class="add-key-text"> 
          Please Select A Key You Want To Add On The Selected Column.
          <text id='selected-table-add-key'></text>
        </p>
        <form id="add_key_col_form_id" style='display:inline-block;' action='adding_keys.php' method='post'>
        <input style='display:none;' name='f-add-key-tbname' id='add-key-tbname-in'/>
        <input style='display:none;'name='f-add-key-dbname' id='add-key-dbname-in'/>
        <input style='display:none;'name='f-add-key-field' id='add-key-field-in'/>
        <select id='add-key-select' name='f-add-key-type'>
            <option value='PRIMARY KEY'> PRIMARY KEY </option>
            <option value='UNIQUE'> UNIQUE KEY </option>
            <option value='INDEX'> INDEX </option>
            <option value='SPATIAL'> SPATIAL </option>
            <option value='FULLTEXT'> FULLTEXT </option>
        </select>
        <button id="add-key-btn">
            <i class="fa fa-key" style="margin-right: 5px;" aria-hidden="true"></i>
             Add Key </button>
        </form>
    </div>
</div>



<!---  REMOVE KEYS dailog box -->
<div class="rem-key-wrapper"></div>
<div class="rem-key-box-bk">
    <div id="rem-key-dbx">
        <button id="close-rem-key"> X </button>
        <p class="rem-key-headtext"> REMOVE PRIMARY KEY </p>
        <p class="rem-key-text"> 
          Are You Sure To Want To Remove Primary Key From The Selected Table ?
          <text id='selected-table-rem-key'></text>
        </p>
        <form id="rem_pri_key_form_id" style='display:inline-block;' action='removing_keys.php' method='post'>
            <input style='display:none;' name='f-rem-key-tbname' id='rem-key-tbname-in'/>
            <input style='display:none;'name='f-rem-key-dbname' id='rem-key-dbname-in'/>
        <button id="rem-key-btn">
            <i class="fa fa-key" style="margin-right: 5px;" aria-hidden="true"></i>
            Proceed to Remove Primary Key </button>
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