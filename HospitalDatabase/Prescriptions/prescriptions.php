<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Prescriptions</h2>";

$stmt = $conn->prepare("select prescriptionID, Prescription.pID, visitID, medication, directions, start_date, end_date from Prescription Person, Patient where Person.SSN = Patient.SSN order by Patient.pID");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Prescription ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";
while ($row = $stmt->fetch()) {
    echo "<tr><td><a href='prescription.php?pID=$row[prescriptionID]'>$row[prescriptionID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td></tr>";
}
echo "</tbody>";
echo "</table>";
​
?>