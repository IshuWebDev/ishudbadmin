// console.log("Structure Script Running...")

//  STRUCTURE OF TABLE
// Delete Column 
// This function is called by Delete button in structure page
function delete_col(tbname,dbname,field) {
    // get table name, database name and column name

    // insert current field name in popup box
    document.getElementById("selected-table-del-col").innerText = " " + "'" + field + "'" + " ";

    // assign tbname/dbname/column name in inputs
    document.getElementById("del-col-tbname-in").value = tbname;
    document.getElementById("del-col-dbname-in").value = dbname;
    document.getElementById("del-col-field-in").value = field;

    // show popup
    $(".del-col-wrapper").css("display","block");
    $(".del-col-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#del-col-dbx").css("transform","scale(120%,120%)");
    },100)
}

// CLOSE DELETE COLUMN 
$("#close-del-col").on("click",function(){
    $("#del-col-dbx").css("transform","scale(100%,100%)");
    
    // show off popup
    setTimeout(()=>{
        $(".del-col-wrapper").css("display","none");
        $(".del-col-box-bk").css("display","none");
    },500)

    setTimeout(()=>{
        $("#del-col-dbx").css("transform","scale(100%,100%)");
    },600)
   
})

if(document.getElementById("delete_column_form_id")) {
    document.getElementById("delete_column_form_id").addEventListener("click",function(){
        document.getElementById("delete_column_form_id").setAttribute("onsubmit","return false");
        $("#del-col-dbx").css("transform","scale(100%,100%)");

        setTimeout(()=>{
            document.getElementById("delete_column_form_id").submit();
        },500)

        setTimeout(()=>{
            $("#del-col-dbx").css("transform","scale(100%,100%)");
        },600)
    })
}




// Add Key in  Column 
// This function is called by Add key button in structure page
function addkey(tbname,dbname,field) {
    // get table name, database name and column name

    // insert current field name in popup box
    document.getElementById("selected-table-add-key").innerText = " " + "'" + field + "'" + " ";

    // assign tbname/dbname/column name in inputs
    document.getElementById("add-key-tbname-in").value = tbname;
    document.getElementById("add-key-dbname-in").value = dbname;
    document.getElementById("add-key-field-in").value = field;

    // show popup
    $(".add-key-wrapper").css("display","block");
    $(".add-key-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#add-key-dbx").css("transform","scale(100%,100%)");
    },100)
}

// CLOSE ADD KEY UI 
$("#close-add-key").on("click",function(){
    $("#add-key-dbx").css("transform","scale(80%,80%)");

    // show off popup
    setTimeout(()=>{
        $(".add-key-wrapper").css("display","none");
        $(".add-key-box-bk").css("display","none");
    },500)

    setTimeout(()=>{
        $("#add-key-dbx").css("transform","scale(120%,120%)");
    },600)
})

if(document.getElementById("add-key-btn")) {
    document.getElementById("add-key-btn").addEventListener("click",function(){
        document.getElementById("add_key_col_form_id").setAttribute("onsubmit","return false");
        $("#add-key-dbx").css("transform","scale(80%,80%)");
        setTimeout(()=>{
            document.getElementById("add_key_col_form_id").submit();
        },500)
    
        setTimeout(()=>{
            $("#add-key-dbx").css("transform","scale(120%,120%)");
        },800)
    })
}




// Remove Key in Column 
// This function is called by Add key button in structure page
function remprikey(tbname,dbname) {
    // get current table name and database name

    // assign tbname/dbname name in inputs
    document.getElementById("rem-key-tbname-in").value = tbname;
    document.getElementById("rem-key-dbname-in").value = dbname;

    // show popup
    $(".rem-key-wrapper").css("display","block");
    $(".rem-key-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#rem-key-dbx").css("transform","scale(100%,100%)");
    },100)
}

// CLOSE REMOVE PRIMARY KEY UI 
$("#close-rem-key").on("click",function(){
    $("#rem-key-dbx").css("transform","scale(80%,80%)");
    // show off popup
    setTimeout(()=>{
        $(".rem-key-wrapper").css("display","none");
        $(".rem-key-box-bk").css("display","none");
    },500)

    setTimeout(()=>{
        $("#rem-key-dbx").css("transform","scale(120%,120%)");;
    },600)
   
})

if(document.getElementById("rem-key-btn")) {
    document.getElementById("rem-key-btn").addEventListener("click",function(){
        $("#rem-key-dbx").css("transform","scale(80%,80%)");
        document.getElementById("rem_pri_key_form_id").setAttribute("onsubmit","return false");
        setTimeout(() => {
            document.getElementById("rem_pri_key_form_id").submit();
        },500);

        setTimeout(()=>{
            $("#rem-key-dbx").css("transform","scale(120%,120%)");;
        },600)
    })
}


// ADD COLUMN SECTION

