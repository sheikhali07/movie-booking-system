<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | List Users</title>
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
  <!--bootstrap css-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
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
					<div class="breadcrumb-title pe-3">List Users</div>
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
      
   
				
				<h6 class="mb-0 text-uppercase">Users  </h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
						<?php
include 'partials/config.php';

// Fetch users from DB
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>
<table id="example2" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Age</th>
            <th>Country</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['first_name'] ?></td>
            <td><?= $row['last_name'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['email_address'] ?></td>
            <td><?= $row['age'] ?></td>
            <td><?= $row['country'] ?></td>
          <td>
  <div class="dropdown">
    <button class="btn btn-light dropdown-toggle" type="button" id="actionDropdown<?= $row['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
      Actions
    </button>
    <ul class="dropdown-menu" aria-labelledby="actionDropdown<?= $row['id']; ?>">
      <li>
        <a class="dropdown-item editBtn"
          href="javascript:void(0);"
          data-id="<?= $row['id']; ?>"
          data-first_name="<?= $row['first_name']; ?>"
          data-last_name="<?= $row['last_name']; ?>"
          data-username="<?= $row['username']; ?>"
          data-email="<?= $row['email_address']; ?>"
          data-phone="<?= $row['phone_number']; ?>"
          data-age="<?= $row['age']; ?>"
          data-country="<?= $row['country']; ?>"
          data-language="<?= $row['language']; ?>"
          data-user_type="<?= $row['user_type']; ?>"
          data-is_active="<?= $row['is_active']; ?>"
          data-is_admin="<?= $row['is_admin']; ?>"
          data-bs-toggle="modal" data-bs-target="#editModal">
          <i class="material-icons-outlined me-1" style="font-size:18px; vertical-align:middle;">edit</i> Edit
        </a>
      </li>
      <li>
        <a class="dropdown-item text-danger"
          href="delete_user?id=<?= $row['id']; ?>"
          onclick="return confirm('Are you sure you want to delete this user?')">
          <i class="material-icons-outlined me-1" style="font-size:18px; vertical-align:middle;">delete</i> Delete
        </a>
      </li>
    </ul>
  </div>
</td>

        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

						</div>
					</div>
				</div>

  <!-- Edit User Modal -->
<!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header border-bottom-0 py-2 bg-grd-info">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="edit_user" method="POST">
          <input type="hidden" name="id" id="edit_id">
          <div class="row g-3">
            
            <div class="col-md-6">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control" name="first_name" id="edit_first_name">
            </div>
            
            <div class="col-md-6">
              <label class="form-label">Last Name</label>
              <input type="text" class="form-control" name="last_name" id="edit_last_name">
            </div>
            
            <div class="col-md-6">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username" id="edit_username">
            </div>
            
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email_address" id="edit_email">
            </div>
            
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="edit_password" placeholder="Leave blank to keep">
            </div>
            
            <div class="col-md-6">
              <label class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="confirm_password" id="edit_confirm_password">
            </div>
            
            <div class="col-md-6">
              <label class="form-label">Age</label>
              <input type="number" class="form-control" name="age" id="edit_age">
            </div>
            
            <div class="col-md-6">
              <label class="form-label">Phone Number</label>
              <input type="text" class="form-control" name="phone_number" id="edit_phone">
            </div>

              <div class="col-md-6">
              <label class="form-label">Country</label>
              <input type="text" class="form-control" name="country" id="edit_country">
            </div>

          
            
            <div class="col-md-6">
              <label class="form-label">Language</label>
              <select name="language" class="form-select" id="edit_language">
                <option value="Urdu">Urdu</option>
                <option value="English">English</option>
                <option value="Chinese">Chinese</option>
                <option value="Spanish">Spanish</option>
              </select>
            </div>
            
            <div class="col-md-6">
              <label class="form-label">User Type</label>
              <select name="user_type" class="form-select" id="edit_user_type">
                <option value="Customer">Customer</option>
                <option value="Admin">Admin</option>
              </select>
            </div>
            
            <div class="col-md-3 d-flex align-items-center">
              <div class="form-check mt-3">
                <input type="checkbox" class="form-check-input" name="is_active" id="edit_is_active">
                <label class="form-check-label">Is Active</label>
              </div>
            </div>
            
            <div class="col-md-3 d-flex align-items-center">
              <div class="form-check mt-3">
                <input type="checkbox" class="form-check-input" name="is_admin" id="edit_is_admin">
                <label class="form-check-label">Is Admin</label>
              </div>
            </div>
            
          </div>
          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-grd-primary">Update</button>
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



  <!--start switcher-->

  <!--bootstrap js-->
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.editBtn').click(function() {
        var btn = $(this);
        $('#edit_id').val(btn.data('id'));
        $('#edit_first_name').val(btn.data('first_name'));
        $('#edit_last_name').val(btn.data('last_name'));
        $('#edit_username').val(btn.data('username'));
        $('#edit_email').val(btn.data('email'));
        $('#edit_phone').val(btn.data('phone'));
        $('#edit_age').val(btn.data('age'));
        $('#edit_country').val(btn.data('country'));
        $('#edit_language').val(btn.data('language'));
        $('#edit_user_type').val(btn.data('user_type'));
        $('#edit_is_active').prop('checked', btn.data('is_active') == 1);
        $('#edit_is_admin').prop('checked', btn.data('is_admin') == 1);
        // Password fields left empty intentionally
        $('#edit_password').val('');
        $('#edit_confirm_password').val('');
    });
});
</script>


  <!--plugins-->
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/plugins/metismenu/metisMenu.min.js"></script>
  <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
		  
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/js/main.js"></script>


</body>

</html>