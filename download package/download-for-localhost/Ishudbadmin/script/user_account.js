// Last Updated 11 Oct

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



// CREATE NEW USER ACCOUNT SECTION
$("#add-new-user-btn").on("click",function(){

    // Empty all the input fileds
    document.getElementById("cnua-user-in").value = "";
    document.getElementById("cnua-pass-in").value = "";
    document.getElementById("cnua-repass-in").value = "";

    $(".cnua-wrapper").css("display","block");
    $(".cnua-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#cnua-dbx").css("transform","scale(100%,100%)");
    },100);
})

// CLOSE NEW USER ACCOUNT SECTION
$("#close-cnua").on("click",function(){
    $("#cnua-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".cnua-wrapper").css("display","none");
        $(".cnua-box-bk").css("display","none");
    },700);

    setTimeout(()=>{
        $("#cnua-dbx").css("transform","scale(120%,120%)");
    },700);
})

// Form validation when user submit
$("#cnua-btn-proceed").on("click",function(){

    // get input values
    var username = document.getElementById("cnua-user-in").value;
    var hostname = document.getElementById("cnua-host-in").value;
    var password = document.getElementById("cnua-pass-in").value;
    var repassword = document.getElementById("cnua-repass-in").value;

    // check if username null [1]
    if(username.length == 0) {

        // Close the form
        $("#cnua-dbx").css("transform","scale(80%,80%)");

        setTimeout(()=>{
            $(".cnua-wrapper").css("display","none");
            $(".cnua-box-bk").css("display","none");
        },700);
    
        setTimeout(()=>{
            $("#cnua-dbx").css("transform","scale(120%,120%)");
        },700);

        // Notice message
        var message = "CAUTION :: Username Cannot Be Empty!";
        red_notice(message);
       
        // validation and submittion function
        var response_11 = false;
        cnu_inval(response_11);

    }
    else {

        // if [2] username isnt null then forward execution to another input  

        // send response to submitter function
        var response_11 = true;
        cnu_inval(response_11);


        // now check if username has space [2]
        var no_space = /[ ]/;
        if (username.match(no_space)) {

            // Close the form
            $("#cnua-dbx").css("transform","scale(80%,80%)");

            setTimeout(()=>{
                $(".cnua-wrapper").css("display","none");
                $(".cnua-box-bk").css("display","none");
            },700);
        
            setTimeout(()=>{
                $("#cnua-dbx").css("transform","scale(120%,120%)");
            },700);

            // notice message
            var message = "CAUTION :: Username Should Not Contain Space!";
            red_notice(message);

            // send resposne to submitter function
            var response_12 = false;
            cnu_inval(response_12);

        }
        else {
            // if [3] username has not the space then forward execution to another input  

            // send response to submitter function
            var response_12 = true;
            cnu_inval(response_12);

            // check weather hostname is null  [3]
            if(hostname.length == 0) {

                // Close the form
                $("#cnua-dbx").css("transform","scale(80%,80%)");

                setTimeout(()=>{
                    $(".cnua-wrapper").css("display","none");
                    $(".cnua-box-bk").css("display","none");
                },700);
            
                setTimeout(()=>{
                    $("#cnua-dbx").css("transform","scale(120%,120%)");
                },700);
                
                // notice message
                var message = "CAUTION :: Hostname Cannot Be Empty!";
                red_notice(message);
                    
                // send resposne to submitter function
                var response_21 = false;
                cnu_inval(response_21);
            }
            else {

                // if [4] hostname isnt null then forward execution to another input  

                // send resposne to submitter function
                var response_21 = true;
                cnu_inval(response_21);

                // check if hostname has space [4]
                var no_space = /[ ]/;
                if (hostname.match(no_space)) {

                    // Close the form
                    $("#cnua-dbx").css("transform","scale(80%,80%)");

                    setTimeout(()=>{
                        $(".cnua-wrapper").css("display","none");
                        $(".cnua-box-bk").css("display","none");
                    },700);
                
                    setTimeout(()=>{
                        $("#cnua-dbx").css("transform","scale(120%,120%)");
                    },700);
                    
                    // notice message
                    var message = "CAUTION :: Hostname Should Not Contain Space!";
                    red_notice(message);
                    
                    // send resposne to submitter function
                    var response_22 = false;
                    cnu_inval(response_22);
                }
                else {

                    // if [5] hostname hasnt space then forward execution to another input 
                    
                    // send resposne to submitter function
                    var response_22 = true;
                    cnu_inval(response_22);

                    // check weather password is null  [5]
                    if(password.length == 0) {

                        // close the form
                        $("#cnua-dbx").css("transform","scale(80%,80%)");

                        setTimeout(()=>{
                            $(".cnua-wrapper").css("display","none");
                            $(".cnua-box-bk").css("display","none");
                        },700);
                    
                        setTimeout(()=>{
                            $("#cnua-dbx").css("transform","scale(120%,120%)");
                        },700);

                        // send notice
                        var message = "CAUTION :: Password Cannot Be Empty!";
                        red_notice(message);
                        
                        // send response to submitter function
                        var response_31 = false;
                        cnu_inval(response_31);
                    }
                    else {
                        // if [6] password isnt null then forward execution to another input 

                        // send response to submitter function
                        var response_31 = true;
                        cnu_inval(response_31);

                        // check if password has space [6]
                        var no_space = /[ ]/;
                        if (password.match(no_space)) {

                            // Close the form
                            $("#cnua-dbx").css("transform","scale(80%,80%)");

                            setTimeout(()=>{
                                $(".cnua-wrapper").css("display","none");
                                $(".cnua-box-bk").css("display","none");
                            },700);
                        
                            setTimeout(()=>{
                                $("#cnua-dbx").css("transform","scale(120%,120%)");
                            },700);

                            // Notice send
                            var message = "CAUTION :: Password Should Not Contain Space!";
                            red_notice(message);

                            // send response to submitter function
                            var response_32 = false;
                            cnu_inval(response_32);

                        }
                        else {
                            // if [7] password hasnt space then forward execution to another input 

                            var response_32 = true;
                            cnu_inval(response_32);

                            // check weather re password is match [7]
                            if(repassword !== password) {

                            // Close the form
                            $("#cnua-dbx").css("transform","scale(80%,80%)");

                            setTimeout(()=>{
                                $(".cnua-wrapper").css("display","none");
                                $(".cnua-box-bk").css("display","none");
                            },700);
                        
                            setTimeout(()=>{
                                $("#cnua-dbx").css("transform","scale(120%,120%)");
                            },1000);

                            // Notice send
                            var message = "CAUTION :: Please Enter Same Password!";
                            red_notice(message);
                            
                            // Send response to submitter function
                            var response_41 = false;
                            cnu_inval(response_41);

                            }
                            else {
                                // finally form is validated and send respose to submitter function
                                var response_41 = true;
                                cnu_inval(response_41);

                            }
                        }
                    }
                }
            }
        }
    }

   


    // function let submit data when form has validated
    function cnu_inval(response) {
        if(response_11 && response_12 && response_21 && response_22 && response_31 && response_32 && response_41 == true) {
            document.getElementById("cnu-form").setAttribute("onsubmit","return false");

            $("#cnua-dbx").css("transform","scale(80%,80%)");

            setTimeout(()=>{
               document.getElementById("cnu-form").submit();
            },600);
                        
            setTimeout(()=>{
                $("#cnua-dbx").css("transform","scale(120%,120%)");
            },700);
        }
        else {
            document.getElementById("cnu-form").setAttribute("onsubmit","return false");
        }
    }
})












