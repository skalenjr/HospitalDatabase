<?php

require_once('../connection.php');

$stmt = $conn->prepare("select Patient.PID, Person.first_name, Person.last_name from Person, Patient where Person.SSN = Patient.SSN order by Patient.pID");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>pID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";

while ($row = $stmt->fetch()) {
        echo "<tr><td>$row[pID]</td><td>$row[first_name]</td><td>$row[last_name]</td></tr>";
}
echo "</tbody>";
echo "</table>";

?>