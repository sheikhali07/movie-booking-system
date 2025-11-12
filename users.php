<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | Add Users</title>
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
				<!--end breadcrumb-->
      


        <!--start stepper one--> 
			   
        <h6 class="text-uppercase">Users</h6>
        <hr>
				<div id="stepper1" class="bs-stepper">
				  <div class="card">
					
					<div class="card-header">
						<div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
							<div class="step" data-target="#test-l-1">
							  <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
								<div class="bs-stepper-circle"><i class="material-icons-outlined">person</i></div>
								<div class="">
									<h5 class="mb-0 steper-title">Personal Details Of Users</h5>
									<p class="mb-0 steper-sub-title">Enter Users Details</p>
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
						<form method="POST" action="save_user">
  <div class="row g-3">
    <div class="col-12 col-lg-6">
      <label class="form-label">First Name</label>
      <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
    </div>
    <div class="col-12 col-lg-6">
      <label class="form-label">Last Name</label>
      <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
    </div>
    <div class="col-12 col-lg-6">
      <label class="form-label">Phone Number</label>
      <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
    </div>
    <div class="col-12 col-lg-6">
      <label class="form-label">Email Address</label>
      <input type="email" name="email_address" class="form-control" placeholder="Email Address" required>
    </div>
    <div class="col-12 col-lg-6">
      <label class="form-label">Country</label>
      <input type="text" name="country" class="form-control" placeholder="Country" >
    </div>
  
    <div class="col-12 col-lg-6">
      <label class="form-label">Language</label>
      <select name="language" class="form-select">
        <option value="">---</option>
        <option value="Urdu">Urdu</option>
        <option value="English">English</option>
        <option value="Chinese">Chinese</option>
        <option value="Spanish">Spanish</option>
      </select>
    </div>
    <div class="col-12 col-lg-6">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
    <div class="col-12 col-lg-6">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="col-12 col-lg-6">
      <label class="form-label">Confirm Password</label>
      <input type="password" name="confirm_password" class="form-control" required>
    </div>
    <div class="col-12 col-lg-3">
      <label class="form-label">Age</label>
      <input type="number" name="age" class="form-control" placeholder="Age">
    </div>
    <div class="col-12 col-lg-3">
      <label class="form-label">User Type</label>
      <select name="user_type" class="form-select">
        <option value="Customer" selected>Customer</option>
        <option value="Admin">Admin</option>
      </select>
    </div>
    <div class="col-12 col-lg-3">
      <label class="form-label">Is Active</label>
      <select name="is_active" class="form-select">
        <option value="1" selected>Yes</option>
        <option value="0">No</option>
      </select>
    </div>
    <div class="col-12 col-lg-3">
      <label class="form-label">Is Admin</label>
      <select name="is_admin" class="form-select">
        <option value="0" selected>No</option>
        <option value="1">Yes</option>
      </select>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-grd-primary px-4">Submit</button>
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