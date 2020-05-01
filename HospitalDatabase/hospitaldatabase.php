<?php
$text="'s";

session_start();

if (!isset($_SESSION['loggedin'])){
    header("Location: index.php");
}
    
echo '<div style="position: relative; width: 250px;">';
echo '<div style="position: absolute; top: 0; right: -100; width: 100px; text-align:right;">';
echo '<a href="index.php">logout</a>';
echo '</div>';

echo '<html>';
echo '<head>';
echo '</head>';
echo '<body>';
echo '<h1>Hospital Database</h1>';
echo '<h2>Patients</h2>';
echo '<ul>';
echo '<li><a href="Patients/patients.php">View all patients</a></li>';
echo "<li><a href='Patients/patient.php'>View a patient$text information</a></li>";
echo '<li><a href="Patients/addPatient.php">Add a patient</a></li>';
echo "<li><a href='Patients/editPatient.php'>Edit a patient$text information</a></li>";
echo '</ul>';
echo '<h2>Visits</h2>';
echo '<ul>';
echo '<li><a href="Visits/visits.php">View all visits</a></li>';
echo '<li><a href="Visits/visit.php">View a specific visit</a></li>';
echo "<li><a href='Visits/patientsVisits.php'>View a patient$text visits</a></li>";
echo '<li><a href="Visits/addVisit.php">Input visit informantion</a></li>';
echo '</ul>';
echo '<h2>Procedures</h2>';
echo '<ul>';
echo '<li><a href="Visits/procedures.php">View all procedures</a></li>';
echo '<li><a href="Procedures/procedure.php">View a specific procedure</a></li>';
echo "<li><a href='Procedures/patientsProcedures.php'>View a patient$text procedures</a></li>";
echo '<li><a href="Procedures/addProcedure.php">Input procedure information</a></li>';
echo '</ul>';
echo '<h2>Prescriptions</h2>';
echo '<ul>';
echo '<li><a href="prescriptions/patientsPresciption.php">View prescriptions for patient</a></li>';
echo '<li><a href="prescriptions/addPrescription.php">Input new prescription</a></li>';
echo '</ul>';
echo '<h2>Employees</h2>';
echo '<ul>';
echo '<li><a href="employees/employees.php">View employees</a></li>';
echo "<li><a href='employees/employee.php'>View an employee$text information</a></li>";
echo '<li><a href="employees/addEmployee.php">Add an employee</a></li>';
echo "<li><a href='employees/editEmployee.php'>Edit an employee$text information</a></li>";
echo '</ul>';
echo '</body>';
echo '</html>';

?>