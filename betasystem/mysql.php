<?php
/////////////////////////////////////////////////
// Do you want to use this plugin in cracked mode?
/////////////////////////////////////////////////
$cracked = true;
/////////////////////////////////////////////////
// Setting up the mysql database!
/////////////////////////////////////////////////
$host = "db4free.net";
$name = "ytmitarbeiter";
$user = "ytmitarbeiter";
$passwort = "Passwort1234";
/////////////////////////////////////////////////
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>
