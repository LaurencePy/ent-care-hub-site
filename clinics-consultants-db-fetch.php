<?php
declare(strict_types=1);

require 'db-connection.php';
header("Content-Type: application/json");




$sqlConsultants = "SELECT COUNT(*) AS consultants_count FROM consultants";
$resultConsultants = mysqli_query($conn, $sqlConsultants);
$consultantsCount = mysqli_fetch_assoc($resultConsultants)['consultants_count'] ?? 0;

$sqlClinics = "SELECT COUNT(*) AS clinics_count FROM clinics";
$resultClinics = mysqli_query($conn, $sqlClinics);
$clinicsCount = mysqli_fetch_assoc($resultClinics)['clinics_count'] ?? 0;




mysqli_close($conn);

$response = [
    'consultantsCount' => $consultantsCount,
    'clinicsCount' => $clinicsCount,
];

echo json_encode($response);
?>