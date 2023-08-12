<!--- LAST UPDATE 06 OCT -->
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
    <title> Tables Browse </title>

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
        <img src="../warning.png" class="warning-img"/>
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
                                                        <p class='table-text'>" ."No Tables Found" .
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
                
       

        <!-- Top banner section  --->
        <div class="mainbox">
        
            <form action="adding_Column.php" method="post" id="adding_table_form_id">
                <!--- add column in table main box. -->
                <div class="add-col-main-container">
                    
                    <div class="add-col-in-table-heading-box">
                        <p class="add-col-in-table-heading-text"> Add Column in the Table : </p> <!--- table list heading-->
                        <p class="add-col-in-table-selected-tb"> 
                            <!--- php script started --->
                            <?php 
                            if(isset($_SESSION['f-add-col-tbname'])) {
                                // show this value as selected database
                            echo $_SESSION['f-add-col-tbname'];
                            }
                            ?>
                            <!--- php script ends --->
                        </p>


                        <!--- input #9 for current table name --->
                        <input name="f-add-col-cur-tb-name" style="display:none;" 
                        value='<?php 
                                if(isset($_SESSION['f-add-col-tbname'])) {
                                    // show this value as selected database
                                echo $_SESSION['f-add-col-tbname'];
                                }
                            ?>'/>
                        <!--- input #10 for current database name --->
                        <input name="f-add-col-cur-db-name" style="display:none;" 
                        value='<?php 
                                if(isset($_SESSION['f-add-col-dbname'])) {
                                    // show this value as selected database
                                echo $_SESSION['f-add-col-dbname'];
                                }
                            ?>'/>
                         <!--- input #11 for previous column name --->
                        <input name="f-add-col-cur-next-name" style="display:none;" 
                        value='<?php 
                                if(isset($_SESSION['f-col-add-after'])) {
                                    // show this value as selected database
                                echo $_SESSION['f-col-add-after'];
                                }
                            ?>'/>

                        <button type="reset" class="add-col-in-table-cancel">
                            <i class="fa fa-times" style="margin-right: 5px;" aria-hidden="true"></i>
                                Reset
                        </button>
                        <button name="f-add-col-in-table-submit-btn" type="submit" class="add-col-in-table-save" id="add-col-in-table-input-submit">
                            <i class="fa fa-save" style="margin-right: 5px;" aria-hidden="true"></i>
                                Add Column
                        </button>
                    </div>
                    
                    <!--- new table each colom box -->
                    <div class="add-col-in-table-col-box" id="add-col-in-table-col-box-id"> 
                        <!--- input #1 for column name --->
                        <input id="add-col-in-table-input-colom-name-in" name="f-add-col-in-table-input-colom-name" type="text" class="add-col-in-table-col-name" placeholder="Enter New Colomn Name"/>
                        <!--- input #2 fordata type --->
                        <select id="add-col-in-table-input-data-type-in" name="f-add-col-in-table-input-data-type" class="add-col-in-table-col-type">
                            <option value="none-datatype"> --- DATA TYPE --- </option>
                            <option value="INT"> INT </option>
                            <option value="BIGINT"> BIGINT </option>
                            <option value="DECIMAL"> DECIMAL </option>
                            <option value="FLOAT"> FLOAT </option>
                            <option value="DOUBLE"> DOUBLE </option>
                            <option value="VARCHAR"> VARCHAR </option>
                            <option value="TEXT"> TEXT </option>
                            <option value="DATE"> DATE </option>
                            <option value="TIME"> TIME </option>
                            <option value="DATETIME"> DATETIME</option>
                            <option value="TIMESTAMP"> TIMESTAMP </option>
                            <option value="JSON"> JSON </option>
                        </select>
                        <!--- input #3 for column length --->
                        <input id="add-col-in-table-input-length-in" name="f-add-col-in-table-input-length" type="number" class="add-col-in-table-length" placeholder="Value/Lenght"/>
                         <!--- input #12 for column attribute --->
                        <select name="f-add-col-in-table-input-attribute" class="add-col-in-table-col-attr">
                            <option value="none-attribute"> --- ATTRIBUTE --- </option>
                            <option value="BINARY"> BINARY </option>
                            <option value="UNSIGNED"> UNSIGNED </option>
                            <option value="UNSIGNED ZEROFILL"> UNSIGNED ZEROFILL </option>
                            <option value="ON UPDATE CURRENT_TIMESTAMP"> ON UPDATE CURRENT_TIMESTAMP </option>
                        </select>
                        <!--- input #4 for column comment --->
                        <textarea name="f-add-col-in-table-input-colum-comment" type="text" class="add-col-in-table-comment" placeholder="Column Comment here..."></textarea>
                        <!--- input #5 for column index --->
                        <select name="f-add-col-in-table-input-index" class="add-col-in-table-col-index">
                            <option value="none-index"> --- INDEX --- </option>
                            <option value="PRIMARY KEY"> PRIMARY </option>
                            <option value="UNIQUE"> UNIQUE</option>
                            <option value="INDEX"> INDEX </option>
                            <option value="FULLTEXT "> FULLTEXT </option>
                            <option value="SPATIAL"> SPATIAL </option>
                        </select>
                        <!--- input #6 for default --->
                        <div id="add-col-in-table-col-default-container-id" class="add-col-in-table-col-default-container">
                            <select onclick="show_default_input()"  name="f-add-col-in-table-input-default" id="add-col-in-table-col-default-id" class="add-col-in-table-col-default">
                                <option value="none-default"> --- DEFAULT --- </option>    
                                <option value="DEFAULT NULL"> NULL </option>
                                <option value="DEFAULT DEFINED"> AS DEFINED </option>
                                <option value="DEFAULT CURRENT_TIMESTAMP"> CURRENT_TIMESTAMP </option>
                            </select>
                            <!--- input #6.1 for default defined text --->
                            <input  name="f-add-col-in-table-as-defined-text-in" id="add-col-in-table-as-defined-text-inp" class="add-col-in-table-as-defined-style" placeholder="Enter Default Value..."/>
                            <div type="input" onclick="hide_default_input()" class="add-col-in-table-defined-btn-style" id="add-col-in-table-defined-btn-style-id"> Save </div>
                        </div>
                        <!--- input #7 for null --->
                        <label>
                            <p class="add-col-in-table-null-txt"> Not Null </p>
                            <input name="f-add-col-in-table-input-null" value="NOT NULL" type="checkbox" class="add-col-in-table-null-chkbox" id="add-col-in-table-null-chkbox-id"/>
                        </label>
                        <!--- input #8 for column name --->
                        <label>
                            <p class="add-col-in-table-increment-txt"> Auto Increment </p>
                            <input name="f-add-col-in-table-input-auto-increment" value="AUTO_INCREMENT" type="checkbox" class="add-col-in-table-auto-inc"/>
                        </label>
                    </div>
                    <!--- add column in table box -->
                </div>
                <!--- add column in table main box -->
            </form>
        </div>
        <!--- main box -->
</body>
</html>                        
                              
                       
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
