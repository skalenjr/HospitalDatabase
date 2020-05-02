<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Visits</h2>";

$stmt = $conn->prepare("select Visit.visitID, Visit.visit_date, Person.first_name, Person.last_name from Person, Patient, Visit where Visit.pID=Patient.pID and Person.SSN = Patient.SSN order by Visit.visitID");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Visit ID</th><th>First name</th><th>Last name</th><th>Date</th></tr></thead>";
echo "<tbody>";
while ($row = $stmt->fetch()) {
    echo "<tr><td><a href='visit.php?visitID=$row[visitID]'>$row[visitID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[visit_date]</td></tr>";
}
echo "</tbody>";
echo "</table>";

?>