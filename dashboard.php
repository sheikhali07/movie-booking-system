<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<?php 
include 'partials/head.php'; 
include 'partials/config.php';
session_start();

// Current logged-in user
$user_id = $_SESSION['user_id'] ?? 0;

// Initialize variables
$first_name = $last_name = $phone_number = $age = $email_address = $country = $language = $username = "";

// Fetch user data
if ($user_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $phone_number = $user['phone_number'];
        $age = $user['age'];
        $email_address = $user['email_address'];
        $country = $user['country'];
        $language = $user['language'];
        $username = $user['username'];
    }
}
?>

<body>
  <!--start header-->
  <?php include 'partials/header.php'; ?>
  <!--end header-->

  <!--start sidebar-->
  <?php include 'partials/sidebarUser.php'; ?>
  <!--end sidebar-->

  <!--start main wrapper-->
  <main class="main-wrapper">
    <div class="main-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Analysis</li>
            </ol>
          </nav>
        </div>
      </div>
      <!--end breadcrumb-->

      <div class="row">
        <!-- Welcome & Stats Card -->
        <div class="col-xxl-8 d-flex align-items-stretch">
          <div class="card w-100 overflow-hidden rounded-4">
            <div class="card-body position-relative p-4">
              <div class="row">
                <div class="col-12 col-sm-7">
                  <div class="d-flex align-items-center gap-3 mb-5">
                    <img src="assets/images/avatars/01.png" class="rounded-circle bg-grd-info p-1"  width="60" height="60" alt="user">
                    <div class="">
                      <p class="mb-0 fw-semibold">Welcome back</p>
                      <h4 class="fw-semibold mb-0 fs-4"><?= htmlspecialchars($first_name) ?></h4>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-5">
                    <div class="d-flex align-items-center gap-4">
                      <?php
                      // Today's date
                      $today = date('Y-m-d');

                      // Fetch today's sales
                      $result = $conn->query("SELECT SUM(total_amount) AS today_sales FROM bookings WHERE DATE(created_at)='$today' AND user_id = '$user_id' ");
                      $row = $result->fetch_assoc();
                      $todaySales = $row['today_sales'] ?? 0;

                      // Fetch yesterday's sales
                      $yesterday = date('Y-m-d', strtotime('-1 day'));
                      $result = $conn->query("SELECT SUM(total_amount) AS yesterday_sales FROM bookings WHERE DATE(created_at)='$yesterday' AND user_id = '$user_id'");
                      $row = $result->fetch_assoc();
                      $yesterdaySales = $row['yesterday_sales'] ?? 0;

                      // Growth rate
                      $growthRate = $yesterdaySales > 0 ? (($todaySales - $yesterdaySales) / $yesterdaySales) * 100 : 0;
                      ?>
                      <!-- Today's Sales -->
                      <div class="flex-fill">
                        <h4 class="mb-1 fw-semibold d-flex align-items-center">
                          $<?= number_format($todaySales, 2) ?>
                          <i class="ti ti-arrow-up-right fs-5 lh-base text-success ms-2"></i>
                        </h4>
                        <p class="mb-3">Today Total Bookings </p>
                        <div class="progress mb-0" style="height:5px;">
                          <div class="progress-bar bg-grd-success" role="progressbar" style="width: 60%"></div>
                        </div>
                      </div>

                      <div class="vr"></div>

                      <!-- Growth Rate -->
                      <div class="flex-fill">
                        <h4 class="mb-1 fw-semibold d-flex align-items-center">
                          <?= number_format($growthRate, 1) ?>%
                          <i class="ti ti-arrow-up-right fs-5 lh-base text-success ms-2"></i>
                        </h4>
                        <p class="mb-3">Growth Rate</p>
                        <div class="progress mb-0" style="height:5px;">
                          <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-5">
                  <div class="welcome-back-img pt-4">
                     <img src="assets/images/gallery/welcome-back-3.png" height="180" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Bookings -->
        <?php 
        $bookingsQuery = $conn->query("
            SELECT b.*, m.title AS movie_title, s.show_date, s.show_time, t.name AS theater_name
            FROM bookings b
            JOIN shows s ON b.show_id = s.id
            JOIN movies m ON s.movie_id = m.id
            JOIN theaters t ON s.theater_id = t.id
            WHERE b.user_id = $user_id
            ORDER BY b.created_at DESC
            LIMIT 5
        "); 
        ?>
        <div class="col-lg-12 col-xxl-8 d-flex align-items-stretch mt-4">
          <div class="card w-100 rounded-4">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between mb-3">
                <h5 class="mb-0">My Bookings</h5>
                <div class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle" data-bs-toggle="dropdown">
                      <span class="material-icons-outlined fs-5">more_vert</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                  </ul>
                </div>
              </div>

              <div class="order-search position-relative my-3">
                <input class="form-control rounded-5 px-5" type="text" placeholder="Search" id="bookingSearch">
                <span class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
              </div>

              <div class="table-responsive">
                <table class="table align-middle" id="recentBookingsTable">
                  <thead>
                    <tr>
                      <th>Theater</th>
                      <th>Seats</th>
                      <th>Total Amount</th>
                      <th>Booking Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($bookingsQuery->num_rows > 0): ?>
                        <?php while($row = $bookingsQuery->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['theater_name']) ?></td>
                                <td>
                                    N: <?= $row['normal_seats_booked'] ?>,
                                    G: <?= $row['gold_seats_booked'] ?>,
                                    P: <?= $row['platinum_seats_booked'] ?>,
                                    B: <?= $row['box_seats_booked'] ?>
                                </td>
                                <td>$<?= number_format($row['total_amount'],2) ?></td>
                                <td><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center">No bookings found.</td></tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <script>
        // Client-side search
        document.getElementById('bookingSearch').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('#recentBookingsTable tbody tr').forEach(tr => {
                tr.style.display = tr.textContent.toLowerCase().includes(filter) ? '' : 'none';
            });
        });
        </script>

        <!-- User Profile Update Form -->
        <div class="col-xxl-8 d-flex align-items-stretch mt-4">
          <div class="card w-100 rounded-4">
            <div class="card-header">
              <h5 class="mb-0">Update Profile</h5>
            </div>
            <div class="card-body">
              <form method="POST" action="profile">
                <input type="hidden" name="id" value="<?= $user_id ?>">
                <div class="row g-3">
                  <div class="col-12 col-lg-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($first_name) ?>" required>
                  </div>
                  <div class="col-12 col-lg-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($last_name) ?>" required>
                  </div>
                  <div class="col-12 col-lg-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" value="<?= htmlspecialchars($phone_number) ?>">
                  </div>
                  <div class="col-12 col-lg-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($age) ?>">
                  </div>
                  <div class="col-12 col-lg-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email_address" class="form-control" value="<?= htmlspecialchars($email_address) ?>" required>
                  </div>
                  <div class="col-12 col-lg-4">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($country) ?>">
                  </div>
                  <div class="col-12 col-lg-4">
                    <label class="form-label">Language</label>
                    <select name="language" class="form-select">
                      <option value="">---</option>
                      <option value="Urdu" <?= $language=="Urdu" ? "selected" : "" ?>>Urdu</option>
                      <option value="English" <?= $language=="English" ? "selected" : "" ?>>English</option>
                      <option value="Chinese" <?= $language=="Chinese" ? "selected" : "" ?>>Chinese</option>
                      <option value="Spanish" <?= $language=="Spanish" ? "selected" : "" ?>>Spanish</option>
                    </select>
                  </div>
                  <div class="col-12 col-lg-4">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($username) ?>" required>
                  </div>
                  <div class="col-12 col-lg-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <small>Leave blank if you don't want to change password</small>
                  </div>
                  <div class="col-12 col-lg-4">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required >
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-grd-primary px-4">Update Profile</button>
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

  <div class="overlay btn-toggle"></div>

  <!--start footer-->
  <footer class="page-footer">
    <p class="mb-0">Copyright © 2025. All right reserved.</p>
  </footer>
  <!--end footer-->

  <!-- Scripts -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/plugins/metismenu/metisMenu.min.js"></script>
  <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/plugins/peity/jquery.peity.min.js"></script>
  <script>
    $(".data-attributes span").peity("donut")
    new PerfectScrollbar(".user-list")
  </script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/dashboard1.js"></script>

</body>
</html>
