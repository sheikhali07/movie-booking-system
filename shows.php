<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | Add Shows</title>
  <!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
  <!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet">
	<script src="assets/js/pace.min.js"></script>

  <!--plugins-->
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/simplebar/css/simplebar.css">
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link href="assets/plugins/bs-stepper/css/bs-stepper.css" rel="stylesheet">
  <!--bootstrap css-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
  <!--main css-->
  <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
  <link href="sass/main.css" rel="stylesheet">
  <link href="sass/dark-theme.css" rel="stylesheet">
  <link href="sass/blue-theme.css" rel="stylesheet">
  <link href="sass/semi-dark.css" rel="stylesheet">
  <link href="sass/bordered-theme.css" rel="stylesheet">
  <link href="sass/responsive.css" rel="stylesheet">

</head>

<body>

  <!--start header-->
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>
  <!--end top header-->

  <!--start main wrapper-->
  <main class="main-wrapper">
    <div class="main-content">
      <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add Users</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
	
				</div>
			   
        <h6 class="text-uppercase">Shows</h6>
        <hr>
				<div id="stepper1" class="bs-stepper">
				  <div class="card">
					
					<div class="card-header">
						<div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
							<div class="step" data-target="#test-l-1">
							  <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
								<div class="bs-stepper-circle"><i class="material-icons-outlined">person</i></div>
								<div class="">
									<h5 class="mb-0 steper-title">Show Details</h5>
									<p class="mb-0 steper-sub-title">Enter Show Details</p>
								</div>
							  </div>
							</div>
							<div class="bs-stepper-line"></div>
							<div class="step" data-target="#test-l-2">
							
							<div class="bs-stepper-line"></div>
							<div class="step" data-target="#test-l-3">
								<div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
					
								</div>
							  </div>
							  <div class="bs-stepper-line"></div>
								<div class="step" data-target="#test-l-4">
								
								</div>
						  </div>
					 </div>
				    <div class="card-body">
					  <div class="bs-stepper-content">
					<?php
include 'partials/config.php';

// Fetch movies and theaters for dropdown
$movies = $conn->query("SELECT * FROM movies WHERE status = 'Active'");
$theaters = $conn->query("SELECT * FROM theaters WHERE status = 'Active'");
?>

