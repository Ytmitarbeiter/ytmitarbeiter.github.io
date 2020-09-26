function validateForm() {
    var un = document.loginform.username.value;
    var pw = document.loginform.password.value;
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