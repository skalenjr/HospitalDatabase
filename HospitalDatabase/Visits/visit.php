<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Visit Information</h2>";

if (isset($_GET['visitID']))
{
    //give Visit information
    $stmt = $conn->prepare("SELECT visitID, pID, admission_time, discharge_time,medical_issue, room_number FROM Visit WHERE visitID = $_GET[visitID]");
    $stmt->execute();
    
    echo "<table width=900px style='border: solid 1px black;'>";
    echo "<thead><tr><th>Visit ID</th><th>Patient ID</th><th>Admission time</th><th>Discharge time</th><th >Medical Issue</th><th>Room Number</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>$row[visitID]<td>$row[pID]</td></td><td>$row[admission_time]</td><td>$row[discharge_time]</td><td>$row[medical_issue]</td><td>$row[room_number]</td></tr>";
        $visitID = $row['visitID'];
    }
    echo "</tbody>";
    echo "</table>";
}
else {
    // Retrieve list of visits
    $stmt = $conn->prepare("select visitID, pID from Visit");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='visitID' onchange='this.form.submit();'>";
    echo "<option value='' selected disabled hidden>Choose Visit</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[visitID]'>$row[pID]</option>";
    }
    
    echo "</select>";
    echo "</form>";
}


?>