<form method="POST" action="save_show" id="showForm">
  <div class="row g-3">

    <!-- Movie Select -->
    <div class="col-lg-6">
      <label class="form-label">Select Movie</label>
      <select name="movie_id" id="movie_id" class="form-select" required>
        <option value="">-- Select Movie --</option>
        <?php while($m = $movies->fetch_assoc()): ?>
          <option value="<?= $m['id']; ?>"><?= htmlspecialchars($m['title']); ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <!-- Theater Select -->
    <div class="col-lg-6">
      <label class="form-label">Select Theater</label>
      <select name="theater_id" id="theater_id" class="form-select" required>
        <option value="">-- Select Theater --</option>
        <?php while($t = $theaters->fetch_assoc()): ?>
          <option value="<?= $t['id']; ?>"><?= htmlspecialchars($t['name']); ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <!-- Show Date / Time -->
    <div class="col-lg-6">
      <label class="form-label">Show Date</label>
      <input type="date" name="show_date" class="form-control" required>
    </div>
    <div class="col-lg-6">
      <label class="form-label">Show Time</label>
      <input type="time" name="show_time" class="form-control" required>
    </div>

    <!-- Auto-Filled Movie Fields -->
    <div class="col-lg-3"><label>Genre</label><input type="text" name="genre" id="genre" class="form-control"></div>
    <div class="col-lg-3"><label>Language</label><input type="text" name="language" id="language" class="form-control"></div>
    <div class="col-lg-3"><label>Duration</label><input type="text" name="duration" id="duration" class="form-control"></div>
    <div class="col-lg-3"><label>Director</label><input type="text" name="director" id="director" class="form-control"></div>
    <div class="col-lg-3"><label>Cast</label><input type="text" name="cast" id="cast" class="form-control"></div>
    <div class="col-lg-3"><label>Rating</label><input type="text" name="rating" id="rating" class="form-control"></div>
    <div class="col-lg-3"><label>Poster Image URL</label><input type="text" name="poster_image" id="poster_image" class="form-control"></div>
    <div class="col-lg-3"><label>Trailer URL</label><input type="text" name="trailer_url" id="trailer_url" class="form-control"></div>

    <div class="col-12"><label>Description</label><textarea name="description" id="description" class="form-control"></textarea></div>
 
    <!-- Auto-Filled Theater Fields -->
    <div class="col-lg-3"><label>Normal Seats Total</label><input type="number" name="normal_seats_total" id="normal_seats_total" class="form-control"></div>
    <div class="col-lg-3"><label>Gold Seats Total</label><input type="number" name="gold_seats_total" id="gold_seats_total" class="form-control"></div>
    <div class="col-lg-3"><label>Platinum Seats Total</label><input type="number" name="platinum_seats_total" id="platinum_seats_total" class="form-control"></div>
    <div class="col-lg-3"><label>Box Seats Total</label><input type="number" name="box_seats_total" id="box_seats_total" class="form-control"></div>

    <div class="col-lg-3"><label>Normal Seats Available</label><input type="number" name="normal_seats_available" id="normal_seats_available" class="form-control"></div>
    <div class="col-lg-3"><label>Gold Seats Available</label><input type="number" name="gold_seats_available" id="gold_seats_available" class="form-control"></div>
    <div class="col-lg-3"><label>Platinum Seats Available</label><input type="number" name="platinum_seats_available" id="platinum_seats_available" class="form-control"></div>
    <div class="col-lg-3"><label>Box Seats Available</label><input type="number" name="box_seats_available" id="box_seats_available" class="form-control"></div>

    <div class="col-lg-6">
      <label>Status</label>
      <select name="status" class="form-select">
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
      </select>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-grd-primary px-4">Save Show</button>
    </div>
  </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Fetch movie details when selected
  $('#movie_id').on('change', function() {
    var movie_id = $(this).val();
    if (movie_id) {
      $.ajax({
        url: 'get_movie_details',
        type: 'POST',
        data: { movie_id: movie_id },
        dataType: 'json',
        success: function(data) {
          $('#genre').val(data.genre);
          $('#language').val(data.language);
          $('#duration').val(data.duration);
          $('#director').val(data.director);
          $('#cast').val(data.cast);
          $('#rating').val(data.rating);
          $('#description').val(data.description);
          $('#poster_image').val(data.poster_image);
          $('#trailer_url').val(data.trailer_url);
        }
      });
    }
  });

  // Fetch theater details when selected
  $('#theater_id').on('change', function() {
    var theater_id = $(this).val();
    if (theater_id) {
      $.ajax({
        url: 'get_theater_details',
        type: 'POST',
        data: { theater_id: theater_id },
        dataType: 'json',
        success: function(data) {
          $('#normal_seats_total').val(data.normal_seats);
          $('#gold_seats_total').val(data.gold_seats);
          $('#platinum_seats_total').val(data.platinum_seats);
          $('#box_seats_total').val(data.box_seats);
          $('#normal_seats_available').val(data.normal_seats);
          $('#gold_seats_available').val(data.gold_seats);
          $('#platinum_seats_available').val(data.platinum_seats);
          $('#box_seats_available').val(data.box_seats);
        }
      });
    }
  });
</script>


					  </div>
					   
					</div>
				   </div>
				 </div>
  
    </div>
  </main>
  <!--end main wrapper-->
    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->


  <!--bootstrap js-->
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <!--plugins-->
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/plugins/metismenu/metisMenu.min.js"></script>
  <script src="assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
	<script src="assets/plugins/bs-stepper/js/main.js"></script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/js/main.js"></script>


</body>

</html>