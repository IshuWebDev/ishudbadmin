// Last Update 27 Oct
// console.log("Browse Records Script Running...");

// Function for Notice

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


function show_yellow_notice(data) {
    var message = data;
    if( document.getElementById("yellow-notice-wrapper")) {
        document.getElementById("yellow-notice-wrapper").style.display = "flex";
        document.getElementById("yellow-text").innerText = message;
        document.getElementById("notice-yellow").style.display = "block";
    
        setTimeout(() => {
            document.getElementById("notice-yellow").style.transform = "scale(100%,100%)";
        },300);
    }
}

function hide_yellow_notice() {
    if( document.getElementById("yellow-notice-wrapper")) {
        setTimeout(() => {
            document.getElementById("notice-yellow").style.marginTop = "300px";
        },300);
        setTimeout(() => {
            document.getElementById("yellow-notice-wrapper").style.display = "none";
        },1000);
    }
}




// Function to call the ajax for show records
function browse_records_ajax(dbname,tbname) {
    // show notice when loading data is loading
    var message = "Please Wait While Records Are Loading...";
    show_yellow_notice(message);
    // fetching data from php script with send key
    fetch("../home/post_processing_records.php")
      // get a primise with response
    .then(function(response){
         // decide response receive data type
        return response.text(); 
    }).then(function(result){
        // store response in result variable
        // hide noitice UI
        hide_yellow_notice();
         // insert data in html 
        if(document.getElementById("ajax-return-reciever")) {
            document.getElementById("ajax-return-reciever").innerHTML = result;
        }
        
        // Be default global  message sent to select all button 'false'
        window.select_all = false;

    }).catch(function(error){
         // show errors
        console.log(error);
    });
}

// Load when visit page
browse_records_ajax();

document.getElementById("search_records_in");

// Function for live search records
function search_records() {
    var search_key = document.getElementById("search_records_in").value;

    if(search_key.length == 0) {
        browse_records_ajax();
        console.log("loaded");
        return false;
    }
    else {
        console.log("ajax call");
        search_live(search_key)
    }
}


// Function to enable live search
function search_live(searchkey) {
    // show notice when searching data is loading
    var message = "Searching Records...";
    show_yellow_notice(message);
    // fetching data from php script with send key
    fetch("../home/live_search_records.php?searchKey=" + searchkey)
    // get a primise with response
    .then(function(response){
        // decide response receive data type
        return response.text();
    }).then(function(result){
        // store response in result variable
        // hide noitice UI
        hide_yellow_notice();
        // insert data in html 
        document.getElementById("ajax-return-reciever").innerHTML = result;
    }).catch(function(error){
        // show errors
        console.log(error);
    });
}






// Delete Single records function. Ajax call
function delete_record(data) {

    window.cur_val = "";
    window.cur_val = data;

    // open confirmation UI
    $("#del-single-rec-wrapper").css("display","block");
    $("#del-single-record-box-dbk").css("display","flex");

    setTimeout(()=>{
        $("#del-single-rec-dbx").css("transform","scale(110%,110%)");
    },100)

    // execute ajax call only when this button click
    document.getElementById("del-sin-rec").addEventListener("click",function(){
        
        // current primary field value receive
        var message = "Deleting Records...";
        show_yellow_notice(message);
        // call ajax to delete specific record who has 'data' primary value
        fetch("../home/deleting_record.php?record=" + cur_val)
        // get a primise with response
        .then(function(){
            // Nothing to recieve
            }).then(function(){
            // nothing to insert
            // show success and hide noitice UI
            var message = "Records Has Been Deleted Successfully."
            green_notice(message);
            // Load when visit page
                browse_records_ajax();
        }).catch(function(error){
            // show errors
            console.log(error);
        })
        // Load when visit page
        browse_records_ajax();

        // after this button click display off confirmation popup
        $("#del-single-rec-dbx").css("transform","scale(80%,80%)");

            setTimeout(() => {
                $("#del-single-rec-wrapper").css("display","none");
                $("#del-single-record-box-dbk").css("display","none");
            },500);

            setTimeout(() => {
                $("#del-single-rec-dbx").css("transform","scale(100%,100%)");
            },600);
            
        })
}
    
// Close Delete single record confirmation UI on Cancel
if(document.getElementById("close-single-del-rec")) {
    document.getElementById("close-single-del-rec").addEventListener("click",function(){
        window.cur_val = "";

        $("#del-single-rec-dbx").css("transform","scale(80%,80%)");

        setTimeout(() => {
            $("#del-single-rec-wrapper").css("display","none");
            $("#del-single-record-box-dbk").css("display","none");
        }, 500);

        setTimeout(() => {
            $("#del-single-rec-dbx").css("transform","scale(100%,100%)");
        }, 600);
    })    
}






