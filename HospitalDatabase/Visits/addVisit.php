<?php
 
session_start();
require_once('../connection.php');
echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Add a Visit</h2>";
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<form method='post' action='addVisit.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>visit ID</td><td><input name='visitID' type='text' size='25'></td></tr>";
    echo "<tr><td>pID</td><td><input name='pID' type='text' size='25'></td></tr>";
    echo "<tr><td>Admission time</td><td><input name='admission_time' type='text' size='11'></td></tr>";
    echo "<tr><td>Discharge time</td><td><input name='discharge_time' type='text' size='10'></td></tr>";
    echo "<tr><td>Medical issue</td><td><input name=' medical_issue' type='text' size='25'></td></tr>";
    echo "<tr><td>Room number</td><td><input name=' room_number' type='text' size='25'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
}
else{
    try {
        $stmt = $conn->prepare("INSERT IGNORE INTO Visit (visitID, pID, admission_time, discharge_time, visit_date, medical_issue, room_number) VALUES(:visitID, :pID, :admission_time, :discharge_time, :visit_date, :medical_issue, :room_number");
        $stmt->bindValue(':visitID', $_POST['visitID']);
        $stmt->bindValue(':pID', $_POST['pID']);
        $stmt->bindValue(':admission_time', $_POST['admission_time']);
        $stmt->bindValue(':discharge_time', $_POST['discharge_time']);
        $stmt->bindValue(':visit_date', $_POST['visit_date']);
        $stmt->bindValue(':medical_issue', $_POST['medical_issue']);
        $stmt->bindValue(':room_number', $_POST['room_number']);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "Visit Succesfully Added<br/>";
    $stmt = $conn->prepare("select max(visitID) from Visit where pid= $_POST[pID];");
    $stmt->execute();
    $row = $stmt->fetch();
    echo "<a href='visit.php?visitID=$row[visitID]'>View a visit's information</a><br/>";
}
?>