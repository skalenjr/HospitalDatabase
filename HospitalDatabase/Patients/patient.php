<?php

require_once('../connection.php');

if (isset($_GET['pID']))
{
    //give patients information
    $stmt = $conn->prepare("select Patient.pID, Patient.SSN, Person.first_name, Person.last_name, Patient.type_of_insurance from Person, Patient where Person.SSN = Patient.SSN and Patient.pID = $_GET[pID]");
    $stmt->execute();
    
    echo "<table style='border: solid 1px black;'>";
    echo "<thead><tr><th>Patient ID</th><th>SSN</th><th>First name</th><th>Last name</th><th>Type Of Insurance</th></tr></thead>";
    echo "<tbody>";
    
    while ($row = $stmt->fetch()) {
        echo "<tr><td>$row[pID]><td>$row[SSN]></td></td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[type_of_insurance]</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
else {
    // Retrieve list of patients
    $stmt = $conn->prepare("select Patient.pID, Person.first_name, Person.last_name from Person, Patient where Person.SSN = Patient.SSN order by Patient.pID");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='pID' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[pID]'>$row[first_name] $row[last_name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
}
    
    
?>