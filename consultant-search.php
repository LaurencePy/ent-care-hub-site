<?php
require 'db-connection.php';


$speciality = isset($_GET['speciality']) ? $_GET['speciality'] : '';
$clinic = isset($_GET['clinic']) ? $_GET['clinic'] : '';
$min_score = isset($_GET['score']) ? $_GET['score'] : '';
$max_fee = isset($_GET['fee']) ? $_GET['fee'] : '';
$available_date = isset($_GET['date']) ? $_GET['date'] : '';


$query_conditions = [];
$param_types = '';
$query_params = [];

if (!empty($speciality)) {
    $query_conditions[] = 'c.speciality_id = ?';
    $param_types .= 'i';
    $query_params[] = $speciality;
}

if (!empty($clinic)) {
    $query_conditions[] = 'c.clinic_id = ?';
    $param_types .= 'i';
    $query_params[] = $clinic;
}

if (!empty($max_fee)) {
    $query_conditions[] = 'c.consultation_fee <= ?';
    $param_types .= 'd';
    $query_params[] = (float)$max_fee;
}


if (!empty($available_date)) {
    try {
        $date = new DateTime($available_date);
        $weekday = $date->format('w');
        $weekday = $weekday == 0 ? 6 : $weekday - 1;
        
        $query_conditions[] = "EXISTS (
            SELECT 1 FROM consultant_schedule 
            WHERE consultant_id = c.id AND weekday = ?
        )";
        $param_types .= 'i';
        $query_params[] = $weekday;
        
        $query_conditions[] = "NOT EXISTS (
            SELECT 1 FROM bookings 
            WHERE consultant_id = c.id AND booking_date = ?
        )";
        $param_types .= 's';
        $query_params[] = $available_date;
    } catch (Exception $e) {
        
    }
}

$base_query = "
    SELECT 
        c.id,
        c.name AS consultant_name,
        c.consultation_fee,
        s.description AS speciality,
        cl.name AS clinic_name,
        COALESCE(r.avg_score, 0) AS avg_rating
    FROM consultants c
    JOIN specialities s ON c.speciality_id = s.id
    JOIN clinics cl ON c.clinic_id = cl.id
    LEFT JOIN (
        SELECT consultant_id, AVG(score) as avg_score 
        FROM reviews 
        GROUP BY consultant_id
    ) r ON c.id = r.consultant_id
";

if (!empty($query_conditions)) {
    $base_query .= " WHERE " . join(" AND ", $query_conditions);
}

if (!empty($min_score)) {
    $base_query .= " HAVING avg_rating >= ?";
    $param_types .= 'd';
    $query_params[] = (float)$min_score;
}


$final_query = $base_query . " ORDER BY avg_rating DESC";


$stmt = $conn->prepare($final_query);
if (!empty($query_params)) {
    $stmt->bind_param($param_types, ...$query_params);
}
$stmt->execute();
$consultants = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


$specialities = $conn->query("SELECT id, description FROM specialities")->fetch_all(MYSQLI_ASSOC);
$clinics = $conn->query("SELECT id, name FROM clinics")->fetch_all(MYSQLI_ASSOC);
?>

















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ENT Care Hub</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="aos.css">
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            max-width: 1000px;
            margin: 50px auto;
        }
    </style>
</head>