// DELETE ALL BY SELECT ALL BUTTONS
// set global variable message as false
window.select_all = false;

// when user click on SELECT ALL BUTTON
// Function to select all the records
if(document.getElementById("select_all_btn")) {
    document.getElementById("select_all_btn").addEventListener("click",function(){


        // access the selection button text element
        var sel_all_btn = document.getElementById("select-all-text");
        
         // check if selection button text element is 'select all'
        if(sel_all_btn.innerText == "Select All") {
            // set new text
            sel_all_btn.innerText = "UnSelect All";
            // assign check should be checked for php ajax
            var check_status = "checked='checked'";
            // show notice when checking data is loading
            var message = "Checking Records...";
            show_yellow_notice(message);
            // fetching data from php script with send key
            fetch("../home/check_records.php?check=" + check_status)
            // get a primise with response
            .then(function(response){
                // decide response receive data type
                return response.text();
            }).then(function(result){
                // store response in result variable
                // hide noitice UI
                hide_yellow_notice();
    
                // set global message as true
                window.select_all = true;
        
                // insert data in html 
                document.getElementById("ajax-return-reciever").innerHTML = result;
            }).catch(function(error){
                // show errors
                console.log(error);
            });
        }
    
        // check if selection button text element is 'select all'
        else {
            // set new text
            sel_all_btn.innerText = "Select All";
              // assign check should be checked for php ajax
            var check_status = "";
            // show notice when checking data is loading
            var message = "Checking Records...";
            show_yellow_notice(message);
            // fetching data from php script with send key
            fetch("../home/check_records.php?check=" + check_status)
            // get a primise with response
            .then(function(response){
                // decide response receive data type
                return response.text();
            }).then(function(result){
                // store response in result variable
                // hide noitice UI
                hide_yellow_notice();
    
                // set global message as false
                window.select_all = false;
    
                // insert data in html 
                document.getElementById("ajax-return-reciever").innerHTML = result;
            }).catch(function(error){
                // show errors
                console.log(error);
            });
        }
    })
    
}


// when user click on SELECT ALL BUTTON
// This function is called by DELETE button when global 'select-all' message is true
function delete_all_records() {

    // Display ON Confirmation UI
    $("#del-mul-rec-wrapper").css("display","block");
    $("#del-mul-rec-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#del-multi-rec-dbx").css("transform","scale(110%,110%)")
    },100);
    
    // wait for Confirm delete all button press
    document.getElementById("del-mul-rec").addEventListener("click",function(){

        $("#del-multi-rec-dbx").css("transform","scale(80%,80%)")
        
        // show deleting notice until seccuess return
        var data = "Please Wait While...Deleting All Records"
        show_yellow_notice(data)

        // where all comma seperated values are sent as text in data variable via GET method
        // call ajax to delete specific record who has 'data' primary value
        fetch("../home/truncation_table.php")
        // get a primise with response
        .then(function(){
            // nothing
        }).then(function(){
            // nothing to insert
            // success notice show
            var message = "SUCCESS :: All Records Has Been Deleted Successfully."
            green_notice(message);
            // reload data
            browse_records_ajax();
        }).catch(function(error){
            // show errors
            console.log(error);
        });

        // close the Delete confirmation UI
       
        $("#del-multi-rec-dbx").css("transform","scale(80%,80%)");

            setTimeout(() => {
                $("#del-mul-rec-wrapper").css("display","none");
                $("#del-mul-rec-box-bk").css("display","none");
            },500);
    
            setTimeout(() => {
                $("#del-multi-rec-dbx").css("transform","scale(100%,100%)");
            },600);
       

        // reset global message as false
        window.select_all = false;
    })
}





// **********************************//

// DELETE MULTIPLE RECORDS SECTION

// Global varibal by default has null value
window.main_array = "";

