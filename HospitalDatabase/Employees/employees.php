<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Employees</h2>";

$stmt = $conn->prepare("select Employee.eID, Person.first_name, Person.last_name from Employee, Person where Employee.SSN=Person.SSN;");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Employee ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";
while ($row = $stmt->fetch()) {
    echo "<tr><td><a href='patient.php?eID=$row[eID]'>$row[eID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td></tr>";
}
echo "</tbody>";
echo "</table>";

?>