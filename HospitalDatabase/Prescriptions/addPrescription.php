<?php
​session_start();

​require_once('../connection.php');

echo "<h1><a href='../hospitaldatabase.php'>Hospital Database</a></h1>";
echo "<h2>Add A Prescription</h2>";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    //input prescription info
    echo "<form method='post' action='addPrescription.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>prescriptionID</td><td><input name='prescriptionID' type='text' size='25'></td></tr>";
    echo "<tr><td>pID</td><td><input name='pID' type='text' size='25'></td></tr>";
    echo "<tr><td>visitID</td><td><input name='visitID' type='text' size='25'></td></tr>";
    echo "<tr><td>Medication</td><td><input name='medication' type='text' size='11'></td></tr>";
    echo "<tr><td>Directions</td><td><input name='directions' type='text' size='50'></td></tr>";
    echo "<tr><td>Start date</td><td><input name='start_date' type='text' size='9'></td></tr>";
    echo "<tr><td>End date</td><td><input name='end_date' type='text' size='9'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
}
else{
    try {
        $stmt = $conn->prepare("INSERT IGNORE INTO Presciption (prescriptionID, pID, visitID, medication, directions, start_date,end_date) VALUES(:prescriptionID, :pID, :visitID, :medication, :directions, :start_date, :end_date");
        $stmt->bindValue(':prescriptionID', $_POST['prescriptionID']);
        $stmt->bindValue(':pID', $_POST['pID']);
        $stmt->bindValue(':visitID', $_POST['visitID']);
        $stmt->bindValue(':medication', $_POST['medication']);
        $stmt->bindValue(':directions', $_POST['directions']);
        $stmt->bindValue(':start_date', $_POST['start_date']);
        $stmt->bindValue(':end_date', $_POST['end_date']);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "Prescription Succesfully Added<br/>";
    $stmt = $conn->prepare("select max(prescriptionID) from Prescription where pID= $_POST[pID];");
    $stmt->execute();
    $row = $stmt->fetch();
    echo "<a href='prescription.php?pID=$row[prescriptionID]'>View prescription information</a><br/>";
}
?>