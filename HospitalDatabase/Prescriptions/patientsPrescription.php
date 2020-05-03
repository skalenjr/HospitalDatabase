<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Patient's Procedures</h2>";


if (isset($_GET['pID']))
{
    $stmt = $conn->prepare("select Prescription.prescriptionID, Prescription.medication, first_name, last_name from Prescription, Patient, Person where Person.SSN=Patient.SSN and Prescription.pID=Patient.pID and Patient.pID=$_GET[pID]");
    $stmt->execute();
    
    echo "<table style='border: solid 1px black;'>";
    echo "<thead><tr><th>Prescription ID</th><th>First name</th><th>Last name</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td><a href='prescription.php?prescriptionID=$row[prescriptionID]'>$row[prescriptionID]</a></td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[medication]</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
else{
    // Retrieve list of patients
    $stmt = $conn->prepare("select Patient.pID, Person.first_name, Person.last_name from Person, Patient where Person.SSN = Patient.SSN order by Patient.pID");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='pID' onchange='this.form.submit();'>";
    echo "<option value='' selected disabled hidden>Choose Patient</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[pID]'>$row[first_name] $row[last_name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
}
?>