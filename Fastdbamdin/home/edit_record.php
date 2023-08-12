<!--- LAST UPDATE 31 OCT -->

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
    <title> Insert Records </title>

</head>
<body onload="offloader()">

<!-- loader box -->
    <div id="load-box">
        <img src="../image/loader_1.svg" id="loader-1"/>
    </div>

<!--- NOTICE Box -->


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
                
       

        <!-- Top banner section  --->
        <div class="mainbox">
            <div class="head-body-container">
                <!--- This div contain heading text and two buttons --->
                <div class="edit-record-head-box">
                    <!--- heading text --->
                    <p class="edit-record-heading-text"> Edit Record of the Table : </p> 
                    <!--- heading text value --->
                    <p class="edit-record-selected-table-text"> 
                    <!--- php script started --->
                        <?php 
                            if(isset($_SESSION['s-edit-record-cur-tbname'])) {
                                // show this value as selected database
                                echo $_SESSION['s-edit-record-cur-tbname'];
                            }
                        ?>
                    </p>
                     <!--- buttons to cancel --->
                     <button onClick="location.href='cancel_edit_record.php';" class="cancel-edit-record-btn">
                        <i class="fa fa-times" style="margin-right: 5px;" aria-hidden="true"></i>
                        Cancel
                    </button> 
                </div> <!--- This div contain heading text and two buttons --->
                
                <!--- php script will run desc command to know information --->
                <?php
                    // curent table name 
                    if(isset($_SESSION['s-edit-record-cur-tbname'])) {
                        $cur_tb_name =  $_SESSION['s-edit-record-cur-tbname'];
                    }

                    // current database name
                    if(isset($_SESSION['s-edit-record-cur-tbname'])) {
                        $cur_db_name = $_SESSION['s-edit-record-cur-dbname'];
                    }

                     // login variables
                    $hostname = $_SESSION['s-hostname'];
                    $username = $_SESSION['s-username'];
                    $password = $_SESSION['s-password'];

                    // establish a connection
                    try {
                        $con = new mysqli($hostname, $username, $password);

                        $sql_1 = "DESC" . " " . $cur_db_name . "." . $cur_tb_name . " " . ";";

                        $result_1 = $con->query($sql_1);
                        // if any column found
                        if($result_1-> num_rows > 0 ) {
                           
                        echo '
                        <form action="updating_record.php" method="post">
                        <div id="edit-records-parent-element" class="edit-each-box-container"><!--- Parent element for clone --->
                                <!--- send current database and table info --->
                                <input style="display:none;" value="' . $cur_db_name . '" name="f_cur_dbname_edit"/>
                                <input style="display:none;" value="' . $cur_tb_name . '" name="f_cur_tbname_edit"/>
                                <button type="submit" class="save-insert-record-btn">
                                    <i class="fa fa-refresh" style="margin-right: 5px;" aria-hidden="true"></i>
                                    Update
                                </button>
                                
                                <!--- CLONE | child element for clone. each records box --->

                                        <div class="edit-col-each-box">
                                            <p class="edit-col-text"> This Row with all its columns </p>
                                            <!--- each column box --->';

                            // declare before while loop to prevent redeclare null
                            $columns_array = array();
                            // until recouds are fethcing
                            while($data = $result_1->fetch_assoc()) {
                                // show records
                                // store field name in local variable
                                $fields = $data['Field'];

                                $curr_colName = $data['Field'];
                                // push filed in this array
                                array_push($columns_array,$fields);

                                echo '             <div class="edit-record-col-box"> 
                                                    <table class="edit-table">
                                                        <tr class="edit-table-heading-tr">
                                                            <td class="edit-table-heading-td-name"> Column Name </td>
                                                            <td class="edit-table-heading-td-type"> Type </td>
                                                            <td class="edit-table-heading-td-null"> Null </td>
                                                            <td class="edit-table-heading-td-in" rowspan="2">
                                                                <textarea name="f-edit-records[]" type="text" class="edit-data-input" placeholder="Enter new data here...">';
                                                                
                                                                // start php script to fetch current column values
                                                                // this is primary column anme
                                                                $priCol = $_SESSION['s-edit-record-pri-col-name'];
                                                                // this is primary column value
                                                                $priVal = $_SESSION['s-edit-record-pri-col-value'];
                                                                // this is sql statement
                                                                $sql_2 = "SELECT" . " " . $curr_colName . " " . "FROM" . " " . $cur_db_name  . "." . $cur_tb_name . " " . "WHERE" . " " . $priCol . "=" . "'" . $priVal . "';";
                                                                // run the query
                                                                $result_2 = $con->query($sql_2);
                                                                // run if record found
                                                                if($result_2-> num_rows > 0 ) {
                                                                    // fetch until record found
                                                                    while($colval = $result_2->fetch_assoc()) {
                                                                        echo $colval[$curr_colName];
                                                                    }
                                                                }

                                                        echo '</textarea>
                                                            </td>
                                                        </tr> 
                                                        <tr class="edit-table-value-tr">
                                                            <td class="edit-table-values-td-name">' . $data['Field'] . '</td>
                                                            <td class="edit-table-values-td">' . $data['Type'] . '</td>
                                                            <td class="edit-table-values-td">' . $data['Null'] . '</td>
                                                        </tr>
                                                    </table>
                                                </div> <!--- each column box --->';
                            }
                            // after while loop executed
                            // num of columns 
                            $col_nums = count($columns_array);
                            echo '
                            <input style="display:none;" value="' . $col_nums . '" name="f_edit_colNums"/>
                            <input style="display:none;" value="' . $priCol . '" name="f_pri_col"/>
                            <input style="display:none;" value="' . $priVal . '" name="f_pri_val"/>'; 
                            echo '      </div><!--- CLONE | each records box --->
                        </div> <!--- this box contain each record box --->
                        </form>';
                        }
                    }
                    catch(EXCEPTION $error) {
                        $errmsg = $error->getMessage();
                        echo $errmsg;
                    }
                    $con->close();
                ?>
            </div> <!--- head and body container --->
        </div> <!--- main box -->
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
                              
