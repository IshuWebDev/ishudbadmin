// Last Updated 01 NOV
// console.log("Tables Script Running...");


// -------------------------------
// Notice function 
function red_notice(data) {
    var message = data;

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
    },5000);
}


function green_notice(data) {
    var message = data;

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
    },5000);
}

// -------------------------------

// EXPORT TABLE SECTION
function export_table(tbname,dbname)  {

    $(".export-tab-wrapper").css("display","block");
    $(".export-tab-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#export-tab-dbx").css("transform","scale(100%,100%)");
    },100)

    var cur_tb_name = tbname;
    var cur_db_name = dbname;

    if(document.getElementById("export-table-selected")) {
         document.getElementById("export-table-selected").innerText = cur_tb_name;
    }

    if(document.getElementById("export-cur-db-name")) {
        document.getElementById("export-cur-db-name").value = cur_db_name;
    }

    if(document.getElementById("export-cur-tb-name")) {
        document.getElementById("export-cur-tb-name").value = cur_tb_name;
    }

    document.getElementById("export-tab-btn").addEventListener("click",function(){
        $("#export-tab-dbx").css("transform","scale(80%,80%)");

        setTimeout(()=>{
            $(".export-tab-wrapper").css("display","none");
            $(".export-tab-box-bk").css("display","none");
        },500)

        setTimeout(()=>{
            $("#export-tab-dbx").css("transform","scale(120%,120%)");
        },600)


        function greenNoticeHome(message) {
            document.getElementById('notice-green-home').style.display = 'block';
            document.getElementById('green-text-home').innerHTML = message;
        
            // Hide notice dailog after 5 sec
            setTimeout(()=>{
                document.getElementById('notice-green-home').style.display = 'none';
            },6000);
        } 
        var message = 'SUCCESS :: Table Has Been Exported Successfully.';
        green_notice(message);
    })

}

// CLOSE EXPORT TABLE SECTION
$("#close-export-table").on("click",function(){
    $("#export-tab-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".export-tab-wrapper").css("display","none");
        $(".export-tab-box-bk").css("display","none");
    },500)

    setTimeout(()=>{
        $("#export-tab-dbx").css("transform","scale(120%,120%)");
    },600)
})


// -------------------------------

//  DELETE A TABLE SECTION
function delete_table(table,dbname) {
    var curr_table = table;
    var curr_dbname = dbname;

    $(".del-tab-wrapper").css("display","block");
    $(".del-tab-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#del-tab-dbx").css("transform","scale(120%,120%)");
    },100)

    document.getElementById("del-tab-selected-text").innerText = curr_table;

    document.getElementById("del-tab-name-in").value = curr_table;
    document.getElementById("del-tab-dbname-in").value = curr_dbname;
}


// CLOSE DELETE A TABLE SECTION
$("#close-del-tab").on("click",function(){
    $("#del-tab-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".del-tab-wrapper").css("display","none");
        $(".del-tab-box-bk").css("display","none");
    },500)

    setTimeout(()=>{
        $("#del-tab-dbx").css("transform","scale(100%,100%)");
    },600)
})

if(document.getElementById("del-tab-btn")) {
    document.getElementById("del-tab-btn").addEventListener("click",function(){
        document.getElementById("del-table-fid").setAttribute("onsubmit","return false");
        $("#del-tab-dbx").css("transform","scale(80%,80%)");
        setTimeout(()=>{
            $(".del-tab-wrapper").css("display","none");
            $(".del-tab-box-bk").css("display","none");
            document.getElementById("del-table-fid").submit();
        },500)
    })
}



// -------------------------------

// RENAME A TABLE 
function rename_table(tbname,dbname) {
    // store value in local var
    var curr_table = tbname;
    var curr_dbname = dbname;

    // Display On popup
    $(".renametb-wrapper").css("display","block");
    $(".renametb-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#renametb-dbx").css("transform","scale(100%,100%)");
    },100)

    // reinsert vaues to input
    document.getElementById("renametb_cur_tbname").value = curr_table;
    document.getElementById("renametb_cur_dbname").value = curr_dbname;
}


