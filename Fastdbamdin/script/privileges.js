// LAST UPDATED 12 Oct
// Grant User Privileges Section
// console.log("Privileges Script Running...");

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





// Grant Privileges
$("#grant-priv-btn").on("click",function(){
    $(".priv-gran-wrapper").css("display","block");
    $(".priv-gran-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#priv-gran-dbx").css("transform","scale(100%,100%)");
    },100)
})

$("#close-priv-gran").on("click",function(){
    $("#priv-gran-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".priv-gran-wrapper").css("display","none");
        $(".priv-gran-box-bk").css("display","none");
    },600)

    setTimeout(()=>{
        $("#priv-gran-dbx").css("transform","scale(105%,105%)");
    },700)
    
})

// Revoke privileges
$("#revok-priv-btn").on("click",function(){
    $(".priv-revok-wrapper").css("display","block");
    $(".priv-revok-box-bk").css("display","flex");

    setTimeout(()=>{
        $("#priv-revok-dbx").css("transform","scale(100%,100%)");
    },100)
})

$("#close-priv-revok").on("click",function(){
    $("#priv-revok-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".priv-revok-wrapper").css("display","none");
        $(".priv-revok-box-bk").css("display","none");
    },500)
    
    setTimeout(()=>{
        $("#priv-revok-dbx").css("transform","scale(105%,105%)");
    },600)
})

// Click to all grante check box and desable all other check boxes
function grant_all_priv(data_1,data_2) {
    
    // if click on all grant priv the change action of form
    document.getElementById("grant-all-priv-form-id").setAttribute("action","granting_all_privileges.php");
    document.getElementById("i_cur_username_grant_all_priv").value = data_1;
    document.getElementById("i_cur_hostname_grant_all_priv").value = data_2;
   
    var mainbox = document.getElementById("all-priv-in-chkbox");

    if(mainbox.checked == true) {

        document.getElementById("data-box-chkbx-id-1").setAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-id-2").setAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-id-3").setAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-id-4").setAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-id-5").setAttribute("disabled","disabled");

        document.getElementById("role-box-chkbx-id-1").setAttribute("disabled","disabled");
        document.getElementById("role-box-chkbx-id-2").setAttribute("disabled","disabled");

        document.getElementById("structure-box-chkbx-id-1").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-2").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-3").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-4").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-5").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-6").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-7").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-8").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-9").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-10").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-11").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-12").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-13").setAttribute("disabled","disabled");

        document.getElementById("admin-box-chkbx-id-1").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-2").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-3").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-4").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-5").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-6").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-7").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-8").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-9").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-10").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-11").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-12").setAttribute("disabled","disabled");
    }
    else {

        document.getElementById("data-box-chkbx-id-1").removeAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-id-2").removeAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-id-3").removeAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-id-4").removeAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-id-5").removeAttribute("disabled","disabled");

        document.getElementById("role-box-chkbx-id-1").removeAttribute("disabled","disabled");
        document.getElementById("role-box-chkbx-id-2").removeAttribute("disabled","disabled");

        document.getElementById("structure-box-chkbx-id-1").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-2").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-3").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-4").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-5").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-6").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-7").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-8").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-9").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-10").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-11").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-12").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-id-13").removeAttribute("disabled","disabled");

        document.getElementById("admin-box-chkbx-id-1").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-2").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-3").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-4").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-5").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-6").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-7").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-8").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-9").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-10").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-11").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-id-12").removeAttribute("disabled","disabled");
    }
}


