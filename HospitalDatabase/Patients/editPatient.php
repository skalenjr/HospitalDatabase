<?php

require_once('../connection.php');

echo "<h1>Hospital Database</h1>";
echo "<h2>Edit Patient Information</h2>";

if (!isset($_GET['pID']) && $_SERVER['REQUEST_METHOD'] != 'POST')
{
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
else if(){
    
}
?>