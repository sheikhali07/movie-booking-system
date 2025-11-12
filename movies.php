<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | Add Movies</title>
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
  <!--end top header-->


  <!--start sidebar-->
<?php include 'partials/sidebar.php'; ?>
<!--end sidebar-->


  <!--start main wrapper-->
  <main class="main-wrapper">
    <div class="main-content">
      <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add Movies</div>
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
				<!--end breadcrumb-->
      


        <!--start stepper one--> 
			   
        <h6 class="text-uppercase">Movies</h6>
        <hr>
				<div id="stepper1" class="bs-stepper">
				  <div class="card">
					
					<div class="card-header">
						<div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
							<div class="step" data-target="#test-l-1">
							  <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
								<div class="bs-stepper-circle"><i class="material-icons-outlined">person</i></div>
								<div class="">
									<h5 class="mb-0 steper-title">Movies Details</h5>
									<p class="mb-0 steper-sub-title">Enter Your Movies Details</p>
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
<form method="POST" action="save_movie" enctype="multipart/form-data">
  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <label class="form-label">Movie Title</label>
      <input type="text" name="title" class="form-control" placeholder="Enter movie title" required>
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Genre</label>
      <input type="text" name="genre" class="form-control" placeholder="Enter genre (e.g. Action, Comedy)">
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Language</label>
      <select name="language" class="form-select" required>
        <option value="">Select Language</option>
        <option value="English">English</option>
        <option value="Urdu">Urdu</option>
        <option value="Hindi">Hindi</option>
        <option value="Chinese">Chinese</option>
        <option value="Spanish">Spanish</option>
      </select>
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Duration (in minutes)</label>
      <input type="number" name="duration" class="form-control" placeholder="e.g. 120">
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Release Date</label>
      <input type="date" name="release_date" class="form-control">
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Director</label>
      <input type="text" name="director" class="form-control" placeholder="Director name">
    </div>

    <div class="col-12">
      <label class="form-label">Cast</label>
      <textarea name="cast" class="form-control" rows="2" placeholder="Enter main cast names"></textarea>
    </div>

    <div class="col-12">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3" placeholder="Brief movie description"></textarea>
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Trailer URL</label>
      <input type="url" name="trailer_url" class="form-control" placeholder="https://youtube.com/...">
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Poster Image</label>
      <input type="file" name="poster_image" class="form-control" accept="image/*">
    </div>

    <div class="col-12 col-lg-4">
      <label class="form-label">Rating</label>
      <input type="number" step="0.1" min="0" max="10" name="rating" class="form-control" placeholder="e.g. 8.5">
    </div>

    <div class="col-12 col-lg-4">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="Active" selected>Active</option>
        <option value="Inactive">Inactive</option>
      </select>
    </div>

    <div class="col-12 col-lg-4">
      <label class="form-label">Movie Status</label>
      <select name="movie_status" class="form-select">
        <option value="Coming Soon">Coming Soon</option>
        <option value="Released">Released</option>
 
      </select>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-grd-primary px-4">Save Movie</button>
    </div>

  </div>
</form>


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