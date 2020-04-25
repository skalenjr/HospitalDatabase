<?php

require_once('connection.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = file_get_contents("init.sql");
    $conn->exec($sql);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>