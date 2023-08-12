// Login page javascript page
// Last updated 30 Sep

// console.log("External script working fine");

// LOADING SECTION
function offloader() {
    $("#load-box").css("display","none");
}

// RED Notice function 

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
    },6000);

    setTimeout(() => {
        document.getElementById("notice-red").style.transform = "scale(100%,100%)";
        document.getElementById("red-notice-wrapper").style.display = "none";
    },7000);
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
        
    },6000);

    setTimeout(() => {
        document.getElementById("notice-green").style.transform = "scale(100%,100%)";
        document.getElementById("green-notice-wrapper").style.display = "none";
    },7000);
}



// Login Form Validation
document.getElementById("main_form").setAttribute("onsubmit","return false");
    document.getElementById("submit-btn").addEventListener("click",function(){

    // Declare variabe null initially
    var server_type = "";
    var username = "";
    var hostname = "";
    var password = "";

    // Get iput values
    var server_type = document.getElementById("server_typeid").value;
    var hostname = document.getElementById("hostname_id").value;
    var username = document.getElementById("username_id").value;
    var password = document.getElementById("password_id").value;
    
    // #1 :: Check Server Type
    if(server_type == "none") {
      
        // Send response to log function
        var response_11 = false;
        log(response_11);

        // Send error to notice function
        var message = "Please Select A Compatible Server!!";
        red_notice(message);
    }
    else {
        var response_11 = true;
        log(response_11);

        // #2 Check hostname null
        // Should no null
        if(hostname.length == 0) {

            // Send response to log function
            var response_21 = false;
            log(response_21);

            // Send error to notice funtion
            var message = "Hostname Input Field Cannot Be Empty!";
            red_notice(message);
        }
        else {
            var response_21 = true;
            log(response_21);

            // #3 :: Check Hostname Space 
            var nospace =  /[ ]/;;
            if(hostname.match(nospace)) {

                // Send response to log function
                var response_22 = false;
                log(response_22);

                // Send error to notice funtion
                var message = "Hostname Should Not Have Spaces!";
                red_notice(message);
            }
            else {
                var response_22 = true;
                log(response_22);

                // #4 :: Check not between 1-3
                if((hostname.length <= 3) && (hostname.length >= 1)) {

                    // Send response to log function
                    var response_23 = false;
                    log(response_23);

                    // Send error to notice funtion
                    var message = "Hostname Input Value Should Not Be Less Than 4 Characters Long!";
                    red_notice(message);
                }
                else {
                    var response_23 = true;
                    log(response_23);

                    // #5 :: Check more than 20 chars
                    // Should not be more than 20 
                    if(hostname.length >= 20) {

                        // Send response to log function
                        var response_24 = false;
                        log(response_24);

                        // Send error to notice funtion
                        var message = "Hostname Input Should Not Be More Than 20 Character Long!";
                        red_notice(message);
                    }
                    else {
                        var response_24 = true;
                        log(response_24)

                        // #6 :: Check username null
                        if(username.length == 0) {

                            // Send response to log function
                            var response_31 = false;
                            log(response_31);
            
                            // Send error to notice funtion
                            var message = "Username Input Field Should Not Be Empty!";
                            red_notice(message);
                        }
                        else {
                            var response_31 = true;
                            log(response_31);

                            // #7 :: Check space
                            var noSpace =   /[ ]/;
                            if(username.match(noSpace)) {

                                // Send resposne to log function
                                var response_34 = false;
                                log(response_34);

                                // Send error to notice funtion
                                var message = "Username Input Field Should Not Have Space!";
                                red_notice(message);
                            }
                            else {
                                var response_34 = true;
                                log(response_34);

                                // #8 :: Chack 1-3
                                if((username.length <= 3) && (username.length >= 1)) {

                                    // Send response to log function
                                    var response_32 = false;
                                    log(response_32);

                                    // Send error to notice funtion
                                    var message = "Username Input Field Should Not Be Less Than 4 Characters Long!";
                                    red_notice(message);
                                }
                                else {
                                    var response_32 = true;
                                    log(response_32);

                                    // #9 :: Check more than 30
                                    if(username.length >= 30) {

                                        // Send response to log function
                                        var response_33 = false;
                                        log(response_33);

                                        // Send error to notice funtion
                                        var message = "Username Input Field Should Not Be More Than 20 Characters Long!!";
                                        red_notice(message);
                                    }
                                    else {
                                        var response_33 = true;
                                        log(response_33);

                                        // #:10  Check password
                                        // Password can be null
                                        // Password should not more than 25
                                        if(password.length >= 25) {
                                        
                                            // Send response to log function
                                            var response_41 = false;
                                            log(response_41);

                                            // Send error to notice funtion
                                            var message = "Password Input Field Cannot Be More Than 25 Characters Long!";
                                            red_notice(message);
                                        }
                                        else {
                                            var response_41 = true;
                                            log(response_41);

                                            // # :: 11 Check password space
                                            var pass_space = /[ ]/;
                                            if(password.match(pass_space)) {

                                                // Send response to log function
                                                var response_42 = false;
                                                log(response_42)

                                                // Send error to notice funtion
                                                var message = "Password Input Field Should Not Have Space!!";
                                                red_notice(message);
                                            }
                                            else {
                                                var response_42 = true;
                                                log(response_42);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    

    // log function
    function log(response) {
        if(response_11 && response_21 && response_22 && response_23 && response_31 &&response_32 & response_33
        && response_34 && response_41 && response_42 == true) {

            // Notice Dailog 
            var message = "Successfully Logging...";
            green_notice(message);

            setTimeout(()=>{
                document.getElementById("main_form").submit();
            },2000)
        }
        else {
        document.getElementById("main_form").setAttribute("onsubmit","return false");
        }
    }
})


