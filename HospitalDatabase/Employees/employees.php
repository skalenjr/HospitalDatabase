<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Employees</h2>";

echo "<form method='get'>";
echo "<select name='job' onchange='this.form.submit();'>";
echo "<option value=''>View By Job</option>";
echo "<option value='All'> All Employees</option>";
echo "<option value='Doctors'> Doctors</option>";
echo "<option value='Nurses'> Nurses</option>";
    
echo "</select>";
echo "</form>";

if(!isset($_GET['job']) or $_GET['job']=='All'){
    $stmt = $conn->prepare("select Employee.eID, Person.first_name, Person.last_name from Employee, Person where Employee.SSN=Person.SSN;");
    $stmt->execute();
    
    echo "<table style='border: solid 1px black;'>";
    echo "<thead><tr><th>Employee ID</th><th>First name</th><th>Last name</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td><a href='employee.php?eID=$row[eID]'>$row[eID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
else if($_GET['job']=='Doctors'){
    $stmt = $conn->prepare("select Employee.eID, Person.first_name, Person.last_name from Employee, Person, Doctor where Employee.SSN=Person.SSN and Doctor.eID=Employee.eID;");
    $stmt->execute();
    
    echo "<table style='border: solid 1px black;'>";
    echo "<thead><tr><th>Employee ID</th><th>First name</th><th>Last name</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td><a href='employee.php?eID=$row[eID]'>$row[eID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
else if($_GET['job']=='Nurses'){
    $stmt = $conn->prepare("select Employee.eID, Person.first_name, Person.last_name from Employee, Person, Doctor where Employee.SSN=Person.SSN and Nurse.eID=Employee.eID;");
    $stmt->execute();
    
    echo "<table style='border: solid 1px black;'>";
    echo "<thead><tr><th>Employee ID</th><th>First name</th><th>Last name</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td><a href='employee.php?eID=$row[eID]'>$row[eID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
else{
    
}



?>