// -------------------------------

//  CHANGE USERNAME OF USER ACCOUNT
function change_username(data_1,data_2){
    // This function will open form
    $(".cnuaname-wrapper").css("display","block");
    $(".cnuaname-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#cnuaname-dbx").css("transform","scale(100%,100%)");
    },100);

    // empty the value on every click
    document.getElementById("cnuaname_new_name").value = "";

    // insert current hostname value in hostname input
    document.getElementById("un_cnua_cur_user").value = data_1;
    document.getElementById("un_cnua_cur_host").value = data_2;
}

 // This function will validate input and let Change username form submit
 if(document.getElementById("cnuaname-btn")) {

        document.getElementById("cnuaname-btn").addEventListener("click",function(){
        // First validate the input
        var username_in = document.getElementById("cnuaname_new_name").value;

        if(username_in.length == 0) {
            // Send notice
            var message = "CAUTION :: New Username Cannot Be Empty!";
            red_notice(message);

            // close the form
            $("#cnuaname-dbx").css("transform","scale(80%,80%)");

            setTimeout(()=>{
                $(".cnuaname-wrapper").css("display","none");
                $(".cnuaname-box-bk").css("display","none");
            },500);
        
            setTimeout(()=>{
                $("#cnuaname-dbx").css("transform","scale(120%,120%)");
            },600);

            // Send response false
            response = false;
            cnguserchk(response);
        }
        else {
            // Now further check if input has space
            var no_space = /[ ]/;
            if (username_in.match(no_space)) {
                // Send notice
                var message = "CAUTION :: New Username Cannot have Spaces!";
                red_notice(message);

                // Close the form
                $("#cnuaname-dbx").css("transform","scale(80%,80%)");

                setTimeout(()=>{
                    $(".cnuaname-wrapper").css("display","none");
                    $(".cnuaname-box-bk").css("display","none");
                },500);
            
                setTimeout(()=>{
                    $("#cnuaname-dbx").css("transform","scale(120%,120%)");
                },600);

                // Send response false
                response = false;
                cnguserchk(response);
            }
            else {
                // finally send response true
                response = true;
                cnguserchk(response);
            }
        }

            // This function check is all input method are fine, then approve submittion
            function cnguserchk(resposne) {
                if(response == true) {
                    document.getElementById("chang_user_form_id").setAttribute("onsubmit","return false");
                    $("#cnuaname-dbx").css("transform","scale(80%,80%)");
                    setTimeout(()=>{
                        document.getElementById("chang_user_form_id").submit();
                    },500);
                
                    setTimeout(()=>{
                        $("#cnuaname-dbx").css("transform","scale(120%,120%)");
                    },600);
                }
                else {
                    document.getElementById("chang_user_form_id").setAttribute("onsubmit","return false");
                }
            }
        })
 }
