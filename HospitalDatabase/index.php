<?php
require_once('connection.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    echo "<h1>Login</h1>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Username</td><td><input name='username' type='text' size='25'></td></tr>";
    echo "<tr><td>Password</td><td><input name='password' type='text' size='25'></td></tr>";
    echo "<button type='submit' name='submit'>Submit</button>";
    
    $_SESSION["hashedPassword"] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $STMT = $conn->prepare("select * from login_info where username = :user_name");
    $STMT->bindValue(':user_name', $_POST['username']);
    
    $STMT->execute();
    
    $row = $STMT-> fetch();
    
    if(password_verify($_SESSION["hashedPassword"], $row['password'])) {        
        unset ($_SESSION["hashedPassword"]);
        header("Location: hospitalDatabase.php");
    } 
    else{
        echo "Password Incorrect";
    }
    
    unset ($_SESSION["hashedPassword"]);
}
?>