<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Employee Information</h2>";

if (isset($_GET['eID']))
{
    //give employee's information
    $stmt = $conn->prepare("select Employee.eID, Employee.SSN, Person.first_name, Person.last_name, Person.address, Employee.hire_date from Person, Employee where Person.SSN = Employee.SSN and Employee.eID = $_GET[eID]");
    $stmt->execute();
    
    echo "<table style='border: solid 1px black;'>";
    echo "<colgroup> <col span='1' style=width:'20%'><col span='1' style=width:'20%'><col span='1' style=width:'20%'><col span='1' style=width:'20%'><col span='1' style=width:'20%'></colgroup>";
    echo "<thead><tr><th>Employee ID</th><th>SSN</th><th>First name</th><th>Last name</th><th>Address</th><th>Hire Date</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>$row[eID]<td>$row[SSN]</td></td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[address]</td><td>$row[hire_date]</td></tr>";
        $eID = $row['eID'];
    }
    echo "</tbody>";
    echo "</table>";
    echo "<a href='editEmployee.php?pID=$eID'>Edit Employee's Information</a><br/>";
}
else {
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
?>