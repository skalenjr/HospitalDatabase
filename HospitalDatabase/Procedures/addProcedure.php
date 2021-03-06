<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Input a Procedure</h2>";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    //input procedure info
    echo "<form method='post' action='addProcedure.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Visit ID</td><td><input name='visitID' type='text' size='4'></td></tr>";
    $stmt = $conn->prepare("select Person.first_name, Person.last_name from Person, Employee where Person.SSN=Employee.SSN and Employee.job_title='Doctor'");
    $stmt->execute();
    echo "<tr><td>Doctor</td><td>";
    echo "<select name='doctor_eID'>";
    echo "<option value='' selected disabled hidden>Choose Doctor</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[eID]'>$row[first_name] $row[last_name]</option>";
    }
    echo "</select>";
    echo "</td></tr>";
    $stmt = $conn->prepare("select Person.first_name, Person.last_name from Person, Employee where Person.SSN=Employee.SSN and Employee.job_title='Nurse'");
    $stmt->execute();
    echo "<tr><td>Nurse</td><td>";
    echo "<select name='Nurse_eID'>";
    echo "<option value='' selected disabled hidden>Choose Nurse</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[eID]'>$row[first_name] $row[last_name]</option>";
    }
    echo "</select>";
    echo "</td></tr>";
    $stmt = $conn->prepare("select Medication.medication_name from Medication");
    $stmt->execute();
    echo "<tr><td>Medication</td><td>";
    echo "<select name='medication_name'>";
    echo "<option value='' selected disabled hidden>Choose Medication</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[medication_name]'>$row[medication_name]</option>";
    }
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td>Procedure Name</td><td><input name='procedure_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Procedure Cost</td><td><input name='cost' type='text' size='10'></td></tr>";
    echo "<tr><td>Room Number</td><td><input name='room_number' type='text' size='4'></td></tr>";
    $stmt = $conn->prepare("select department_name, department_ID from Department");
    $stmt->execute();
    echo "<tr><td>Department</td><td>";
    echo "<select name='department_ID'>";
    echo "<option value='' selected disabled hidden>Choose Department</option>";
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[department_ID]'>$row[department_name]</option>";
    }
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
}
else{
    try {
        $stmt = $conn->prepare("INSERT IGNORE INTO Procedures (visitID, procedure_name, cost, room_number, department_ID) VALUES(:visitID, :procedure_name, :cost, :room_number, :department_ID);");
        $stmt->bindValue(':visitID', $_POST['visitID']);
        $stmt->bindValue(':procedure_name', $_POST['procedure_name']);
        $stmt->bindValue(':cost', $_POST['cost']);
        $stmt->bindValue(':room_number', $_POST['room_number']);
        $stmt->bindValue(':department_ID', $_POST['department_ID']);
        $stmt->execute();
        $_SESSION['visitID']=$_POST['visitID'];
        $_SESSION['result']='success';
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "Procedure Succesfully Added<br/>";
}
?>
