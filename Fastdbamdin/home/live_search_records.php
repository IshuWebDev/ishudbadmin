<!--- Last Updated 29 Oct 2022  --->
<!--- This is Ajax Processing Script calld by 'browse_records.js' --->

<?php 

session_start();

    // User cretidentials
    $hostname = $_SESSION['s-hostname'];
    $username = $_SESSION['s-username'];
    $password = $_SESSION['s-password'];

    // Amended current database and current table name store from SESSION vars to local var
    $dbname = $_SESSION['s-records-dbname'];
    $tbname = $_SESSION['s-records-tbname'];

    // amended current table fields array and columns count store from SESSION var to local var
    $fields_array = $_SESSION['s-record-fields-name-array'];
    $col_count = $_SESSION['s-records-field-count'];

    // convert from array to comma seperated text of field values to enable multiple column search
    $colums_text = implode(",",$fields_array);

    // access search key via get url method from fetch and store in local variable
    $search_key = $_GET['searchKey'];

    //array contain all field values
    $field_names_array =  $_SESSION['s-record-fields-name-array'];
    // count of filed values
    $field_count = $_SESSION['s-records-field-count'];
    //array contain key
    $key_array = $_SESSION['s-records-key-array'];
    // index of key in key field
    $PrikeyIndex = array_search('PRI', $key_array);
    
    try {
        // establish connection
        $con = new mysqli($hostname, $username, $password, $dbname);

        // statement of sql
        $sql = "SELECT * FROM" . " " . $tbname . " " . "WHERE concat" . "(" . $colums_text . ")" . " " . "LIKE" . " " . "'" . "%{$search_key}%" . "'" . ";";
        
        // execute sql statement
        try {
            $result= $con->query($sql);
            // if recieve more that 0 records
            if($result-> num_rows > 0 ) {
                // if no pri key available then down show buttons
                if($PrikeyIndex == "") {
                    
                    // showoff select all and delete button
                    echo "<script>
                            document.getElementById('select_all_btn').style.display = 'none';
                            document.getElementById('delete_all_btn').style.display = 'none';
                          </script>";

                    echo "<thead class='table-head'>
                        <tr class='head-table-row'>
                            <th class='head-table-data'> Actions </th>";

                    forEach($field_names_array as $value) {
                        echo 
                            "<th class='head-table-data'>" . $value . "</th>";
                    }
    
                    echo "</tr>
                        </thead>";
                                        
                    while($data = $result->fetch_assoc()) {
    
                        echo 
                        "<tbody>
                            <tr class='table-rows'>
                                <td class='table-data' style='min-width: 120px;'> 
                                    No key found
                                </td>";
    
                    forEach($field_names_array as $value) {
                    echo "<td class='table-data'>" . $data[$value] . "</td>";
                    }
                        echo "
                            </tr>
                        </tbody>";
                    }
                }

                // if pri key available then show action buttons
                else {
                    echo "<thead class='table-head'>
                    <tr class='head-table-row'>
                        <th class='head-table-data'> <i class='fa fa-trash' aria-hidden='true'></i> </th>
                        <th class='head-table-data'> Actions </th>";

                    forEach($field_names_array as $value) {
                        echo 
                            "<th class='head-table-data'>" . $value . "</th>";
                    }

                    echo "</tr>
                        </thead>";
                                    
                    while($data = $result->fetch_assoc()) {

                        // array contain key
                        $key_array = $_SESSION['s-records-key-array'];
                        // index number where key is located
                        $PrikeyIndex = array_search('PRI', $key_array);
                        // column who has primary key
                        $pricolumn = $field_names_array[$PrikeyIndex];
                        // primary column value
                        $priVal = $data[$pricolumn];
                       
                        echo "<tbody>
                            <tr class='table-rows'>
                                 <td class='table-data'>
                                    <input name='records-del-all[]' value='$priVal' class='each-del-select-checkbox' type='checkbox' style='margin-left:8px;margin-right:8px;'/>
                                </td>
                                <td class='table-data' style='min-width: 120px;'> 
                                <!--- form for edit records --->
                                <form style='display:inline-block;' action='processing_edit_record.php' method='POST'>
                                    <input style='display:none;' name='f-edit-record-cur-dbname' value='{$dbname}'/>
                                    <input style='display:none;' name='f-edit-record-cur-tbname' value='{$tbname}'/>
                                    <input style='display:none;' name='f-edit-record-pri-col-name' value='{$pricolumn}'/>
                                    <input style='display:none;' name='f-edit-record-pri-col-value' value='{$priVal}'/>
                                    <button type='submit' class='edit_records_btn'> Edit </button>
                                </form>
                                    <button onClick='delete_record(`$priVal`)' class='delete_records_btn'> Delete </button>
                                </td>";

                    forEach($field_names_array as $value) {
                    echo "<td class='table-data'>" . $data[$value] . "</td>";
                    }
                        echo "
                            </tr>
                        </tbody>";
                    }  
                }
            }
            else {
                // This code will run if 0 records found
                echo "<thead class='table-head'>
                        <tr class='head-table-row'>
                            <th class='head-table-data'> <i class='fa fa-trash' aria-hidden='true'></i> </th>";
                 // until this array has value then apply fucnction on value variable
                forEach($fields_array as $value) {
                echo 
                    "<th class='head-table-data'>" . $value . "</th>";
                    }

                echo "</tr>
                    </thead>";
                echo "
                    <tbody>
                        <tr class='table-rows'>
                            <td class='table-data'>
                                <input disabled='disabled' type='checkbox' style='margin-left:8px;margin-right:8px;'/>
                            </td>
                        <td colspan='{$col_count}' class='table-data' style='padding-right: 400px;'> 
                            No Records Found.
                        </td>
                        </tr>
                    </tbody>";
                }
        }
        catch(EXCEPTION $error) {
                echo $error->getMessage();
        }
    }
    catch(EXCEPTION $error) {
        echo $erro->getMessage();
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