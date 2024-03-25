function logOutType(userType){
    if(userType == "User"){
        document.querySelector('.usersignOut').style.display="block";
    } else{
        document.querySelector('.adminsignOut').style.display="block";
    }
}
function backUser(){
    document.querySelector('.usersignOut').style.display="none";
}
function backAdmin(){
    document.querySelector('.adminsignOut').style.display="none";
}
function logOut(){
    console.log("Kingi");
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
                window.location.replace("Log-Out.php");
            } 
        }
    xhr.open("POST", "Log-Out.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();
}

