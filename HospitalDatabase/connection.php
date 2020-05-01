<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "kalensn";
$password = "V00836202";
$database = "kalensn";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function checkLogIn(){
    if (!$_SERVER['logIn'] = TRUE){
        header("Location: ../index.php");
    }
}

checkLogIn();

?>