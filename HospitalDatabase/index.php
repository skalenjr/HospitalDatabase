<?php
require_once('initConnection.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    echo "<h1>Hospital Database</h1>";
    echo "<h2>Login</h2>";
    echo "<form method='post' action='index.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Username</td><td><input name='username' type='text' size='15'></td></tr>";
    echo "<tr><td>Password</td><td><input name='password' type='password' size='15'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "<input type='submit' name='submit' value='Sign in'>";
    echo "</form>";
}
else{
    
    try{
        
        $_SESSION["hashedPassword"] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        echo password_hash('password', PASSWORD_BCRYPT);
        
        $STMT = $conn->prepare("select username from login_info where username = :username");
        $STMT->bindValue(':username', $_POST['username']);
        $STMT->execute();
        $row = $STMT-> fetch();
        
        if($row != NULL){
            $STMT = $conn->prepare("select password from login_info where username = :username");
            $STMT->bindValue(':username', $_POST['username']);
            $STMT->execute();           
            $row = $STMT-> fetch();
            if(password_verify($_POST['password'], $row[password])) {        
                unset ($_SESSION["hashedPassword"]);
                $_SERVER['LogIn']=True;
                header("Location: hospitaldatabase.php");
            } 
            else{
                unset ($_SESSION["hashedPassword"]);
                echo "Password Incorrect";
                echo "<br /><a href='index.php'>Try again</a>";
                
            }
        }
        else{
            unset ($_SESSION["hashedPassword"]);
            echo "Username Incorrect";
            echo "<br /><a href='index.php'>Try again</a>";
        }
        
    } catch (PDOException $e) {
        unset ($_SESSION["hashedPassword"]);
        echo "Error: " . $e->getMessage();
    }
}
?>