<?php

require_once('../connection.php');
echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Edit Patient Information</h2>";

if (!isset($_GET['pID']) && $_SERVER['REQUEST_METHOD'] != 'POST')
{
    //retrieve list of patients
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
else if($_SERVER['REQUEST_METHOD'] != 'POST'){
    //show current pateint information in form
    $stmt = $conn->prepare("select Patient.pID, Patient.SSN, Person.first_name, Person.last_name, Patient.type_of_insurance from Person, Patient where Person.SSN = Patient.SSN and Patient.pID = $_GET[pID]");
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    $oldSSN = $row['SSN'];
    
    echo "<form method='post' action='editEmployee.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Patient ID:</td><td>$row[pID]</td></tr>";
    echo "<tr><td>First Name</td><td><input name='first_name' type='text' size='15' value='$row[first_name]'></td></tr>";
    echo "<tr><td>Last Name</td><td><input name='last_name' type='text' size='15' value='$row[last_name]'></td></tr>";
    echo "<tr><td>SSN</td><td><input name='SSN' type='text' min='0.01' step='0.01' size='11' value='$row[SSN]'></td></tr>";
    echo "<tr><td>Type of Insurance</td><td><input name='type_of_insurance' type='text' min='0.01' step='0.01' size='15' value='$row[type_of_insurance]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
}
else{
    //send updated patient information
    try{
    $stmt = $conn->prepare("UPDATE Person SET Person.first_name=:first_name, Person.last_name=:last_name, Person.SSN=:SSN where Person.SSN = $oldSSN");
    $stmt->bindValue(':first_name', $_POST['first_name']);
    $stmt->bindValue(':last_name', $_POST['last_name']);
    $stmt->bindValue(':SSN', $_POST['SSN']);
    $stmt->bindValue(':pID', $_GET["pID"]);
    $stmt->execute();
    
    $stmt = $conn->prepare("UPDATE Patient SET Patient.SSN=:SSN, Patient.type_of_insurance=:type_of_insurance where Patient.pid= $row[pID]");
    $stmt->bindValue(':SSN', $_POST['SSN']);
    $stmt->bindValue(':pID', $_GET["pID"]);
    $stmt->execute();
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    echo "<a href='Patients/patient.php?pID=$row[pID]'>View patient's information</a>";
}
?>