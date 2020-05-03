<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Add A Patient</h2>";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    //input user info
    echo "<form method='post' action='addPatient.php'>";
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
            $stmt->execute(username);
            $row = $stmt->fetch();
            if(!isset($row['username'])){
                //if the username isn't taken
                $stmt = $conn->prepare("INSERT IGNORE INTO login_info (username, password) VALUES(:username, :password);
                INSERT IGNORE INTO Employee (username) VALUES(:username);");
                $stmt->bindValue(':username', $_POST['username']);
                $stmt->bindValue(':password', $_POST['password']);
                $stmt->execute();
                $_SESSION['result']='success';
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
        echo "Employee already has a username<br/>";
        echo "<a href='addUser.php'>Try again</a><br/>";
        echo "<a href='index.php'>Log In</a><br/>";
    }
    else if($_SESSION['result']=='UsernameTaken'){
        echo "Username taken. Please try another username<br/>";
        echo "<a href='addUser.php'>Try again</a><br/>";
        echo "<a href='index.php'>Log In</a><br/>";
    }
    else{
        echo "Error creating log in<br/>";
        echo "<a href='addUser.php'>Try again</a><br/>";
    }
}
?><?php
