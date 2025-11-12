<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | Add Theaters</title>
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
					<div class="breadcrumb-title pe-3">Add Theaters</div>
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
			   
        <h6 class="text-uppercase">Theaters</h6>
        <hr>
				<div id="stepper1" class="bs-stepper">
				  <div class="card">
					
					<div class="card-header">
						<div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
							<div class="step" data-target="#test-l-1">
							  <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
							<div class="bs-stepper-circle"><i class="material-icons-outlined">storefront</i></div>

								<div class="">
									<h5 class="mb-0 steper-title">Theaters Details </h5>
									<p class="mb-0 steper-sub-title">Enter Theaters Details</p>
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

					<form method="POST" action="save_theaters">
  <div class="row g-3">
    <div class="col-12 col-lg-6">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" placeholder="Name" required>
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">City</label>
      <input type="text" name="city" class="form-control" placeholder="City" required>
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Contact Number</label>
      <input type="text" name="contact_number" class="form-control" placeholder="Contact Number">
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>

    <div class="col-12 col-lg-6">
      <label class="form-label">Address</label>
      <input type="text" name="address" class="form-control" placeholder="Address" required>
    </div>

    <div class="col-12 col-lg-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="Active" selected>Active</option>
        <option value="inActive">InActive</option>
      </select>
    </div>

    <div class="col-12 col-lg-3">
      <label class="form-label">Total Seats</label>
      <input type="number" name="total_seats" id="total_seats" class="form-control" placeholder="Total Seats" readonly>
    </div>

    <div class="col-12 col-lg-3">
      <label class="form-label">Normal Seats</label>
      <input type="number" name="normal_seats" id="normal_seats" class="form-control seat-input" placeholder="Normal Seats">
    </div>

    <div class="col-12 col-lg-3">
      <label class="form-label">Gold Seats</label>
      <input type="number" name="gold_seats" id="gold_seats" class="form-control seat-input" placeholder="Gold Seats">
    </div>

    <div class="col-12 col-lg-3">
      <label class="form-label">Platinum Seats</label>
      <input type="number" name="platinum_seats" id="platinum_seats" class="form-control seat-input" placeholder="Platinum Seats">
    </div>

    <div class="col-12 col-lg-3">
      <label class="form-label">Box Seats</label>
      <input type="number" name="box_seats" id="box_seats" class="form-control seat-input" placeholder="Box Seats">
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-grd-primary px-4">Submit</button>
    </div>
  </div>
</form>

<!-- JavaScript to Auto Calculate Total -->
<script>
document.querySelectorAll('.seat-input').forEach(input => {
  input.addEventListener('input', calculateTotal);
});

function calculateTotal() {
  const normal = parseInt(document.getElementById('normal_seats').value) || 0;
  const gold = parseInt(document.getElementById('gold_seats').value) || 0;
  const platinum = parseInt(document.getElementById('platinum_seats').value) || 0;
  const box = parseInt(document.getElementById('box_seats').value) || 0;

  const total = normal + gold + platinum + box;
  document.getElementById('total_seats').value = total;
}
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