// LAST UPDATED 07 OCT
// console.log("Home Script Running...");

// LOADING SECTION
function offloader() {
    $("#load-box").css("display","none");
}

// -------------------------------

// CREATE NEW DATABASE SECTION
$("#createdb-btn").on("click",function(){

    document.getElementById("cndb-txt-in").value = "";
    
    $(".cndb-wrapper").css("display","block");
    $(".cndb-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#cndb-dbx").css("transform","scale(100%,100%)");
    },100);
})

// CLOSE NEW DATABASE DAILOG BOX
$("#close-cndb").on("click",function(){

    $("#cndb-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".cndb-wrapper").css("display","none");
        $(".cndb-box-bk").css("display","none");
    },500);
   
    setTimeout(()=>{
        $("#cndb-dbx").css("transform","scale(120%,120%)");
    },600);
    
})

// CREATE DATABASE FORM INPUT VALIDATION
// By default form submition has off

// check form when submit button clicked
$("#cndb-btn").on("click",function() {

    // get input value
    var db_txt = document.getElementById("cndb-txt-in").value;

    // check input is null or not
    if(db_txt.length == 0) {
    
    // if empty then close form
    $("#cndb-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".cndb-wrapper").css("display","none");
        $(".cndb-box-bk").css("display","none");
    },500);
   
    setTimeout(()=>{
        $("#cndb-dbx").css("transform","scale(120%,120%)");
    },600);

    // edn response msg to submit enabler function
    var response_1 = false;
    validform(response_1);

    // sedn notice mesage
    var message = "CAUTION :: Cannot Create Database With Empty Name!"
    redNoticeHome(message);
    }
    else {
        // send true response to submit enabler function
        var response_1 = true;
        validform(response_1);
    }

     // check input has  space or not
    var no_space = /[ ]/;
    if (db_txt.match(no_space)) {

        // if has space then close form
        $("#cndb-dbx").css("transform","scale(80%,80%)");
    
        setTimeout(()=>{
            $(".cndb-wrapper").css("display","none");
            $(".cndb-box-bk").css("display","none");
        },500);
    
        setTimeout(()=>{
            $("#cndb-dbx").css("transform","scale(120%,120%)");
        },600);
    
        // send message to notice
        var message = "CAUTION :: Database Name Should Not Contain Spaces!"
        redNoticeHome(message);

        // send response msg to submit enabler function
        var response_2 = false;
        validform(response_2);
    }
    else {
        // send repsonse message to submit enabler function
        var response_2 = true;
        validform(response_2);
    }

    // function to show notice
    function redNoticeHome(message) {
        document.getElementById('notice-red-home').style.display = 'block';
        document.getElementById('red-text-home').innerHTML = message;
    
        // Hide notice dailog after 5 sec
        setTimeout(()=>{
            document.getElementById('notice-red-home').style.display = 'none';
        },5000);
    } 

    // Function to validate inout and the let form submit
    function validform(response) {
        if(response_1 && response_2 == true) {
            $("#cndb-dbx").css("transform","scale(80%,80%)");

            setTimeout(()=>{
                document.getElementById("cndb_form_id").submit();

                $(".cndb-wrapper").css("display","none");
                $(".cndb-box-bk").css("display","none");
            },400);
           
            setTimeout(()=>{
                $("#cndb-dbx").css("transform","scale(120%,120%)");
            },600);
           
        }
        else {
            document.getElementById("cndb_form_id").setAttribute("onsubmit","return false");
        }
    }
})



// -------------------------------

//  DELETE DATABASE
function delete_database(data){

    // assign current value of clicked button uid to input value for sent 
    document.getElementById("del-input-id").value = data;

    // edit text of warning the current uid
    document.getElementById("dbname_for_del").innerText = data;

    // #1 : display on the form box
    $(".db-del-wrapper").css("display","block");
    $(".db-del-box-bk").css("display","flex");

    // #2 : transform size
    setTimeout(()=>{
        $("#db-del-dbx").css("transform","scale(115%,115%)");
    },100)

    document.getElementById('del-f').setAttribute('onsubmit','return false');
}


// CLOSE DELETE DATABASE / DATABASE LIST SECTION
$("#close-db-del").on("click",function(){
    $("#db-del-dbx").css("transform","scale(100%,100%)");

    setTimeout(()=>{
        $(".db-del-wrapper").css("display","none");
        $(".db-del-box-bk").css("display","none");
    },400)
})


if(document.getElementById('del-f')){
    if(document.getElementById('db-del-btn')){

        document.getElementById('db-del-btn').addEventListener("click",function() {

            $("#db-del-dbx").css("transform","scale(100%,100%)");

            setTimeout(()=>{
               document.getElementById('del-f').submit();
            },300)
            
        })
    }
}

// -------------------------------

//  CHANGE DATABASE NAME / DATABASE LIST SECTION
$("#db-list-edit-btn").on("click",function(){
    $(".db-rename-wrapper").css("display","block");
    $(".db-rename-box-bk").css("display","flex");
})

// CLOSE CHANGE DATABASE NAME / DATABASE LIST SECTION
$("#close-db-rename").on("click",function(){
    $(".db-rename-wrapper").css("display","none");
    $(".db-rename-box-bk").css("display","none");
})




// DATABASE AND TABLE LIST
// By default table hider div will display off
// By default hide button will display off
// This function to hide table list
function hide(data) {

    // Clicked record unique id is received in 'data' variable

   // store record unique id in varible of database-name
   var db_box = data;

   // store record unique id in varible of hide button
   var btn_id_hide = data + "_btn_hide";

   // store record unique id in varible of show button
   var btn_id_show = data + "_btn_show";

   // Display control the next sibling of current-database div
   document.getElementById(db_box).nextSibling.style.display = "none";

    // Display control the next sibling of current-database div
   document.getElementById(btn_id_hide).style.display = "none";

    // Display control the next sibling of current-database div
   document.getElementById(btn_id_show).style.display = "block";
}

// This function to show table list
function show(data) {

   // Clicked record unique id is received in 'data' variable

   // store record unique id in varible of database-name
   var db_box = data;

   // store record unique id in varible of hide button
   var btn_id_show = data + "_btn_show";

   // store record unique id in varible of show button
   var btn_id_hide = data + "_btn_hide";

   // Display control the next sibling of current-database div
   document.getElementById(db_box).nextSibling.style.display = "block";

   // Display control the next sibling of current-database div
   document.getElementById(btn_id_hide).style.display = "block";

   // Display control the next sibling of current-database div
   document.getElementById(btn_id_show).style.display = "none";
}