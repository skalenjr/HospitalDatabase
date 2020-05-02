<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Procedure Information</h2>";

if (isset($_GET['procID']))
{
    //give patients information
    $stmt = $conn->prepare("select Visit.pID, Procedures.procID, Procedures.procedure_name, Procedures.cost, Procedures.room_number, Person.first_name, Person.last_name from Person, Patient, Procedures, Visit where Procedures.visitID = Visit.visitID and Visit.pID = Patient.pID and Person.SSN = Patient.SSN order by Procedures.procID");
    $stmt->execute();
    
    echo "<table width=900px style='border: solid 1px black;'>";
    echo "<thead><tr><th>Procedure ID</th><th>Procedure Name</th><th>First name</th><th>Last name</th><th>Procedure Cost</th>th>Room Number</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>$row[procID]<td>$row[procedure_name]</td></td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[procedure_cost]</td><td>$row[room_number]</td></tr>";
        $pID = $row['pID'];
    }
    echo "</tbody>";
    echo "</table>";
    echo "<a href='patientsProcedures.php?pID=$pID'>Vie</a><br/>";
    echo "<a href='../patient.php?pID=$pID'>View patient's Information</a><br/><br/>";
}
else {
    // Retrieve list of Procedures
    $stmt = $conn->prepare("select Procedures.procID, Person.first_name, Person.last_name, Procedures.procedure_name from Person, Patient, Procedures where Person.SSN = Patient.SSN order by Patient.pID");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='procID' onchange='this.form.submit();'>";
    echo "<option value='' selected disabled hidden>Choose Procedure</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[procID]'>$row[first_name] $row[last_name] - $row[procedure_name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
}


?>