// Stop submission if none privilege is checked
// make by default submission off
if(document.getElementById("grant-all-priv-form-id")) {
    document.getElementById("grant-all-priv-form-id").setAttribute("onsubmit","return false");
}
if(document.getElementById("priv-gran-btn")) {
    document.getElementById("priv-gran-btn").addEventListener("click",function(){

        // check if any one checkbox if checked 
        // store checkbox node in var
        var checkbx_1 = document.getElementById("all-priv-in-chkbox");
    
        var checkbx_2 = document.getElementById("data-box-chkbx-id-1");
        var checkbx_3 = document.getElementById("data-box-chkbx-id-2");
        var checkbx_4 = document.getElementById("data-box-chkbx-id-3");
        var checkbx_5 = document.getElementById("data-box-chkbx-id-4");
        var checkbx_6 = document.getElementById("data-box-chkbx-id-5");
    
        var checkbx_61 = document.getElementById("role-box-chkbx-id-1");
        var checkbx_62 = document.getElementById("role-box-chkbx-id-2");
    
        var checkbx_7 = document.getElementById("structure-box-chkbx-id-1");
        var checkbx_8 = document.getElementById("structure-box-chkbx-id-2");
        var checkbx_9 = document.getElementById("structure-box-chkbx-id-3");
        var checkbx_10 = document.getElementById("structure-box-chkbx-id-4");
        var checkbx_11 = document.getElementById("structure-box-chkbx-id-5");
        var checkbx_12 = document.getElementById("structure-box-chkbx-id-6");
        var checkbx_13 = document.getElementById("structure-box-chkbx-id-7");
        var checkbx_14 = document.getElementById("structure-box-chkbx-id-8");
        var checkbx_15 = document.getElementById("structure-box-chkbx-id-9");
        var checkbx_16 = document.getElementById("structure-box-chkbx-id-10");
        var checkbx_17 = document.getElementById("structure-box-chkbx-id-11");
        var checkbx_18 = document.getElementById("structure-box-chkbx-id-12");
        var checkbx_81 = document.getElementById("structure-box-chkbx-id-13");
    
        var checkbx_19 = document.getElementById("admin-box-chkbx-id-1");
        var checkbx_20 = document.getElementById("admin-box-chkbx-id-2");
        var checkbx_21 = document.getElementById("admin-box-chkbx-id-3");
        var checkbx_22 = document.getElementById("admin-box-chkbx-id-4");
        var checkbx_23= document.getElementById("admin-box-chkbx-id-5");
        var checkbx_24 = document.getElementById("admin-box-chkbx-id-6");
        var checkbx_25= document.getElementById("admin-box-chkbx-id-7");
        var checkbx_26= document.getElementById("admin-box-chkbx-id-8");
        var checkbx_27= document.getElementById("admin-box-chkbx-id-9");
        var checkbx_28= document.getElementById("admin-box-chkbx-id-10");
        var checkbx_29= document.getElementById("admin-box-chkbx-id-11");
        var checkbx_30 = document.getElementById("admin-box-chkbx-id-12");
    
    
        if(
            checkbx_1.checked || checkbx_2.checked || 
            checkbx_3.checked || checkbx_4.checked || 
            checkbx_5.checked || checkbx_6.checked || 
            checkbx_7.checked || checkbx_8.checked || 
            checkbx_9.checked || checkbx_10.checked || 
            checkbx_11.checked || checkbx_12.checked || 
            checkbx_13.checked || checkbx_14.checked || 
            checkbx_15.checked || checkbx_16.checked || 
            checkbx_17.checked || checkbx_18.checked || 
            checkbx_19.checked || checkbx_20.checked || 
            checkbx_21.checked || checkbx_22.checked || 
            checkbx_23.checked || checkbx_24.checked || 
            checkbx_25.checked || checkbx_26.checked || 
            checkbx_27.checked || checkbx_28.checked || 
            checkbx_29.checked || checkbx_30.checked ||
            checkbx_61.checked || checkbx_62.checked || checkbx_81.checked == true
        )
        {
            document.getElementById("grant-all-priv-form-id").setAttribute("onsubmit","return false");
            $("#priv-gran-dbx").css("transform","scale(80%,80%)");
            setTimeout(()=>{
                // if we dont click on submit button then submit name value will be null
                document.getElementById("grant-all-priv-form-id").submit();
            },500)

            setTimeout(()=>{
                $("#priv-gran-dbx").css("transform","scale(105%,105%)");
            },700)
        }
        else {
            document.getElementById("grant-all-priv-form-id").setAttribute("onsubmit","return false");
    
            // Close form
            $("#priv-gran-dbx").css("transform","scale(80%,80%)");

            setTimeout(()=>{
                $(".priv-gran-wrapper").css("display","none");
                $(".priv-gran-box-bk").css("display","none");
            },600)

            setTimeout(()=>{
                $("#priv-gran-dbx").css("transform","scale(105%,105%)");
            },700)
    
            // notice
            var message = "CAUTION :: Please Select At Least Privileges To Proceed Operation.";
            red_notice(message);
        }
    })
    
}


// Red Notice 
function redNoticeUa(message) {
    document.getElementById('notice-red-ua').style.display = 'block';
    document.getElementById('red-text-ua').innerHTML = message;

    // Hide notice dailog after 5 sec
    setTimeout(()=>{
        document.getElementById('notice-red-ua').style.display = 'none';
    },4000);
}









//============================ REVOKE PRIVILEGES =================================//

