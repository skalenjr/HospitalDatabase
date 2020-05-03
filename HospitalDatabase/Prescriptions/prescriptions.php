<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Prescriptions</h2>";

$stmt = $conn->prepare("select prescriptionID, medication, first_name, last_name from Prescription, Person, Patient where Person.SSN = Patient.SSN and Prescription.pID=Patient.pID order by prescriptionID");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Prescription ID</th><th>First name</th><th>Last name</th><th>Medication name</th></tr></thead>";
echo "<tbody>";
while ($row = $stmt->fetch()) {
    echo "<tr><td><a href='prescription.php?prescriptionID=$row[prescriptionID]'>$row[prescriptionID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[medication]</td></tr>";
}
echo "</tbody>";
echo "</table>";
?>