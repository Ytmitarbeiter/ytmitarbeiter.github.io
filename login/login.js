function validateForm() {
    var un = document.getElementById("username").value;
    var pw = document.getElementById("passwort").value;
    var lb = document.getElementsByClassName("btn");
    var username = "username"; 
    var password = "password";
    if ((un == username) && (pw == password)) {
        window.location = "success.html";
        return false;
    }
    else {
        alert ("Login was unsuccessful, please check your username and password");
    }
  }