// Stop submition if empty table name  
if(document.getElementById("renametb-btn")) {
    document.getElementById("renametb-btn").addEventListener("click",function(){
        var value = document.getElementById("renametb_newame").value;
    
        if(value.length == 0) {
            $("#renametb-dbx").css("transform","scale(80%,80%)");

            setTimeout(()=>{
                $(".renametb-wrapper").css("display","none");
                $(".renametb-box-bk").css("display","none");    
            },500)
        
            setTimeout(()=>{
                $("#renametb-dbx").css("transform","scale(120%,120%)");
            },600)
    
            var message = 'CAUTION :: New Table Name Cannot Be Empty!';
            red_notice(message);
    
            document.getElementById("renametb_form_id").setAttribute("onsubmit","return false");
        }
        else {
            var no_space = /[ ]/;
            if(value.match(no_space)) {

                $("#renametb-dbx").css("transform","scale(80%,80%)");

                setTimeout(()=>{
                    $(".renametb-wrapper").css("display","none");
                    $(".renametb-box-bk").css("display","none");    
                },500)

                setTimeout(()=>{
                    $("#renametb-dbx").css("transform","scale(120%,120%)");
                },600)

                var message = 'CAUTION :: New Table Name Cannot have Space!';
                red_notice(message);
        
                document.getElementById("renametb_form_id").setAttribute("onsubmit","return false");
            }
            else {
                document.getElementById("renametb_form_id").setAttribute("onsubmit","return false");
                $("#renametb-dbx").css("transform","scale(80%,80%)");

                setTimeout(()=>{
                    document.getElementById("renametb_form_id").submit(); 
                },500)

                setTimeout(()=>{
                    $("#renametb-dbx").css("transform","scale(120%,120%)");
                },600)
            }
        }
    })
    
}


// CLOSE RENAME TABLE
$("#close-renametb").on("click",function(){
    $("#renametb-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".renametb-wrapper").css("display","none");
        $(".renametb-box-bk").css("display","none");    
    },500)

    setTimeout(()=>{
        $("#renametb-dbx").css("transform","scale(120%,120%)");
    },600)

    // null the value if canceled
    document.getElementById("renametb_newame").value = "";
})



// Function to add columns
function addCols() {

    // count value is the current id value

    //#1  We access the main container
    var parent = document.getElementById("new-table-main-container");
    //#2 count the child of main container
    var count = parent.childElementCount;
    //#4 access the each box for cloning
    var child = document.querySelector(".new-table-col-box");
    //#5 create a clone of child element
    var child_copy = child.cloneNode(true);
    //#6 add 'id' named attribute in the cloned element
    child_copy.setAttribute("id",count + "m")
    
    // append after empty the inputs
    // get array of all input of diff type of just cloned element
    var cloned_div_in_arr = child_copy.querySelectorAll("select,input,textarea,checkbox,div");
    // using index number append the values or uncheck

    // change the values of inputs of cloned child element
    // nullified value of table name
    cloned_div_in_arr[0].value = "";
    // remove red shadow from table name input
    cloned_div_in_arr[0].style.boxShadow =  "";
    // remove red shadow from data type input
    cloned_div_in_arr[1].style.boxShadow =  "";
    // nullified value of table length
    cloned_div_in_arr[2].value = "";
    // remove red shadow from length input
    cloned_div_in_arr[2].style.boxShadow =  "";
    // nullified value of column comment
    cloned_div_in_arr[4].value = "";
    // chnage specific option tag value of default select box
    cloned_div_in_arr[7].options[2].value = "DEFAULT DEFINED";
    // uncheck of default input textbox
    cloned_div_in_arr[8].value = "";
    // uncheck of null checkbox
    cloned_div_in_arr[10].checked = false;
    // uncheck of auto_increment checkbox
    cloned_div_in_arr[11].checked = false;

    // default save button display off of copied clone child
    cloned_div_in_arr[8].style.display = "none";
    // default input box display off of copied clone child
    cloned_div_in_arr[9].style.display = "none";
    // keep height standard og cloned child element
    child_copy.style.height = "110px"

    child_copy.style.height = "0px";
    // append the null div
    parent.appendChild(child_copy);
    setTimeout(()=>{
        child_copy.style.height = "110px";
    },100)

    // add a attribute as function in a input default selection of cloned child
    cloned_div_in_arr[7].setAttribute("onclick","as_defined(`" + count + "`);");
    // add a attribute as id in a input default selection of of cloned child
    cloned_div_in_arr[7].setAttribute("id",count);
     // add a attribute as id in a input default text input of cloned child
    cloned_div_in_arr[8].setAttribute("id",count + "d");
     // add a attribute as id in a input of null checkbox of cloned child
    cloned_div_in_arr[10].setAttribute("id",count + "n");
     // add a attribute as function in a input named div of defined input save button of cloned child
    cloned_div_in_arr[9].setAttribute("id",count + "b");
    // add a attribute as function in a input named div of defined input save button of cloned child
    cloned_div_in_arr[9].setAttribute("onclick","defined_in(`" + count  + "`);");
}