// input validation
if(document.getElementById("add-col-in-table-input-submit")) {
document.getElementById("add-col-in-table-input-submit").addEventListener("click",function(){
    var colname = document.getElementById("add-col-in-table-input-colom-name-in").value;
    var datatype = document.getElementById("add-col-in-table-input-data-type-in").value;
    var lengthh = document.getElementById("add-col-in-table-input-length-in").value;
 
    var nospace = /^[ ]*$/;
    if(colname.length == 0) {
        
        // show warning style
        document.getElementById("add-col-in-table-input-colom-name-in").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
        // hide after 2 sec 
        setTimeout(()=>{
            document.getElementById("add-col-in-table-input-colom-name-in").style.boxShadow =  "";
        },2000)
        // stop form submittion
        document.getElementById("adding_table_form_id").setAttribute("onsubmit","return false");
    }
    else {
        if(colname.match(nospace)) {
            // show warning style
            document.getElementById("add-col-in-table-input-colom-name-in").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
            // hide after 2 sec 
            setTimeout(()=>{
                document.getElementById("add-col-in-table-input-colom-name-in").style.boxShadow =  "";
            },2000)
            // stop form submittion
            document.getElementById("adding_table_form_id").setAttribute("onsubmit","return false");
        }
        else {
            if(datatype == "none-datatype") {
                 // show warning style
                document.getElementById("add-col-in-table-input-data-type-in").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
                // hide after 2 sec 
                setTimeout(()=>{
                    document.getElementById("add-col-in-table-input-data-type-in").style.boxShadow =  "";
                },2000)
                // stop form submittion
                document.getElementById("adding_table_form_id").setAttribute("onsubmit","return false");
            }
            else {
                if(lengthh.length == 0) {
                     // show warning style
                    document.getElementById("add-col-in-table-input-length-in").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
                    // hide after 2 sec 
                    setTimeout(()=>{
                        document.getElementById("add-col-in-table-input-length-in").style.boxShadow =  "";
                    },2000)
                    // stop form submittion
                    document.getElementById("adding_table_form_id").setAttribute("onsubmit","return false");
                }
                else {
                    document.getElementById("adding_table_form_id").removeAttribute("onsubmit","return false");
                }
            }
        }
    }
})
}

// By default button will be Display off
if(document.getElementById("add-col-in-table-defined-btn-style-id")) {
    document.getElementById("add-col-in-table-defined-btn-style-id").style.display = "none";
}
if(document.getElementById("add-col-in-table-defined-btn-style-id")) {
    document.getElementById("add-col-in-table-defined-btn-style-id").style.paddingBottom = "0px";
}
if(document.getElementById("add-col-in-table-defined-btn-style-id")) {
    document.getElementById("add-col-in-table-defined-btn-style-id").style.paddingTop = "0px";

}


// DEFAULT SELECT BOX FUNCTION
function show_default_input() {
    var select = document.getElementById("add-col-in-table-col-default-id").value;

    if(select == "DEFAULT DEFINED") {
        // expand height of each box
        document.getElementById("add-col-in-table-col-box-id").style.height = "155px";
        // display on of defined input 
        document.getElementById("add-col-in-table-as-defined-text-inp").style.display = "block";
        // remove disabled attribute from this element
        document.getElementById("add-col-in-table-null-chkbox-id").removeAttribute("disabled","disabled");
        // show ONN the button
        document.getElementById("add-col-in-table-defined-btn-style-id").style.display = "block";
        document.getElementById("add-col-in-table-defined-btn-style-id").style.paddingBottom = "10px";
        document.getElementById("add-col-in-table-defined-btn-style-id").style.paddingTop = "10px";

    }
    else if ((select == "none-default")  || (select == "DEFAULT CURRENT_TIMESTAMP")) {
        // display OFF mainbox
        document.getElementById("add-col-in-table-col-box-id").style.height = "110px";
        // display OFF defined input 
         document.getElementById("add-col-in-table-as-defined-text-inp").style.display = "none";
           // remove disabled attribute from this element
        document.getElementById("add-col-in-table-null-chkbox-id").removeAttribute("disabled","disabled");
        // hide the button
         document.getElementById("add-col-in-table-defined-btn-style-id").style.display = "none";
    }
    else if(select == "DEFAULT NULL") {
        // display OFF mainbox
        document.getElementById("add-col-in-table-col-box-id").style.height = "110px";
        // display OFF defined input 
        document.getElementById("add-col-in-table-as-defined-text-inp").style.display = "none";
        // hide the button
        document.getElementById("add-col-in-table-defined-btn-style-id").style.display = "none";
        // add disabled attribute from this element
        document.getElementById("add-col-in-table-null-chkbox-id").setAttribute("disabled","disabled");
    }
}



// Close defaulr define input
function hide_default_input() {
    // display OFF mainbox
    document.getElementById("add-col-in-table-col-box-id").style.height = "110px";
    // display OFF defined input 
    document.getElementById("add-col-in-table-as-defined-text-inp").style.display = "none";
    // hide the button
     document.getElementById("add-col-in-table-defined-btn-style-id").style.display = "none";
}








