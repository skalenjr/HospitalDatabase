<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Patient's Procedures</h2>";

if(isset($_GET['pID']))
{
    $stmt = $conn->prepare("select Visit.visitID, Visit.pID, Visit.admission_time, Visit.discharge_time, Visit.medical_issue, Visit.room_number,  Person.first_name, Person.last_name from Person, Patient, Visit, Procedures where Patient.pID=$_GET[pID] and Procedures.visitID = Visit.visitID and Visit.pID = Patient.pID and Person.SSN = Patient.SSN order by Procedures.procID");
    $stmt->execute();
    
    echo "<table style='border: solid 1px black;'>";
    echo "<thead><tr><th>Visit ID</th><th>First name</th><th>Last name</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td><a href='procedure.php?procID=$row[visitID]'>$row[first_name]</td><td>$row[last_name]</td></tr>";
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