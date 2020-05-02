<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Add An Employee</h2>";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    //input employee info
    echo "<form method='post' action='addEmployee.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>SSN</td><td><input name='SSN' type='text' size='11'></td></tr>";
    echo "<tr><td>Salary</td><td><input name='salary' type='text' size='10'></td></tr>";
    echo "<tr><td>Job Title</td><td><input name='job_title' type='text' size='25'></td></tr>";
    $stmt = $conn->prepare("SELECT department_id, department_name FROM Departments");
    $stmt->execute();
    echo "<select name='department_ID'>";
    echo "<option value='-1'>No department</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[department_ID]'>$row[department_name]</option>";
    }
    echo "</select>";
    echo "<tr><td>Address</td><td><input name='Address' type='text' size='50'></td></tr>";
    echo "<tr><td>Date Of Birth</td><td><input name='DOB' type='text' size='9'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
}
else{
    try {
        $stmt = $conn->prepare("INSERT IGNORE INTO Person (first_name, last_name, SSN, address, DOB) VALUES(:first_name, :last_name, :SSN, :Address, :DOB);
        INSERT IGNORE INTO Employee(SSN, hire_date, salary, department_ID, job_title) VALUES(:SSN, CURDATE(), :salary, :department_ID, :job_title);");
        $stmt->bindValue(':first_name', $_POST['first_name']);
        $stmt->bindValue(':last_name', $_POST['last_name']);
        $stmt->bindValue(':SSN', $_POST['SSN']);
        $stmt->bindValue(':salary', $_POST['salary']);
        $stmt->bindValue(':department_ID', $_POST['department_ID']);
        $stmt->bindValue(':job_title', $_POST['job_title']);
        $stmt->bindValue(':Address', $_POST['Address']);
        $stmt->bindValue(':DOB', $_POST['DOB']);
        $stmt->execute();
        $_SESSION['SSN'] = $_POST['SSN'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "Employee Succesfully Added<br/>";
    $stmt = $conn->prepare("select eID from Employee where SSN= $_SESSION[SSN];");
    $stmt->execute();
    $row = $stmt->fetch();
    echo "<a href='employee.php?eID=$row[eID]'>View employee's information</a><br/>";
    unset($_SESSION['SSN']);
}
?><?php
