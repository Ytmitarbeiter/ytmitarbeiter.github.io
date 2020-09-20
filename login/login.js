url = "http://ytmitarbeiter.github.io/geo/";
var user = document.getElementById("username");
var passw = document.getElementById("passwort");
var pw = "123456789";
    function checkit() {
        if(passw == pw){
            alert("Das Passwort ist Richtig. Sie werden weitergeleit zu: " + url);
            window.location.href = url;
            }
            if(passw != pw) {
                alert("Falsch!")
            }
        }