// $(document).on keyword is used when this element is came from ajax call or is dynamic
// when input boxes are click means they are checked then push these values in a array
$(document).on("click",".each-del-select-checkbox",function(){

    // if any checkbox is clicked then assign global messge as false
    window.select_all == false;
    
    // Empty array will store every value of checkbox being checked. and will nul on every click
    var checked_array = [];

    // when user click on checkbox
    // of all perticular class input(s)
    // start function
    // store each input value on every click in value variable
    // puch or amend that value in a array called 'checked-array'
    // every clicked checkbox value will be store in array
    $(":checkbox:checked").each(function() {
        checked_array.push(this.value);
    });

    // explode that array and seperated by ','
    data = checked_array.join(",");

    // after any checked a Global variable has a value
    window.main_array = data;

        // send this comma seperated value to ajax 
        // When user confirm to delete then execute ajax call
        document.getElementById("del-mul-rec").addEventListener("click",function(){

            $("#del-multi-rec-dbx").css("transform","scale(80%,80%)");

            // show deleting notice until seccuess return
            var message = "Please Wait While Deleting Records...";
            show_yellow_notice(message);

            // where all comma seperated values are sent as text in data variable via GET method
            // call ajax to delete specific record who has 'data' primary value
            fetch("../home/deleting_multi_records.php?record_all=" + data)
            // get a primise with response
            .then(function(){
                // Nothing to recieve
            }).then(function(){
                // nothing to insert
                // success notice show
                var message = "SUCCESS :: Records Has Been Deleted Successfully."
                green_notice(message);
                // reload data
                browse_records_ajax();
            }).catch(function(error){
                // show errors
                console.log(error);
            })

            // closwe the Delete confirmation UI
            $("#del-multi-rec-dbx").css("transform","scale(80%,80%)");

            setTimeout(() => {
                $("#del-mul-rec-wrapper").css("display","none");
                $("#del-mul-rec-box-bk").css("display","none");
            },500);
    
            setTimeout(() => {
                $("#del-multi-rec-dbx").css("transform","scale(100%,100%)");
            },600);

            // redeclare this array as empty array
            checked_array = [];
            // after delete query the Global variable  assign a null value
            window.main_array = "";
    })
}); 



// If user click delete button without checking any record then check if array has value or not
if(document.getElementById("delete_all_btn")) {
    document.getElementById("delete_all_btn").addEventListener("click",function(){
        $("#del-multi-rec-dbx").css("transform","scale(100%,100%)");

        setTimeout(() => {
            $("#del-multi-rec-dbx").css("transform","scale(110%,110%)");
        }, 100);

        // select all button is presssed then this Global message is true and 'delete-all-records' function is call
        if(window.select_all == true) {
            delete_all_records();
        }
        // if false means unselected all or any checkbox is clicked
        else if (window.select_all == false) {
            // If Global variable has null value then notice will show
            if(window.main_array.length == 0) {
                // show notice when no single checkbox is checked but user try to delete
                var message = "CAUTION :: Please Select At Least Record To Proceed."
                red_notice(message);
    
                // closwe the Delete confirmation UI
                $("#del-mul-rec-wrapper").css("display","none");
                $("#del-mul-rec-box-bk").css("display","none");
            }
            else  {
                // Display ON Confirmation UI
                $("#del-mul-rec-wrapper").css("display","block");
                $("#del-mul-rec-box-bk").css("display","flex");
            }
        }
    })
    
}

// When user click on Multiple DELETE CANCEL button/ Display Of Confirmation UI
if(document.getElementById("close-del-mul-rec")) {
    document.getElementById("close-del-mul-rec").addEventListener("click",function(){
        $("#del-multi-rec-dbx").css("transform","scale(80%,80%)");
        setTimeout(() => {
            $("#del-mul-rec-wrapper").css("display","none");
            $("#del-mul-rec-box-bk").css("display","none");
        }, 500);
        setTimeout(() => {
            $("#del-multi-rec-dbx").css("transform","scale(100%,100%)");
        }, 500);
    })
}






/* INSERT RECORDS SECTION */
/* Add Rows by Click Add buttton */
function addRecord() {
    // count value is the current id value

    //#1  We access the main container
    var parent = document.getElementById("insert-records-parent-element");
    //#2 count the child of main container
    var count = parent.childElementCount;
    //#4 access the each box for cloning
    var child = document.querySelector(".insert-col-each-box");
    //#5 create a clone of child element
    var child_copy = child.cloneNode(true);
   
    // access all input we want to be null withi clone child
    clone_input_box = child_copy.querySelectorAll("textarea");
    // length of array. num of elements
    input_box_count = clone_input_box.length;

    // until all element run. assign null value to input
    for(i=0;i<input_box_count;i++) {
        x = i;
        clone_input_box[x].value = "";
    }

    // append the null div
    parent.appendChild(child_copy);
}


//#3 Fucntion to remove colom
function remRecord() {
    //#1 access the parent element
    var parent = document.getElementById("insert-records-parent-element");
    // count the child
    var count = parent.childElementCount;

    // not let remove element less than 1
    if(count < 5) {
        var message = 'CAUTION :: Please Do Not Remove All The Records.';
        red_notice(message);
    } 
    else {
        parent.removeChild(parent.lastElementChild);
    }  
}
