<?php
require 'db-connection.php';
header("Content-Type: application/json");


$sql_consultants = "
    SELECT c.name, AVG(r.score) AS avg_rating
    FROM consultants c
    JOIN reviews r ON c.id = r.consultant_id
    GROUP BY c.id
    ORDER BY avg_rating DESC
";
$result_consultants = $conn->query($sql_consultants);

$consultant_data = [];
while ($row = $result_consultants->fetch_assoc()) {
    $consultant_data[] = [
        'name' => $row['name'],
        'avg_rating' => round($row['avg_rating'], 1)
    ];
}


$sql_clinics = "
    SELECT cl.name AS clinic_name, AVG(r.score) AS avg_rating
    FROM clinics cl
    JOIN consultants c ON cl.id = c.clinic_id
    JOIN reviews r ON c.id = r.consultant_id
    GROUP BY cl.id
    ORDER BY avg_rating DESC
";
$result_clinics = $conn->query($sql_clinics);

$clinic_data = [];
while ($row = $result_clinics->fetch_assoc()) {
    $clinic_data[] = [
        'clinic' => $row['clinic_name'],
        'avg_rating' => round($row['avg_rating'], 1)
    ];
}

$conn->close();


echo json_encode([
    'consultants' => $consultant_data,
    'clinics' => $clinic_data
]);
?>
