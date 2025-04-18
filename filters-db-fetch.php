<?php
declare(strict_types=1);

require 'db-connection.php';
header("Content-Type: application/json");




$sqlSpecialities = "SELECT speciality FROM specialities";
$resultSpecialities = mysqli_query($conn, $sqlSpecialities);
$specialities = [];

if ($resultSpecialities && $resultSpecialities->num_rows > 0) {
    while ($row = $resultSpecialities->fetch_assoc()) {
        $specialities[] = $row['speciality'];
    }
}

$sqlClinics = "SELECT name FROM clinics";
$resultClinics = mysqli_query($conn, $sqlClinics);
$clinics = [];

if ($resultClinics && $resultClinics->num_rows > 0) {
    while ($row = $resultClinics->fetch_assoc()) {
        $clinics[] = $row['name'];
    }
}



mysqli_close($conn);

$response = [
    'resultSpecialities' => $specialities,
    'resultClinics' => $clinics
];

echo json_encode($response);
?>