<?php

session_start();

require_once('initConnection.php');

echo "<h1><a href='index.php'>Hospital Database</a></h1>";
echo "<h2>Add A Patient</h2>";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    //input user info
    echo "<form method='post' action='addUser.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Employee's SSN</td><td><input name='SSN' type='text' size='25'></td></tr>";
    echo "<tr><td>Username</td><td><input name='username' type='text' size='25'></td></tr>";
    echo "<tr><td>Password</td><td><input name='password' type='text' size='25'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
}
else{
    try {
        $stmt = $conn->prepare("select username from Employee where Employee.SSN=:SSN");
        $stmt->bindValue(':SSN', $_POST['SSN']);
        $stmt->execute();
        $row = $stmt->fetch();
        if(!isset($row['username'])){
            //if the user doesn't already have a username
            $stmt = $conn->prepare("select username from login_info where username=:username");
            $stmt->bindValue(':username', $_POST['username']);
            $stmt->execute();
            $row = $stmt->fetch();
            if(!isset($row['username'])){
                //if the username isn't taken
                $_SESSION['hashedPassword'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $stmt = $conn->prepare("INSERT IGNORE INTO login_info (username, password) VALUES(:username, :password);
                UPDATE Employee SET Employee.username=:username WHERE Employee.SSN=:SSN;");
                $stmt->bindValue(':username', $_POST['username']);
                $stmt->bindValue(':password', $_SESSION['hashedPassword']);
                $stmt->bindValue(':SSN', $_POST['SSN']);
                $stmt->execute();
                $_SESSION['result']='success';
                unset($_SESSION['hashedPassword']);
            }
            else{
                $_SESSION['result']='UsernameTaken';
            }
        }
        else{
            $_SESSION['result']='HasUsername';
        }
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    if($_SESSION['result']=='success'){
        echo "Login Successfully Created!<br/>";
        echo "<a href='index.php'>Log In</a><br/>";
        unset($_SESSION['success']);
    }
    else if($_SESSION['result']=='HasUsername'){
        echo "Employee already has a username.<br/>";
        echo "<a href='addUser.php'>Try again</a><br/>";
    }
    else if($_SESSION['result']=='UsernameTaken'){
        echo "Username taken. Please try another username<br/>";
        echo "<a href='addUser.php'>Try again</a><br/>";
    }
    else{
        echo "Error creating log in.<br/>";
        echo "<a href='addUser.php'>Try again</a><br/>";
    }
}
?><?php
