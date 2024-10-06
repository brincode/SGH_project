$(document).ready(function(){
    document.getElementById("logout-button").onclick= function(){
        logout();
    };
    document.getElementById("new-user").onblur = function(){
        userValidity();
    };
    document.getElementById("new-pass").onblur= function(){
        passwordValidity();
    };
    document.getElementById("pass-check").onblur = function(){
        passwordValidity();
    };
    document.getElementById("new-form").onsubmit = function(){
        return checkAll();
    };
});



function collapseNav(){
    var navbar=document.getElementById("myNavbar");
    navbar.classList.remove("in");
    //navbar.classList.remove("collapse");
    navbar.setAttribute("aria-expanded","false");
}

function toggleUtil(status){
    var utilName=status.id;
    var textName="text-"+utilName;
    var sumName="summary-"+utilName;

    var text=document.getElementById(textName);
    var sum=document.getElementById(sumName);
    //alert(text.innerHTML);
    if(status.innerText == 'ON'){
        //turn off
        status.innerText='OFF';
        status.classList.remove("util-on");
        status.classList.add("util-off");
        text.innerText='OFF';
        text.classList.remove("util-on");
        text.classList.add("util-off");
        sum.innerText='OFF';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "ajax/utility-ajax.php?utility=" + utilName +"&status=OFF", true);
        xmlhttp.send();
    }else{
        //turn on
        status.innerText='ON';
        status.classList.remove("util-off");
        status.classList.add("util-on");
        text.innerText='ON';
        text.classList.remove("util-off");
        text.classList.add("util-on");
        sum.innerText='ON';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "ajax/utility-ajax.php?utility=" + utilName +"&status=ON", true);
        xmlhttp.send();
    }
}

function logout(){
    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location = "login.php";
}

function userValidity(){
    var text= document.getElementById("new-user");
    var username=encodeURIComponent(text.value);
    if (username.length == 0) {
        text.classList.remove("recheck");
        text.classList.remove("valid");
        text.setAttribute("title","");
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                if(this.responseText=="Fail"){
                    
                    text.classList.add("recheck");
                    text.classList.remove("valid");
                    text.setAttribute("title","Username already exists");
                }else{
                    
                    text.classList.add("valid");
                    text.classList.remove("recheck");
                    text.setAttribute("title","Username can be used");
                }
            }
        };
        xmlhttp.open("GET", "ajax/username-ajax.php?q=" + username, true);
        xmlhttp.send();
    }
}

function passwordValidity(){
    var pass1=document.getElementById("new-pass");
    var pass2=document.getElementById("pass-check");
    if(pass1.value==pass2.value){
        pass1.classList.add("valid");
        pass1.classList.remove("recheck");
        pass1.setAttribute("title","");
    }else{
        pass1.classList.add("recheck");
        pass1.classList.remove("valid");
        pass1.setAttribute("title","Please recheck");
    }
}

function deleteUser(username,deleter){
    if(confirm("Are you sure to delete "+username+"?")){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                document.getElementById(username).outerHTML="";
            }
        };
        xmlhttp.open("GET", "ajax/delete-ajax.php?q=" + username + "&r=" + deleter, true);
        xmlhttp.send();
    }
}

function checkAll(){
    if(document.getElementsByClassName("recheck")[0]){
        alert("Please recheck the username and password");
        return false;
    }
        
    else
        alert("User added successfully");
        return true;
}
