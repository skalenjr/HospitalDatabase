<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Employee Information</h2>";

if (isset($_GET['eID']) && $_SERVER['REQUEST_METHOD'] != 'POST')
{
    //give employee's information
    $eID = $_GET['eID'];
    $stmt = $conn->prepare("select Employee.eID, Employee.SSN, Person.first_name, Person.last_name, Person.address, Employee.hire_date, Employee.salary, Employee.job_title, Department.department_name from Person, Employee, Department where Person.SSN = Employee.SSN and Employee.eID = $_GET[eID] and Department.department_ID = Employee.department_ID");
    $stmt->execute();
    echo "<table width=900px style='border: solid 1px black;'>";
    echo "<thead><tr><th>Employee ID</th><th>SSN</th><th>First name</th><th>Last name</th><th>Job Title</th><th>Address</th><th>Hire Date</th><th>Salary</th><th>Department Name</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>$eID<td>$row[SSN]</td></td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[job_title]</td><td>$row[address]</td><td>$row[hire_date]</td><td>$row[salary]</td><td>$row[department_name]</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<a href='editEmployee.php?eID=$eID'>Edit Employee's Information</a><br/>";
    echo "<a href='employee.php'>View Another Employee's Information</a><br/>";
    unset($eID);
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