<body>
<nav class="navbar bg-light px-4">
  <span class="navbar-brand mb-0 h1">
    <a href="enthub.php">
    <img src="ent care hub logo.png" alt="logo" width="60" class="me-2" />
    <span class = "ent-care-hub-text">ENT Care Hub</span>
    </a>
    <div class = "call-us ms-auto ">🕿 Call us on 01234 567890</div>
  </span>
  </nav>

  <div class="row search-one" id="search-one">
  <div class="col-sm-12 col-md-6 map-two-col">
  <div id="map-two">
    <script>
    var map = L.map('map-two').setView([52.7650253, -1.2320904], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker;
    map.locate({ setView: true, maxZoom: 15 });
    map.on('locationfound', function(ev) {
        if (!marker) {
            marker = L.marker(ev.latlng).addTo(map);
        } else {
            marker.setLatLng(ev.latlng);
        }

        marker.bindPopup("Your location").openPopup();
        map.setView(ev.latlng, 13);
    });

    map.on('locationerror', function(e) {
        alert("Could not find your location. Try a different browser");
    });


    
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);
  var Riverside_marker = L.marker([52.6369, -1.1398]).addTo(map).bindPopup("Riverside ENT Clinic");
  var Oakwood_marker = L.marker([52.5200, -1.1700]).addTo(map).bindPopup("Oakwood ENT Centre");
  var Elmwood_marker = L.marker([52.7400, -1.2100]).addTo(map).bindPopup("Elmwood Medical Hub");
  var Haven_marker = L.marker([52.9225, -1.4746]).addTo(map).bindPopup("Haven ENT Clinic");
  var Meadowlands_marker = L.marker([52.9500, -1.4835]).addTo(map).bindPopup("Meadowlands Health Point");
  var Hillside_marker = L.marker([52.9548, -1.1581]).addTo(map).bindPopup("Hillside ENT Centre");
  var Valley_marker = L.marker([52.9830, -1.2148]).addTo(map).bindPopup("Valley View Clinic");
  var Lakeside_marker = L.marker([52.9340, -1.1426]).addTo(map).bindPopup("Lakeside ENT Clinic");
  </script>
  </div>
  </div>
  <div class="col-sm-12 col-md-6 map-two-col-2">
    <div class="box how-to" id="how-to-two">
      <div class="box-title" id ="how-to-use">How to find a specialist</div>
        <div class="box-description">
        Observe the map to the left to see clinics locations in relation to your current location.
        You can then filter your search for consultants using the boxes below.
        </div>
    </div>

</div>


</div>


  <div class="container-fluid consultants-page" id="consultants-area">
    
  <div class="row search-two" id="search-two">
    <div class="col-sm-12 col-md-6 searching">
      
    </div>
</div>