// Click to all grante check box and desable all other check boxes
function revoke_all_priv(data_1,data_2) {
    
    // if click on all revoke priv the change action of form
    document.getElementById("revoke-all-priv-form-id").setAttribute("action","../home/revoking_all_privileges.php");
    document.getElementById("i_cur_username_revoke_all_priv").value = data_1;
    document.getElementById("i_cur_hostname_revoke_all_priv").value = data_2;
   
    var mainbox = document.getElementById("revoke-all-id-chkbx");

    if(mainbox.checked == true) {

        document.getElementById("data-box-chkbx-rv-id-1").setAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-rv-id-2").setAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-rv-id-3").setAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-rv-id-4").setAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-rv-id-5").setAttribute("disabled","disabled");

        document.getElementById("role-box-chkbx-rv-id-1").setAttribute("disabled","disabled");
        document.getElementById("role-box-chkbx-rv-id-2").setAttribute("disabled","disabled");

        document.getElementById("structure-box-chkbx-rv-id-1").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-2").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-3").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-4").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-5").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-6").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-7").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-8").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-9").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-10").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-11").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-12").setAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-13").setAttribute("disabled","disabled");

        document.getElementById("admin-box-chkbx-rv-id-1").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-2").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-3").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-4").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-5").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-6").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-7").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-8").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-9").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-10").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-11").setAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-12").setAttribute("disabled","disabled");
    }
    else {

        document.getElementById("data-box-chkbx-rv-id-1").removeAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-rv-id-2").removeAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-rv-id-3").removeAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-rv-id-4").removeAttribute("disabled","disabled");
        document.getElementById("data-box-chkbx-rv-id-5").removeAttribute("disabled","disabled");

        document.getElementById("role-box-chkbx-rv-id-1").removeAttribute("disabled","disabled");
        document.getElementById("role-box-chkbx-rv-id-2").removeAttribute("disabled","disabled");

        document.getElementById("structure-box-chkbx-rv-id-1").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-2").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-3").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-4").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-5").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-6").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-7").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-8").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-9").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-10").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-11").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-12").removeAttribute("disabled","disabled");
        document.getElementById("structure-box-chkbx-rv-id-13").removeAttribute("disabled","disabled");

        document.getElementById("admin-box-chkbx-rv-id-1").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-2").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-3").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-4").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-5").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-6").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-7").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-8").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-9").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-10").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-11").removeAttribute("disabled","disabled");
        document.getElementById("admin-box-chkbx-rv-id-12").removeAttribute("disabled","disabled");
    }
    
}


// Stop submission if none privilege is checked
// make by default submission off
if(document.getElementById("revoke-all-priv-form-id")) {
    document.getElementById("revoke-all-priv-form-id").setAttribute("onsubmit","return false");
}