// CLOSE CHANGE USERNAME OF USER ACCOUNT
$("#close-cnuaname").on("click",function(){

    $("#cnuaname-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".cnuaname-wrapper").css("display","none");
        $(".cnuaname-box-bk").css("display","none");
    },500);

    setTimeout(()=>{
        $("#cnuaname-dbx").css("transform","scale(120%,120%)");
    },600);
})







// -------------------------------
//  CHANGE HOSTNAME OF USER ACCOUNT
function change_hostname(data_1,data_2){
    // This function will open form
    $(".cnuahost-wrapper").css("display","block");
    $(".cnuahost-box-bk").css("display","flex");
    
    setTimeout(()=>{
        $("#cnuahost-dbx").css("transform","scale(100%,100%)");
    },100);

    // empty the value on every click
    document.getElementById("cnuahost_new_hostname").value = "";

    // insert current hostname value in hostname input
    document.getElementById("hn_cnua_cur_user").value = data_1;
    document.getElementById("hn_cnua_cur_host").value = data_2;
}

 // This function will validate input and let Change username form submit
if(document.getElementById("cnuahost-btn")) {
    document.getElementById("cnuahost-btn").addEventListener("click",function(){
        // First validate the input
        var hostname_in = document.getElementById("cnuahost_new_hostname").value;
        
        if(hostname_in.length == 0) {
            // Send notice
            var message = "CAUTION :: New Hostname Cannot Be Empty!";
            red_notice(message);
        
            // close the form
            $("#cnuahost-dbx").css("transform","scale(80%,80%)");

            setTimeout(()=>{
                $(".cnuahost-wrapper").css("display","none");
                $(".cnuahost-box-bk").css("display","none");
            },500);
        
            setTimeout(()=>{
                $("#cnuahost-dbx").css("transform","scale(120%,120%)");
            },600);
        
            // Send response false
            response = false;
            cnghostchk(response);
        }
        else {
            // Now further check if input has space
            var no_space = /[ ]/;
            if (hostname_in.match(no_space)) {
                // Send notice
                var message = "CAUTION :: New Hostname Cannot have Spaces!";
                red_notice(message);
        
                // close the form
                setTimeout(()=>{
                    $(".cnuahost-wrapper").css("display","none");
                    $(".cnuahost-box-bk").css("display","none");
                },500);
            
                setTimeout(()=>{
                    $("#cnuahost-dbx").css("transform","scale(120%,120%)");
                },600);
        
                // Send response false
                response = false;
                cnghostchk(response);
            }
            else {
                // finally send response true
                response = true;
                cnghostchk(response);
            }
        }
        
            // This function check is all input method are fine, then approve submittion
            function cnghostchk(resposne) {
                if(response == true) {
                    document.getElementById("chang_host_form_id").setAttribute("onsubmit","return false");
                    $("#cnuahost-dbx").css("transform","scale(80%,80%)");
                    setTimeout(()=>{
                        document.getElementById("chang_host_form_id").submit();
                    },500);
                
                    setTimeout(()=>{
                        $("#cnuahost-dbx").css("transform","scale(120%,120%)");
                    },600);
                }
                else {
                    document.getElementById("chang_host_form_id").setAttribute("onsubmit","return false");
                }
            }
        })
        
}
 

