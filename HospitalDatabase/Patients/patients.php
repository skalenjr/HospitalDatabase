<?php

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Patients</h2>";

$stmt = $conn->prepare("select Patient.pID, Person.first_name, Person.last_name from Person, Patient where Person.SSN = Patient.SSN order by Patient.pID");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Patient ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";
echo "<option value=''>Choose Patient</option>";
while ($row = $stmt->fetch()) {
        echo "<tr><td><a href='patient.php?pID=$row[pID]'>$row[pID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td></tr>";
}
echo "</tbody>";
echo "</table>";

?>