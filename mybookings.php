<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | My Bookings</title>
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

<?php include 'partials/header.php'; ?>
<?php
include 'partials/sidebarUser.php'; 
?>

<main class="main-wrapper">
  <div class="main-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">List Bookings</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>

    <h6 class="mb-0 text-uppercase">My Bookings</h6>
    <hr>

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
   <?php
include 'partials/config.php';

// ✅ Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id']; // Current logged-in user ID

$sql = "SELECT 
          b.id,
          u.username AS booked_by,
          m.title AS movie_name,
          t.name AS theater_name,
          s.show_date,
          s.show_time,
          b.normal_seats_booked,
          b.gold_seats_booked,
          b.platinum_seats_booked,
          b.box_seats_booked,
          b.total_amount,
          b.created_at
        FROM bookings b
        LEFT JOIN users u ON b.user_id = u.id
        LEFT JOIN shows s ON b.show_id = s.id
        LEFT JOIN movies m ON s.movie_id = m.id
        LEFT JOIN theaters t ON s.theater_id = t.id
        WHERE b.user_id = '$user_id'
        ORDER BY b.id DESC";

$result = $conn->query($sql);
?>

          <table id="example2" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Name </th>
                <th>Movie </th>
                <th>Theater </th>
                <th>S.Date</th>
                <th>Normal</th>
                <th>Gold</th>
                <th>Platinum</th>
                <th>Box</th>
                <th> Amount</th>
                <th>Booking </th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['booked_by'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['movie_name'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['theater_name'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['show_date'] ?? 'N/A') ?><?= htmlspecialchars($row['show_time'] ?? 'N/A') ?></td>
                <td><?= $row['normal_seats_booked'] ?></td>
                <td><?= $row['gold_seats_booked'] ?></td>
                <td><?= $row['platinum_seats_booked'] ?></td>
                <td><?= $row['box_seats_booked'] ?></td>
                <td><?= $row['total_amount'] ?></td>
                <td><?= $row['created_at'] ?></td>

              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</main>

<div class="overlay btn-toggle"></div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
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
