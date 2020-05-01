<?php

require_once('../connection.php');

session_start();

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Edit Patient Information</h2>";

$oldSSN = '';

if (!isset($_GET['pID']) && $_SERVER['REQUEST_METHOD'] != 'POST')
{
    //retrieve list of patients
    $stmt = $conn->prepare("select Patient.pID, Person.first_name, Person.last_name from Person, Patient where Person.SSN = Patient.SSN order by Patient.pID");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='pID' onchange='this.form.submit();'>";
    echo "<option value=''>Choose Patient</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[pID]'>$row[first_name] $row[last_name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
}
else if($_SERVER['REQUEST_METHOD'] != 'POST'){
    //show current pateint information in form
    $pid = $_GET['pID'];
    $stmt = $conn->prepare("select Patient.pID, Patient.SSN, Person.first_name, Person.last_name, Patient.type_of_insurance from Person, Patient where Person.SSN = Patient.SSN and Patient.pID = $_GET[pID]");
    $stmt->execute();
    
    $row = $stmt->fetch();
    $_SESSION["SSN"] = $row['SSN'];
    
    echo "<form method='post' action='editPatient.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Patient ID:</td><td>$row[pID]</td></tr>";
    echo "<tr><td>First Name</td><td><input name='first_name' type='text' size='15' value='$row[first_name]'></td></tr>";
    echo "<tr><td>Last Name</td><td><input name='last_name' type='text' size='15' value='$row[last_name]'></td></tr>";
    echo "<tr><td>Type of Insurance</td><td><input name='type_of_insurance' type='text' min='0.01' step='0.01' size='15' value='$row[type_of_insurance]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["pID"] = $pid;  
}
else{
    //send updated patient information
    try{
        echo $_SESSION["pID"];
    $stmt = $conn->prepare("UPDATE Person SET Person.first_name=:first_name, Person.last_name=:last_name WHERE Person.SSN=:SSN; 
    UPDATE Patient SET Patient.type_of_insurance=:type_of_insurance where Patient.pid=:pID;");
    $stmt->bindValue(':first_name', $_POST['first_name']);
    $stmt->bindValue(':last_name', $_POST['last_name']);
    $stmt->bindValue(':SSN', $_SESSION["pID"]);
    $stmt->bindValue(':type_of_insurance', $_POST['type_of_insurance']);
    $stmt->bindValue(':pID', $_SESSION["pID"]);
    $stmt->execute();
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    $pID = $_SESSION['pID'];
    echo "Patient Information Succesfully Updated<br/>";
    echo "<a href='patient.php?pID=$pID'>View patient's information</a>";
    unset($pID);
    unset($_SESSION["pID"]);
    unset($_SESSION["pID"]);
}
?>