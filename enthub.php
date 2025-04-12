<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ENT Care Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="aos.css">
    <script defer src="app.js"></script>
  </head>

  <body>
  

  <nav class="navbar bg-light px-4">
  <span class="navbar-brand mb-0 h1">
    <a href="enthub.php">
    <img src="ent care hub logo.png" alt="logo" width="60" class="me-2" />
    <span class = "ent-care-hub-text">ENT Care Hub</span>
    </a>
    <div class = "call-us ms-auto ">🕿 Call us 01234 567890</div>
  </span>
  <a href="consultant-search.php">
  <button class="btn btn-primary ms-auto btn-lg">Search Consultants</button>
  </a>
  </nav>

  <div class="container consulting-cont">
  <div class="row one">
    <div class="col-sm-12 col-md-6 about-us">
      <div class="box about-us">
        <div class="box-title">About Us</div>
        <div class="box-description">
          ENT Care Hub is a leading private healthcare provider in the East Midlands, specialising in ENT (Ear, Nose,
          and Throat) health services. With a diverse team of highly skilled consultants across multiple specialties, ENT
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
  <div class="row two">
    <div class="col-sm-12 col-md-6 how-to">
      <div class="box how-to">
        <div class="box-title">How to Use ENT Care Hub</div>
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


<div class="row three">
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
      <!-- Avatar on the left -->
      <div class="me-3">
        <img src="avatar_man.png" class="img-fluid man" alt="avatar man" width="150">
      </div>

      <!-- Name and stars on the right -->
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