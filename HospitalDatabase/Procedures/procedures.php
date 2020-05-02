<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Procedures</h2>";

$stmt = $conn->prepare("select Procedures.procedureID, Person.first_name, Person.last_name, from Person, Patient, Procedures where Procedures.pID = Patient.pID and Person.SSN = Patient.SSN order by Procedure.procedureID");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Procedure ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";
while ($row = $stmt->fetch()) {
    echo "<tr><td><a href='patient.php?pID=$row[procedureID]'>$row[procedureID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td></tr>";
}
echo "</tbody>";
echo "</table>";

?>