if(document.getElementById("priv-revok-btn")) {
    document.getElementById("priv-revok-btn").addEventListener("click",function(){
        // check if any one checkbox if checked 
        // store checkbox node in var
        var checkbx_1 = document.getElementById("revoke-all-id-chkbx");
    
        var checkbx_2 = document.getElementById("data-box-chkbx-rv-id-1");
        var checkbx_3 = document.getElementById("data-box-chkbx-rv-id-2");
        var checkbx_4 = document.getElementById("data-box-chkbx-rv-id-3");
        var checkbx_5 = document.getElementById("data-box-chkbx-rv-id-4");
        var checkbx_6 = document.getElementById("data-box-chkbx-rv-id-5");
    
        var checkbx_61 = document.getElementById("role-box-chkbx-rv-id-1");
        var checkbx_62 = document.getElementById("role-box-chkbx-rv-id-2");
    
        var checkbx_7 = document.getElementById("structure-box-chkbx-rv-id-1");
        var checkbx_8 = document.getElementById("structure-box-chkbx-rv-id-2");
        var checkbx_9 = document.getElementById("structure-box-chkbx-rv-id-3");
        var checkbx_10 = document.getElementById("structure-box-chkbx-rv-id-4");
        var checkbx_11 = document.getElementById("structure-box-chkbx-rv-id-5");
        var checkbx_12 = document.getElementById("structure-box-chkbx-rv-id-6");
        var checkbx_13 = document.getElementById("structure-box-chkbx-rv-id-7");
        var checkbx_14 = document.getElementById("structure-box-chkbx-rv-id-8");
        var checkbx_15 = document.getElementById("structure-box-chkbx-rv-id-9");
        var checkbx_16 = document.getElementById("structure-box-chkbx-rv-id-10");
        var checkbx_17 = document.getElementById("structure-box-chkbx-rv-id-11");
        var checkbx_18 = document.getElementById("structure-box-chkbx-rv-id-12");
        var checkbx_181 = document.getElementById("structure-box-chkbx-rv-id-13");
    
        var checkbx_19 = document.getElementById("admin-box-chkbx-rv-id-1");
        var checkbx_20 = document.getElementById("admin-box-chkbx-rv-id-2");
        var checkbx_21 = document.getElementById("admin-box-chkbx-rv-id-3");
        var checkbx_22 = document.getElementById("admin-box-chkbx-rv-id-4");
        var checkbx_23= document.getElementById("admin-box-chkbx-rv-id-5");
        var checkbx_24 = document.getElementById("admin-box-chkbx-rv-id-6");
        var checkbx_25= document.getElementById("admin-box-chkbx-rv-id-7");
        var checkbx_26= document.getElementById("admin-box-chkbx-rv-id-8");
        var checkbx_27= document.getElementById("admin-box-chkbx-rv-id-9");
        var checkbx_28= document.getElementById("admin-box-chkbx-rv-id-10");
        var checkbx_29= document.getElementById("admin-box-chkbx-rv-id-11");
        var checkbx_30 = document.getElementById("admin-box-chkbx-rv-id-12");
    
    
        if(
            checkbx_1.checked || checkbx_2.checked || 
            checkbx_3.checked || checkbx_4.checked || 
            checkbx_5.checked || checkbx_6.checked || 
            checkbx_7.checked || checkbx_8.checked || 
            checkbx_9.checked || checkbx_10.checked || 
            checkbx_11.checked || checkbx_12.checked || 
            checkbx_13.checked || checkbx_14.checked || 
            checkbx_15.checked || checkbx_16.checked || 
            checkbx_17.checked || checkbx_18.checked || 
            checkbx_19.checked || checkbx_20.checked || 
            checkbx_21.checked || checkbx_22.checked || 
            checkbx_23.checked || checkbx_24.checked || 
            checkbx_25.checked || checkbx_26.checked || 
            checkbx_27.checked || checkbx_28.checked || 
            checkbx_29.checked || checkbx_30.checked  || 
            checkbx_61.checked || checkbx_62.checked || checkbx_181.checked == true
        )
        {
            document.getElementById("revoke-all-priv-form-id").setAttribute("onsubmit","return false");

            $("#priv-revok-dbx").css("transform","scale(80%,80%)");

            setTimeout(()=>{
                // if we dont click on submit button then submit name value will be null
                document.getElementById("revoke-all-priv-form-id").submit();
            },500)

            setTimeout(()=>{
                $("#priv-revok-dbx").css("transform","scale(105%,105%)");
            },700)
        }
        else {
            document.getElementById("revoke-all-priv-form-id").setAttribute("onsubmit","return false");
    
            // Close form
            $("#priv-revok-dbx").css("transform","scale(80%,80%)");

            setTimeout(()=>{
                // if we dont click on submit button then submit name value will be null
                $(".priv-revok-wrapper").css("display","none");
                $(".priv-revok-box-bk").css("display","none");
            },500)

            setTimeout(()=>{
                $("#priv-revok-dbx").css("transform","scale(105%,105%)");
            },600)

            // notice
            var message = "CAUTION :: Please Select At Least Privileges To Proceed Operation.";
            red_notice(message);
        }
    })
    
}


// Red Notice 
function redNoticeUa(message) {
    document.getElementById('notice-red-ua').style.display = 'block';
    document.getElementById('red-text-ua').innerHTML = message;

    // Hide notice dailog after 5 sec
    setTimeout(()=>{
        document.getElementById('notice-red-ua').style.display = 'none';
    },6000);
}


// Resource Limit 
if(document.getElementById("resource-limit-btn")) {
    document.getElementById("resource-limit-btn").addEventListener("click",function(){
        $(".resource-wrapper").css("display","block");
        $(".resource-box-bk").css("display","flex");
        
        setTimeout(()=>{
            $("#resource-dbx").css("transform","scale(100%,100%)");
        },100);
    })
}


$("#close-resource").on("click",function(){
    $("#resource-dbx").css("transform","scale(80%,80%)");

    setTimeout(()=>{
        $(".resource-wrapper").css("display","none");
        $(".resource-box-bk").css("display","none");
    },500);

    setTimeout(()=>{
       $("#resource-dbx").css("transform","scale(120%,120%)");
    },600);  
})

if(document.getElementById("resource-submit-button")) {
    document.getElementById("resource-submit-button").addEventListener("click",function(){
        $("#resource-dbx").css("transform","scale(80%,80%)");
        document.getElementById("resource-form-id").setAttribute("onsubmit","return false");
        setTimeout(()=>{
            document.getElementById("resource-form-id").submit();
        },500);
    
        setTimeout(()=>{
           $("#resource-dbx").css("transform","scale(120%,120%)");
        },600);  
    })
}