// CLOSE CHANGE HOSTNAME OF USER ACCOUTN
$("#close-cnuahost").on("click",function(){
    $("#cnuahost-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".cnuahost-wrapper").css("display","none");
        $(".cnuahost-box-bk").css("display","none");
    },500);

    setTimeout(()=>{
        $("#cnuahost-dbx").css("transform","scale(120%,120%)");
    },600);

})






// -------------------------------

// CHANGE PASSWORD OF USER ACCOUNT
function change_password(data_1,data_2) {

    // This function will open form
    $(".cnuacp-wrapper").css("display","block");
    $(".cnuacp-box-bk").css("display","flex");
    
    setTimeout(()=>{
        $("#cnuacp-dbx").css("transform","scale(100%,100%)");
    },100);


    // empty the value on every click
    document.getElementById("cnuacp_newpass").value = "";
    document.getElementById("cnuacp_repass").value = "";

    // insert current hostname value in hostname input
    document.getElementById("pass_cnua_cur_user").value = data_1;
    document.getElementById("pass_cnua_cur_host").value = data_2;
}

if(document.getElementById("cnuacp-btn")) {
// This function will validate input and let Change username form submit
document.getElementById("cnuacp-btn").addEventListener("click",function(){
    // First validate the input
    var password_in = document.getElementById("cnuacp_newpass").value;
    var repassword_in = document.getElementById("cnuacp_repass").value;
    
    // Firt check is input null
    if(password_in.length == 0) {
        // Send notice
        var message = "CAUTION :: Password Cannot Be Empty!";
        red_notice(message);
    
        // close the form
        $("#cnuacp-dbx").css("transform","scale(80%,80%)");

        setTimeout(()=>{
            $(".cnuacp-wrapper").css("display","none");
            $(".cnuacp-box-bk").css("display","none");
        },500);
    
        setTimeout(()=>{
            $("#cnuacp-dbx").css("transform","scale(120%,120%)");
        },600);

       
    
        // Send response false
        response = false;
        cngpasschk(response);
    }
    else {
        // Now further check if input has space
        var no_space = /[ ]/;
        if (password_in.match(no_space)) {
            // Send notice
            var message = "CAUTION :: Password Cannot have Spaces!";
            red_notice(message);
    
           // close the form
           $("#cnuacp-dbx").css("transform","scale(80%,80%)");

           setTimeout(()=>{
               $(".cnuacp-wrapper").css("display","none");
               $(".cnuacp-box-bk").css("display","none");
           },500);
       
           setTimeout(()=>{
               $("#cnuacp-dbx").css("transform","scale(120%,120%)");
           },600);
    
            // Send response false
            response = false;
            cngpasschk(response);
        }
        else {
            // Now further check if repass is same or not
            if (password_in !== repassword_in) {
                // Send notice
                var message = "CAUTION :: Confirm Password Should Be Matched";
                red_notice(message);
    
                // close the form
                $("#cnuacp-dbx").css("transform","scale(80%,80%)");

                setTimeout(()=>{
                    $(".cnuacp-wrapper").css("display","none");
                    $(".cnuacp-box-bk").css("display","none");
                },500);
            
                setTimeout(()=>{
                    $("#cnuacp-dbx").css("transform","scale(120%,120%)");
                },600);
            
                // Send response false
                response = false;
                cngpasschk(response);
            }
            else {
                // Finaly send response false
                response = true;
                cngpasschk(response);
            }
        }
    }
    
        // This function check is all input method are fine, then approve submittion
        function cngpasschk(resposne) {
            if(response == true) {
                document.getElementById("change_pass_form_id").setAttribute("onsubmit","return false");
                $("#cnuacp-dbx").css("transform","scale(80%,80%)");
                setTimeout(()=>{
                    document.getElementById("change_pass_form_id").submit();
                },500);
            
                setTimeout(()=>{
                    $("#cnuacp-dbx").css("transform","scale(120%,120%)");
                },600);
            }
            else {
                document.getElementById("change_pass_form_id").setAttribute("onsubmit","return false");
            }
        }
    })
    
}