if(document.getElementById("new-table-main-container")) {
    // Function to remove coloms
    //#1 count the child
    var parent = document.getElementById("new-table-main-container");
    //#2 Functions to remove columns
    var count = parent.childElementCount;

    //#3 Fucntion to remove colom
    function remCols() {
        //#1 access the parent element
        var parent = document.getElementById("new-table-main-container");
        // count the child
        var count = parent.childElementCount;

        // not let remove element less than 1
        if(count < 5) {
            var message = 'CAUTION :: Please Do Not Remove All The Columns.';
            red_notice(message);
        } 
        else {
            parent.lastElementChild.style.height = "0px"
            setTimeout(()=>{
                parent.removeChild(parent.lastElementChild);
            },300) 
        }  
    }

}




// Submit button for count the total columns valu and assing it to a input before submit
// Also input validation of all columns
if(document.getElementById("submit-id")) {
    document.getElementById("submit-id").addEventListener("click",function(){

        // count column and insert sesion
        var parent = document.getElementById("new-table-main-container");
        // count the child
        var count = parent.childElementCount;
        // get exact value by substract previous sibling
        var realcount = count - 3;
        // assign value to a input
        document.getElementById("cols-count-in").value = realcount;
    
        // input validation of table name and database engine
        // get table name value
        var table_name = document.getElementById("new-table-name").value;
        // get storage engine value
        var storage_engine = document.getElementById("new-table-storage-engine").value;
    
        // first check if table name is null
        if(table_name.length == 0) {
            document.getElementById("creating_table_form_id").setAttribute("onsubmit","return false");
            document.getElementById("new-table-name").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
            setTimeout(()=>{
                document.getElementById("new-table-name").style.boxShadow =  "";
            },2000)
        }
        // if not
        else {
            // then check if databse engine is not selected
            if(storage_engine == "none-storage-engine") {
                document.getElementById("creating_table_form_id").setAttribute("onsubmit","return false");
                document.getElementById("new-table-storage-engine").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
                setTimeout(()=>{
                    document.getElementById("new-table-storage-engine").style.boxShadow =  "";
                },2000)
            }
            // if selected
            else {
                // first remove submit barrier attribute from form tag on submit click
                document.getElementById("creating_table_form_id").removeAttribute("onsubmit","return false");
                // but if validation return false then again set submit barrier in form tag on submit click
                colums_validation();
            }
        }
    });
    
}





// Function to catch input of every each box DEFAULT select click
function as_defined(data) {
   
    // receive id input in data
    // store in local varibale with amend as per other elements data id
    var curr_id_parent = data + "m";
    var curr_id_select = data;
    var curr_id_defined = data + "d";
    var curr_id_null = data + "n";
    var curr_id_btn = data + "b";

    // access specific elements
    var parent = document.getElementById(curr_id_parent);
    var select = document.getElementById(curr_id_select).value;
    var select_ele = document.getElementById(curr_id_select);
    var input = document.getElementById(curr_id_defined);
    var savebtn = document.getElementById(curr_id_btn);

    // when click on select box then firts value will be null
    select_ele.options[0].value = "";

    if(select == "DEFAULT DEFINED") {
        // expand height of each box
        parent.style.height = "155px";
        // display on of defined input 
        input.style.display = "block";
        // remove disabled attribute from this element
        document.getElementById(curr_id_null).removeAttribute("disabled","disabled");
        // show the button
        savebtn.style.display = "block";
        savebtn.style.paddingBottom = "10px";
        savebtn.style.paddingTop = "10px";

        // when click on --default define-- option then its value assign node-default
        select_ele.options[0].value  = "none-default";

    }
    else if(select == "none-default") {
        // collapse height of each box
        parent.style.height = "110px";
        // display off of defined input
        input.style.display = "none";
        // null the value of defined input
        input.value = "";
        // remove disabled attribute from checkbox
        document.getElementById(curr_id_null).removeAttribute("disabled","disabled");
        savebtn.style.display = "none";

          // when click on --default -- option then its value assign null
         select_ele.options[0].value  = "";

        // if other that 'default defin' option is click then chnag value of 'default defined' option
        var sel_ele = document.getElementById(curr_id_select);
        sel_ele.options[2].value = "DEFAULT DEFINED";

    }

    else if(select == "DEFAULT CURRENT_TIMESTAMP") {
          // collapse height of each box
        parent.style.height = "110px";
          // display off of defined input
        input.style.display = "none";
          // null the value of defined input
        input.value = "";
         // remove disabled attribute from checkbox
        document.getElementById(curr_id_null).removeAttribute("disabled","disabled");
        savebtn.style.display = "none";

        // if other that 'default defin' option is click then chnag value of 'default defined' option
        var sel_ele = document.getElementById(curr_id_select);
        sel_ele.options[2].value = "DEFAULT DEFINED";

        // when click on --default -- option then its value assign null
        select_ele.options[0].value  = "none-default";

    }
    else if(select == "DEFAULT NULL") {
          // collapse height of each box
        parent.style.height = "110px";
          // display off of defined input
        input.style.display = "none";
          // null the value of defined input
        input.value = "";
         // add disabled attribute from checkbox
        document.getElementById(curr_id_null).setAttribute("disabled","disabled");
        savebtn.style.display = "none";
  
        // if other that 'default defin' option is click then chnag value of 'default defined' option
        var sel_ele = document.getElementById(curr_id_select);
        sel_ele.options[2].value = "DEFAULT DEFINED";

        // when click on --default -- option then its value assign null
        select_ele.options[0].value  = "none-default";
    }
}



