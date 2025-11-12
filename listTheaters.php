<!doctype html>
<html lang="en" data-bs-theme="blue-theme">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | List Theaters</title>
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
  <link href="assets/css/pace.min.css" rel="stylesheet">
  <script src="assets/js/pace.min.js"></script>
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/simplebar/css/simplebar.css">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
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
<!--end header-->

<!--start sidebar-->
<?php include 'partials/sidebar.php'; ?>
<!--end sidebar-->

<!--start main wrapper-->
<main class="main-wrapper">
  <div class="main-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">List Theaters</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="dashboard"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>

    <h6 class="mb-0 text-uppercase">Theaters List</h6>
    <hr>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <?php
          include 'partials/config.php';
          $sql = "SELECT * FROM theaters";
          $result = $conn->query($sql);
          ?>
          <table id="example2" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>City</th>
                <th>Contact</th>
                <th>Normal</th>
                <th>Gold</th>
                <th>Platinum</th>
                <th>Box</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['city'] ?></td>
                <td><?= $row['contact_number'] ?></td>
                <td><?= $row['normal_seats'] ?></td>
                <td><?= $row['gold_seats'] ?></td>
                <td><?= $row['platinum_seats'] ?></td>
                <td><?= $row['box_seats'] ?></td>
                <td><?= $row['total_seats'] ?></td>
                <td>
                  <?php if($row['status'] == 'Active'): ?>
                    <span class="badge bg-success">Active</span>
                  <?php else: ?>
                    <span class="badge bg-danger">Inactive</span>
                  <?php endif; ?>
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Actions
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item editBtn"
                          href="javascript:void(0);"
                          data-id="<?= $row['id']; ?>"
                          data-name="<?= $row['name']; ?>"
                          data-city="<?= $row['city']; ?>"
                          data-address="<?= $row['address']; ?>"
                          data-contact_number="<?= $row['contact_number']; ?>"
                          data-email="<?= $row['email']; ?>"
                          data-normal_seats="<?= $row['normal_seats']; ?>"
                          data-gold_seats="<?= $row['gold_seats']; ?>"
                          data-platinum_seats="<?= $row['platinum_seats']; ?>"
                          data-box_seats="<?= $row['box_seats']; ?>"
                          data-total_seats="<?= $row['total_seats']; ?>"
                          data-status="<?= $row['status']; ?>"
                          data-bs-toggle="modal" data-bs-target="#editModal">
                          <i class="material-icons-outlined me-1" style="font-size:18px;vertical-align:middle;">edit</i> Edit
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item text-danger" href="delete_theater?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this theater?')">
                          <i class="material-icons-outlined me-1" style="font-size:18px;vertical-align:middle;">delete</i> Delete
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

    <!-- Edit Theater Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header border-bottom-0 py-2 bg-grd-info">
            <h5 class="modal-title">Edit Theater</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="edit_theater" method="POST">
              <input type="hidden" name="id" id="edit_id">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="edit_name">
                </div>
                <div class="col-md-6">
                  <label class="form-label">City</label>
                  <input type="text" class="form-control" name="city" id="edit_city">
                </div>
                <div class="col-md-12">
                  <label class="form-label">Address</label>
                  <textarea class="form-control" name="address" id="edit_address"></textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Contact Number</label>
                  <input type="text" class="form-control" name="contact_number" id="edit_contact_number">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="edit_email">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Normal Seats</label>
                  <input type="number" class="form-control" name="normal_seats" id="edit_normal_seats">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Gold Seats</label>
                  <input type="number" class="form-control" name="gold_seats" id="edit_gold_seats">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Platinum Seats</label>
                  <input type="number" class="form-control" name="platinum_seats" id="edit_platinum_seats">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Box Seats</label>
                  <input type="number" class="form-control" name="box_seats" id="edit_box_seats">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Total Seats</label>
                  <input type="number" class="form-control" name="total_seats" id="edit_total_seats" readonly>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select" id="edit_status">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
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

<div class="overlay btn-toggle"></div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('.editBtn').click(function() {
    var btn = $(this);
    $('#edit_id').val(btn.data('id'));
    $('#edit_name').val(btn.data('name'));
    $('#edit_city').val(btn.data('city'));
    $('#edit_address').val(btn.data('address'));
    $('#edit_contact_number').val(btn.data('contact_number'));
    $('#edit_email').val(btn.data('email'));
    $('#edit_normal_seats').val(btn.data('normal_seats'));
    $('#edit_gold_seats').val(btn.data('gold_seats'));
    $('#edit_platinum_seats').val(btn.data('platinum_seats'));
    $('#edit_box_seats').val(btn.data('box_seats'));
    $('#edit_total_seats').val(btn.data('total_seats'));
    $('#edit_status').val(btn.data('status'));
  });
});
</script>

<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/metismenu/metisMenu.min.js"></script>
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
  var table = $('#example2').DataTable({
    lengthChange: false,
    buttons: ['copy', 'excel', 'pdf', 'print']
  });
  table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
});
</script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