</div>
  <div class="container py-5" id = "search-container">
  <div class="box searching-box">
        <div class="box-title" id="find-ent">Find an ENT Specialist</div>
        <div class="box-description" id="output">
          search   consultants from   clinics
          </div>
        <div id="charts-page-button">
        <a href="charts.html">
        <button type="submit" class="btn btn-primary">View Charts for statistics</button>
        </a>
        </div>
          <script>
            fetch('clinics-consultants-db-fetch.php')
              .then(res => {
                if (res.ok) {
                  return res.json();
                } else {
                  throw new Error("Fetch failed");
                }
              })
              .then(response => {
                console.log("JSON Response:", response);
                const outputDiv = document.getElementById("output");
                const consultantsCount = response.consultantsCount;
                const clinicsCount = response.clinicsCount;
                outputDiv.innerHTML = `search <span id="consultant_count_num">${consultantsCount}</span> consultants from <span id="clinics_count_num">${clinicsCount}</span> clinics`;
              })

              .catch(error => {
                
                document.getElementById("output").innerText = "Error: " + error.message;
              });
          </script>
        




      </div>

    <form class="row g-3 mb-5" method="GET" id="filter-row">
      <div class="col-md-2">
        <label class="form-label">Speciality</label>
        <select name="speciality" class="form-select">
          <option value="">All</option>
          <?php foreach ($specialities as $s): ?>
            <option value="<?= $s['id'] ?>" <?= $s['id'] == $speciality ? 'selected' : '' ?>>
              <?= htmlspecialchars($s['description']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-2">
        <label class="form-label">Clinic</label>
        <select name="clinic" class="form-select">
          <option value="">All</option>
          <?php foreach ($clinics as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $clinic ? 'selected' : '' ?>>
              <?= htmlspecialchars($c['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-2">
        <label class="form-label">Min Score</label>
        <input type="number" name="score" class="form-control" value="<?= htmlspecialchars($min_score) ?>" step="0.1" min="0" max="5">
      </div>

      <div class="col-md-2">
        <label class="form-label">Max Fee (£)</label>
        <input type="number" name="fee" class="form-control" value="<?= htmlspecialchars($max_fee) ?>" step="0.01" min="0">
      </div>

      <div class="col-md-2">
        <label class="form-label">Available On</label>
        <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($available_date) ?>" 
            min="<?= date('Y-m-d') ?>" required>
        </div>

      <div class="col-md-2" id="filter-search">

        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>

    <div class="row g-4">
  <?php foreach ($consultants as $c): 
    $weekdays_stmt = $conn->prepare("SELECT weekday FROM consultant_schedule WHERE consultant_id = ?");
    $weekdays_stmt->bind_param('i', $c['id']);
    $weekdays_stmt->execute();
    $weekdays_result = $weekdays_stmt->get_result();
    $weekdays = $weekdays_result->fetch_all(MYSQLI_ASSOC);
    
    $dayNames = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $availableDays = [];
    foreach ($weekdays as $day) {
        $availableDays[] = $dayNames[$day['weekday']];
    }
    
    $isAvailable = true;
    $availabilityText = "Available";
    $availabilityClass = "text-success";
    
    if (!empty($available_date)) {
        $booking_check = $conn->prepare("SELECT id FROM bookings WHERE consultant_id = ? AND booking_date = ?");
        $booking_check->bind_param('is', $c['id'], $available_date);
        $booking_check->execute();
        $booking_check->store_result();
        
        if ($booking_check->num_rows > 0) {
            $isAvailable = false;
            $availabilityText = "Unavailable";
            $availabilityClass = "text-danger";
        }
        
        try {
            $dateTime = new DateTime($available_date);
            $weekday = $dateTime->format('w');
            $weekday = $weekday == 0 ? 6 : $weekday - 1;
            
            $weekday_check = $conn->prepare("SELECT 1 FROM consultant_schedule WHERE consultant_id = ? AND weekday = ?");
            $weekday_check->bind_param('ii', $c['id'], $weekday);
            $weekday_check->execute();
            $weekday_check->store_result();
            
            if ($weekday_check->num_rows === 0) {
                $isAvailable = false;
                $availabilityText = "Not Working";
                $availabilityClass = "text-warning";
            }
        } catch (Exception $e) {
            console.error("Error with date");
        }
    }
  ?>
    <div class="col-md-4" data-aos="fade-up">
      <div class="bg-white p-4 rounded shadow-sm h-100">
        <h4><?= htmlspecialchars($c['consultant_name']) ?></h4>
        <p class="text-muted"><?= htmlspecialchars($c['speciality']) ?></p>
        <p><strong>Clinic:</strong> <?= htmlspecialchars($c['clinic_name']) ?></p>
        <p><strong>Fee:</strong> £<?= number_format($c['consultation_fee'], 2) ?></p>
        <p><strong>Average Rating:</strong> <?= number_format($c['avg_rating'] ?? 0, 1) ?></p>
        

        <p class="mb-1"><strong>Available Days:</strong></p>
        <div class="d-flex flex-wrap gap-1 mb-2">
          <?php foreach ($availableDays as $day): ?>
            <span class="badge bg-primary"><?= $day ?></span>
          <?php endforeach; ?>
        </div>
        

        <?php if ($available_date !== ''): ?>
          <p class="mb-0"><strong>Availability on <?= htmlspecialchars($available_date) ?>:</strong> 
            <span class="<?= $availabilityClass ?>"><?= $availabilityText ?></span>
          </p>
        <?php endif; ?>
        
      </div>
    </div>
  <?php endforeach; ?>
</div>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init();</script>
  <script>
console.log("Consultant search: ");
console.log("Selected Specialty: ", "<?= $speciality ?>");
console.log("Selected Clinic: ", "<?= $clinic ?>");
console.log("Min Score: ", "<?= $min_score ?>");
console.log("Available Date: ", "<?= $available_date ?>");

<?php foreach ($consultants as $index => $c): ?>
console.log("Consultant #<?= $index+1 ?>:", {
    name: "<?= $c['consultant_name'] ?>",
    rating: <?= $c['avg_rating'] ?? 0 ?>,
    fee: <?= $c['consultation_fee'] ?>,
    available: <?= json_encode($availableDays ?? []) ?>,
    status: "<?= $availabilityText ?? 'N/A' ?>"
});
<?php endforeach; ?>

</script>
</body>
</html>
