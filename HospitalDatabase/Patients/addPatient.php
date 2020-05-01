<?php

session_start();

require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Add A Patient</h2>";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    //input patient info
    echo "<form method='post' action='addPatient.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Type Of Insurance</td><td><input name='type_of_insurance' type='text' size='25'></td></tr>";
    echo "<tr><td>SSN</td><td><input name='SSN' type='text' size='11'></td></tr>";
    echo "<tr><td>Address</td><td><input name='Address' type='text' size='50'></td></tr>";
    echo "<tr><td>Date Of Birth</td><td><input name='DOB' type='text' size='9'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
}
else{
    try {
        $stmt = $conn->prepare("INSERT IGNORE INTO Person (first_name, last_name, SSN, address, DOB) VALUES(:first_name, :last_name, :SSN, :Address, :DOB);
        INSERT IGNORE INTO Patient(SSN, type_of_insurance) VALUES(:SSN, :type_of_insurance);");
        $stmt->bindValue(':first_name', $_POST['first_name']);
        $stmt->bindValue(':last_name', $_POST['last_name']);
        $stmt->bindValue(':SSN', $_POST['SSN']);
        $stmt->bindValue(':Address', $_POST['Address']);
        $stmt->bindValue(':DOB', $_POST['DOB']);
        $stmt->bindValue(':type_of_insurance', $_POST['type_of_insurance']);;
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "Patient Succesfully Added<br/>";
    $stmt = $conn->prepare("select pID from Patient where SSN= $_POST[SSN];");
    $stmt->execute();
    $row = $stmt->fetch();
    echo "<a href='patient.php?pID=$row[pID]'>View patient's information</a><br/>";
}
?><?php
