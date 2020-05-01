<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Edit Employee Information</h2>";


if (!isset($_GET['eID']) && $_SERVER['REQUEST_METHOD'] != 'POST')
{
    // Retrieve list of Employees
    $stmt = $conn->prepare("select Employee.eID, Person.first_name, Person.last_name from Person, Employee where Person.SSN = Employee.SSN order by Employee.eID");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='eID' onchange='this.form.submit();'>";
    echo "<option value='' selected disabled hidden>Choose Employee</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[eID]'>$row[first_name] $row[last_name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
}
else if($_SERVER['REQUEST_METHOD'] != 'POST'){
    //show current pateint information in form
    $eid = $_GET['eID'];
    $stmt = $conn->prepare("select Employee.eID, Person.SSN, Person.first_name, Person.last_name, Person.address, Employee.hire_date from Person, Employee where Person.SSN = Employee.SSN and Employee.eID = $_GET[eID]");
    $stmt->execute();
    $row = $stmt->fetch();
    
    echo "<form method='post' action='editEmployee.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Employee ID:</td><td>$row[eID]</td></tr>";
    echo "<tr><td>First Name</td><td><input name='first_name' type='text' size='15' value='$row[first_name]'></td></tr>";
    echo "<tr><td>Last Name</td><td><input name='last_name' type='text' size='15' value='$row[last_name]'></td></tr>";
    echo "<tr><td>Address</td><td><input name='Address' type='text' size='60' value='$row[address]'></td></tr>";
    echo "<tr><td>hire_date</td><td><input name='hire_date' type='text' size='8' value='$row[hire_date]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["eID"] = $eid;  
}
else{
    //send updated patient information
    try{
    $stmt = $conn->prepare("UPDATE Person SET Person.first_name=:first_name, Person.last_name=:last_name, address=:Address WHERE Person.SSN=:SSN; 
    UPDATE Employee SET Employee.hire_date=:hire_date where Employee.eid=:eID;");
    $stmt->bindValue(':first_name', $_POST['first_name']);
    $stmt->bindValue(':last_name', $_POST['last_name']);
    $stmt->bindValue(':Address', $_POST["Address"]);
    $stmt->bindValue(':hire_date', $_POST['hire_date']);
    $stmt->bindValue(':eID', $_SESSION["eID"]);
    $stmt->execute();
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    $eID = $_SESSION['eID'];
    echo "Employee Information Succesfully Updated<br/>";
    echo "<a href='employee.php?eID=$eID'>View Employee's information</a><br/>";
    echo "<a href='editEmployee.php'>Edit Another Employee's information</a><br/>";
    unset($pID);
    unset($_SESSION["eID"]);
    unset($_SESSION["SSN"]);
}
?>