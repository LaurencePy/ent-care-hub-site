<!doctype html>
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
  <a href="consultant-search.php">
  <button class="btn btn-primary ms-auto btn-lg">Search Consultants</button>
  </a>
  </nav>

  <div class="container-fluid consulting-cont">
  <div class="row one" id = "main-row-one">
    <div class="col-sm-12 col-md-6 about-us">
      <div class="box about-us">
        <div class="box-title">About Us</div>
        <div class="box-description">
          ENT Care Hub is a leading private healthcare provider in the East Midlands, specialising in ENT (Ear, Nose,
          and Throat) health services. With a diverse team of highly skilled consultants across multiple specialities, ENT
          Care Hub aims to provide high-quality healthcare through its network of clinics.
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-6">
      <div data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800">
        <img src="doctor.png" class="img-fluid doctor" alt="Doctor image">
      </div>
    </div>
  </div>


  <div data-aos="fade-up" data-aos-duration="800">
  <div class="row two" id="main-row-two">
    
  <div class="col-sm-12 col-md-6 find-us">
    <div class = "box locations"id="locations-box">
    <div class="box-title" id="locations-title"><h2> Our Locations</h2></div>
    </div>
    <div id="map">
    <script>
    var map = L.map('map').setView([52.7650253, -1.2320904], 8);

    // map set to view from Loughborough University starting point showing all clinics
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

    <div class="col-sm-12 col-md-6 how-to">
      <div class="box how-to">
        <div class="box-title" id ="how-to-use">How to Use ENT Care Hub</div>
          <div class="box-description">
          Please press any “Search Consultants” button on this page.
          You will then be taken to our search page in order to filter for, and find, the perfect consultant for your needs.
          </div>
      </div>
    <div class="text-center">
    <div data-aos="zoom-in" data-aos-duration="900">
      <a href="consultant-search.php">
    <button class="btn btn-primary ms-auto btn-lg" id="search-2">Search Consultants</button>
    </a>
    </div>
  </div>
  </div>


</div>
</div>


<div class="row three" id="main-row-three">
  <div class="col-sm-12 col-md-6 testimonies mx-auto text-center">
    <h1>Testimonials</h1>
    <div data-aos="fade-left" data-aos-duration="800">
      <div class="box may">
        <div class="d-flex align-items-start">
          <div class="me-3">
            <img src="avatar_woman.png" class="img-fluid woman" alt="avatar woman" width="100">
          </div>

          <div>
            <div class="box-title mb-2">May ⭐⭐⭐⭐⭐</div>
            <div class="box-description">
              ENT Care Hub allowed me to easily find the perfect Consultant!
            </div>
          </div>
        </div>
      </div>
    </div>

    <div data-aos="fade-right" data-aos-duration="800">
  <div class="box jeremy mt-4">
    <div class="d-flex align-items-start">
      <div class="me-3">
        <img src="avatar_man.png" class="img-fluid man" alt="avatar man" width="150">
      </div>
      <div>
        <div class="box-title mb-2">Jeremy ⭐⭐⭐⭐⭐</div>
        <div class="box-description">
          Thanks to the team at ENT Care Hub I was able to find the professional help I urgently needed
        </div>
      </div>
    </div>
  </div>
</div>


  </div>
</div>
</div>


  <script src="aos.js"></script>
  <script>
    AOS.init();
  </script>
  </body>
</html>