// Function to insert defined default input value to select val
function defined_in(data) {
    // store recievce data in varibles
    var id_of_sel = data;
    var id_of_mainbox = data + "m";
    var id_of_input = data + "d";
    var id_of_save_btn = data + "b";

    // on click insert the option tag text 
    var inbx = document.getElementById(id_of_sel);
    inbx.options[inbx.selectedIndex].text = "AS DEFINED";

    // transfer default input text to default select box option value;
    var input_value = document.getElementById(id_of_input).value;
    var x = inbx.options;
    x[2].value = "DEFAULT" + " " + "'" + input_value + "'";
   
    // collapse height of each box
    document.getElementById(id_of_mainbox).style.height = "110px";
    // display off of defined input
    document.getElementById(id_of_input).style.display = "none";
    // hide the button
    document.getElementById(id_of_save_btn).style.paddingBottom = "0px";
    document.getElementById(id_of_save_btn).style.paddingTop = "0px";
    setTimeout(()=> {
        document.getElementById(id_of_save_btn).style.display= "none";
    },600);
}




// Function to check all dynamic coloms input validation called by submit button
function colums_validation() {

    // store array in variable of all dynamic same input values
    var column_name_array = document.getElementsByName("f-new-table-input-colom-name[]");
   //  run a loop for each and every input tag and store in 'element' variable
    column_name_array.forEach(element => {
        // now access value of each input tag
        var column_name = element.value;
        // check if value is null
        if(column_name == "") {
            // bar submittion
            document.getElementById("creating_table_form_id").setAttribute("onsubmit","return false");
            element.style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
            setTimeout(()=>{
                element.style.boxShadow =  "";
            },2000)

            // this function will run until a single value is null
            var response_1 = true;
            check(response_1);
        }
    })

     // store array in variable of all dynamic same input values
    var data_type_array = document.getElementsByName("f-new-table-input-data-type[]");
     //  run a loop for each and every input tag and store in 'element' variable
    data_type_array.forEach(elements => {
         // now access value of each input tag
        var data_type = elements.value;
        if(data_type == "none-datatype") {
            // check if value is not selected
            document.getElementById("creating_table_form_id").setAttribute("onsubmit","return false");
            elements.style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
            setTimeout(()=>{
                elements.style.boxShadow =  "";
            },2000)

           // this function will run until a single value is null
           var response_2 = true;
           check(response_2); 
        }
    })
    
     // store array in variable of all dynamic same input values
    var length_array = document.getElementsByName("f-new-table-input-length[]");
     //  run a loop for each and every input tag and store in 'element' variable
    length_array.forEach(elementsr => {
          // now access value of each input tag
        var length_array = elementsr.value;
        if(length_array.length == 0) {
             // check if value is null
            document.getElementById("creating_table_form_id").setAttribute("onsubmit","return false");
            elementsr.style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
            setTimeout(()=>{
                elementsr.style.boxShadow =  "";
                },2000)
            
            // this function will run until a single value is null
            var response_3 = true;
            check(response_3);
        }
    })
}


// Function to recieve response rom check_val() function and set submittion bar attribute in form tag if validation fails;
// if validation pass then it will do nothiing and as per submit button function form will be submit
function check(response_1,response_2,response_3) {

    // recieve respone value
    if(response_1 && response_2 && response_3 == true) {
        // do nothing if validation NOT fail
    }
    else {
        // set form submittion bar attribute if validation fails
        document.getElementById("creating_table_form_id").setAttribute("onsubmit","return false");
    }
}