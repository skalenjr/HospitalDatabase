<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Prescription Information</h2>";

if (isset($_GET['prescriptionID']))
{
    //give patients information
    $stmt = $conn->prepare("select prescriptionID, pID, visitID, medication, directions, start_date, end_date from Prescription where prescriptionID = $_GET[prescriptionID]");
    $stmt->execute();
    
    echo "<table width=900px style='border: solid 1px black;'>";
    echo "<thead><tr><th>Prescription ID</th><th>Patient ID</th><th>Visit ID</th><th>Medication</th><th>Directions</th><th>Start Date</th><th>End Date</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>$row[prescriptionID]</td><td><a href='../Patients/patient.php?pID=$row[pID]'>$row[pID]</a></td><td><a href='../Visits/visit.php?visitID=$row[visitID]'>$row[visitID]</a></td><td>$row[medication]</td><td>$row[directions]</td><td>$row[start_date]</td><td>$row[end_date]</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<a href='prescription.php'>View Another Prescription's Information</a><br/><br/>";
}
else {
    // Retrieve list of patients
    $stmt = $conn->prepare("select first_name, last_name, prescriptionID, Prescription.pID, visitID, medication, directions, start_date, end_date from Prescription, Person, Patient where Person.SSN = Patient.SSN and Patient.pID = Prescription.pID");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='prescriptionID' onchange='this.form.submit();'>";
    echo "<option value='' selected disabled hidden>Choose Prescription</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[prescriptionID]'>$row[first_name] $row[last_name] - $row[medication]</option>";
    }
    
    echo "</select>";
    echo "</form>";
}


?>