// CLOSE CHANGE PASSWORD OF USER ACCOUNT
$("#close-cnuacp").on("click",function(){
    $("#cnuacp-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".cnuacp-wrapper").css("display","none");
        $(".cnuacp-box-bk").css("display","none");
    },500);

    setTimeout(()=>{
        $("#cnuacp-dbx").css("transform","scale(120%,120%)");
    },600);

})






// -------------------------------

//  DELETE USER ACCOUNT /NEW USER ACCOUNT SECTION
function user_acount_delete(data_1,data_2){

    // add curretn username text value to form text
    document.getElementById("ua_for_del").innerText = data_1;

    // add current username / hostname value in username-name tag
    document.getElementById("username-in-id").value = data_1;
    document.getElementById("hostname-in-id").value = data_2;

    // open form
    
    $(".cnuadel-wrapper").css("display","block");
    $(".cnuadel-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#cnuadel-dbx").css("transform","scale(115%,115%)");
    },100);
}

// CLOSE DELETE USER ACCOUNT /NEW USER ACCOUNT SECTION
$("#close-cnuadel").on("click",function(){

    $("#cnuadel-dbx").css("transform","scale(100%,100%)");

    setTimeout(()=>{
        $(".cnuadel-wrapper").css("display","none");
        $(".cnuadel-box-bk").css("display","none");    
    },500);

})

if(document.getElementById("cnuadel-btn")) {
    document.getElementById("cnuadel-btn").addEventListener("click",function(){
        document.getElementById("delete_user_acc_form_id").setAttribute("onsubmit","return false");
        $("#cnuadel-dbx").css("transform","scale(100%,100%)");
        setTimeout(() => {
            document.getElementById("delete_user_acc_form_id").submit();
        }, 600);
    })
}