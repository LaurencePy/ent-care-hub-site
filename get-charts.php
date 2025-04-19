<?php
require 'db-connection.php';
header("Content-Type: application/json");

$sql = "
    SELECT c.name, AVG(r.score) AS avg_rating
    FROM consultants c
    JOIN reviews r ON c.id = r.consultant_id
    GROUP BY c.id
    ORDER BY avg_rating DESC
";

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        'name' => $row['name'],
        'avg_rating' => round($row['avg_rating'], 1)
    ];
}

$conn->close();

echo json_encode($data);
?>