// CHNAGE COLUMN SECTION

// input validation
if(document.getElementById("change-col-in-table-input-submit")) {
    document.getElementById("change-col-in-table-input-submit").addEventListener("click",function(){
  
        var colname = document.getElementById("change-col-in-table-input-colom-name-in").value;
        var datatype = document.getElementById("change-col-in-table-input-data-type-in").value;
        var lengthh = document.getElementById("change-col-in-table-input-length-in").value;
     
        var nospace = /^[ ]*$/;
        if(colname.length == 0) {
            
            // show warning style
            document.getElementById("change-col-in-table-input-colom-name-in").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
            // hide after 2 sec 
            setTimeout(()=>{
                document.getElementById("change-col-in-table-input-colom-name-in").style.boxShadow =  "";
            },2000)
            // stop form submittion
            document.getElementById("changing_table_form_id").setAttribute("onsubmit","return false");
        }
        else {
            if(colname.match(nospace)) {
                // show warning style
                document.getElementById("change-col-in-table-input-colom-name-in").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
                // hide after 2 sec 
                setTimeout(()=>{
                    document.getElementById("change-col-in-table-input-colom-name-in").style.boxShadow =  "";
                },2000)
                // stop form submittion
                document.getElementById("changing_table_form_id").setAttribute("onsubmit","return false");
            }
            else {
                if(datatype == "none-datatype") {
                     // show warning style
                    document.getElementById("change-col-in-table-input-data-type-in").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
                    // hide after 2 sec 
                    setTimeout(()=>{
                        document.getElementById("change-col-in-table-input-data-type-in").style.boxShadow =  "";
                    },2000)
                    // stop form submittion
                    document.getElementById("changing_table_form_id").setAttribute("onsubmit","return false");
                }
                else {
                    if(lengthh.length == 0) {
                         // show warning style
                        document.getElementById("change-col-in-table-input-length-in").style.boxShadow =  "1px 1px 20px 5px rgb(255, 70, 49)";
                        // hide after 2 sec 
                        setTimeout(()=>{
                            document.getElementById("change-col-in-table-input-length-in").style.boxShadow =  "";
                        },2000)
                        // stop form submittion
                        document.getElementById("chanign_table_form_id").setAttribute("onsubmit","return false");
                    }
                    else {
                        document.getElementById("changing_table_form_id").removeAttribute("onsubmit","return false");
                    }
                }
            }
        }
    })
    
}

// By default button will be Display off
if(document.getElementById("change-col-in-table-defined-btn-style-id")) {
    document.getElementById("change-col-in-table-defined-btn-style-id").style.display = "none";
}
if(document.getElementById("change-col-in-table-defined-btn-style-id")) {
    document.getElementById("change-col-in-table-defined-btn-style-id").style.paddingBottom = "0px";
}
if(document.getElementById("change-col-in-table-defined-btn-style-id")) {
    document.getElementById("change-col-in-table-defined-btn-style-id").style.paddingTop = "0px";
}


// DEFAULT SELECT BOX FUNCTION
function show_change_default_input() {
    var select = document.getElementById("change-col-in-table-col-default-id").value;

    if(select == "DEFAULT DEFINED") {
    
        // display on of defined input 
        document.getElementById("change-col-in-table-as-defined-text-inp").style.display = "block";
        // remove disabled attribute from this element
        document.getElementById("change-col-in-table-null-chkbox-id").removeAttribute("disabled","disabled");
        // show ONN the button
        document.getElementById("change-col-in-table-defined-btn-style-id").style.display = "block";
        document.getElementById("change-col-in-table-defined-btn-style-id").style.paddingBottom = "10px";
        document.getElementById("change-col-in-table-defined-btn-style-id").style.paddingTop = "10px";

    }
    else if ((select == "none-default")  || (select == "DEFAULT CURRENT_TIMESTAMP")) {
       
        // display OFF defined input 
        document.getElementById("change-col-in-table-as-defined-text-inp").style.display = "none";
        // remove disabled attribute from this element
        document.getElementById("change-col-in-table-null-chkbox-id").removeAttribute("disabled","disabled");
        // hide the button
        document.getElementById("change-col-in-table-defined-btn-style-id").style.display = "none";
    }
    else if(select == "DEFAULT NULL") {
        
        // display OFF defined input 
        document.getElementById("change-col-in-table-as-defined-text-inp").style.display = "none";
        // hide the button
        document.getElementById("change-col-in-table-defined-btn-style-id").style.display = "none";
        // add disabled attribute from this element
        document.getElementById("change-col-in-table-null-chkbox-id").setAttribute("disabled","disabled");
    }
}



// Close defaulr define input
function hide_change_default_input() {
    // display OFF defined input 
    document.getElementById("change-col-in-table-as-defined-text-inp").style.display = "none";
    // hide the button
    document.getElementById("change-col-in-table-defined-btn-style-id").style.display = "none";
}