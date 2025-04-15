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


mysqli_close($conn);

$response = [
    'resultSpecialities' => $resultSpecialities
];

echo json_encode($response);
?>