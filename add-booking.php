<?php
session_start();
include 'partials/config.php';
include 'partials/header.php';
include 'partials/sidebar.php';

// ✅ Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: auth");
  exit();
}

// ✅ Get movie_id and show_id from URL
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;
$show_id = isset($_GET['show_id']) ? intval($_GET['show_id']) : 0;

$sql = "
SELECT 
  s.*,
  m.title AS movie_title, m.genre, m.language, m.duration, m.director, 
  m.cast, m.description AS movie_description, m.poster_image, m.trailer_url, m.rating,
  t.name AS theater_name, t.city AS theater_city, t.address, t.contact_number
FROM shows s
LEFT JOIN movies m ON s.movie_id = m.id
LEFT JOIN theaters t ON s.theater_id = t.id
WHERE s.id = $show_id AND m.id = $movie_id
";
$result = $conn->query($sql);
$show = $result->fetch_assoc();

if (!$show) {
  echo "<div class='alert alert-danger m-4'>Show not found.</div>";
  exit();
}

// ✅ Handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user_id'];
  $normal = intval($_POST['normal_seats']);
  $gold = intval($_POST['gold_seats']);
  $platinum = intval($_POST['platinum_seats']);
  $box = intval($_POST['box_seats']);

  $normal_price = 1500;
  $gold_price = 4500;
  $platinum_price = 3000;
  $box_price = 6000;

  $total_amount = ($normal * $normal_price) + ($gold * $gold_price) + ($platinum * $platinum_price) + ($box * $box_price);

  // ✅ Insert booking
  $stmt = $conn->prepare("INSERT INTO bookings (user_id, show_id, normal_seats_booked, gold_seats_booked, platinum_seats_booked, box_seats_booked, total_amount, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
  $stmt->bind_param("iiiiiid", $user_id, $show_id, $normal, $gold, $platinum, $box, $total_amount);

if ($stmt->execute()) {
  $_SESSION['msg'] = "Booking successful!";
  echo "<script>
    window.location.href = 'mybookings';
  </script>";
  exit();
}
 else {
  echo "<div class='alert alert-danger m-4'>Error: Could not save booking.</div>";
}

}
?>

<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | Releasded Shows</title>
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
<style>
    .movie-banner {
      display: flex;
      gap: 30px;
      background: #0f1535;
      border-radius: 15px;
      padding: 25px;
      align-items: center;
      margin-bottom: 30px;
    }
    .movie-banner img {
      border-radius: 10px;
      width: 220px;
      height: 330px;
      object-fit: cover;
    }
    .movie-banner h3 {
      font-weight: 600;
      color: #0d6efd;
    }
    .booking-card {
      background: #0f1535;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .seat-input {
      width: 100%;
      border: 1px solid grey;
      background-color: #0f1535;
      color: #fff;
      border-radius: 8px;
      padding: 8px;
    }
    .price-label {
      font-weight: 600;
      color: #ff0080 ;
    }
.review-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* ✅ 3 boxes per row */
  gap: 20px;
  margin-top: 20px;
}

.review-box {
  background: #1b2148;
  border: 1px solid #2b3470;
  border-radius: 12px;
  padding: 18px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.2);
  transition: transform 0.2s ease, box-shadow 0.3s ease;
}

.review-box:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 15px rgba(0,0,0,0.3);
}

.review-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.review-username {
  color: #0d6efd;
  font-weight: 600;
  font-size: 16px;
}

.review-stars {
  color: #ffcc00;
  font-size: 15px;
}

.review-text {
  color: #ddd;
  margin-top: 10px;
  font-size: 15px;
  line-height: 1.5;
}

.review-footer {
  text-align: right;
  margin-top: 10px;
}

.review-date {
  color: #aaa;
  font-size: 13px;
}

  </style>
</head>

<body>
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<main class="main-wrapper">
  <div class="main-content">
    <div class="container">

<div class="booking-card">
  <!-- ✅ Movie + Theater Details + Booking + Reviews in one box -->

  <!-- Movie Details -->
  <div class="movie-banner mb-4">
    <img src="uploads/posters/<?php echo htmlspecialchars($show['poster_image']); ?>" alt="Poster">
    <div>
      <h3><?php echo htmlspecialchars($show['movie_title']); ?></h3>
      <p><strong>Genre:</strong> <?php echo htmlspecialchars($show['genre']); ?> |
         <strong>Language:</strong> <?php echo htmlspecialchars($show['language']); ?></p>
      <p><strong>Director:</strong> <?php echo htmlspecialchars($show['director']); ?></p>
      <p><strong>Cast:</strong> <?php echo htmlspecialchars($show['cast']); ?></p>
      <p><strong>Theater:</strong> <?php echo htmlspecialchars($show['theater_name']); ?>, <?php echo htmlspecialchars($show['theater_city']); ?></p>
      <p><strong>Show Time:</strong> <?php echo htmlspecialchars($show['show_date']); ?> at <?php echo htmlspecialchars($show['show_time']); ?></p>
      <p><strong>Rating:</strong> ⭐ <?php echo htmlspecialchars($show['rating']); ?></p>
    </div>
  </div>

  <hr class="text-light">

  <!-- Booking Form -->
  <h4 class="mb-3 text-center">Book Your Seats</h4>
  <form method="POST" id="bookingForm">
    <div class="row g-3">
      <div class="col-md-3">
        <label>Normal Seats (1500)</label>
        <input type="number" class="seat-input" name="normal_seats" min="0" value="0">
      </div>
      <div class="col-md-3">
        <label>Gold Seats (4500)</label>
        <input type="number" class="seat-input" name="gold_seats" min="0" value="0">
      </div>
      <div class="col-md-3">
        <label>Platinum Seats (3000)</label>
        <input type="number" class="seat-input" name="platinum_seats" min="0" value="0">
      </div>
      <div class="col-md-3">
        <label>Box Seats (6000)</label>
        <input type="number" class="seat-input" name="box_seats" min="0" value="0">
      </div>

      <div class="col-md-12 mt-3">
        <h5>Total Amount: <span id="totalAmount" class="price-label">0</span> PKR</h5>
      </div>

      <div class="col-md-12 mt-3 text-end">
        <button type="submit" class="btn btn-grd btn-grd-primary px-4">Confirm Booking</button>
      </div>
    </div>
  </form>

  <hr class="text-light mt-5 mb-4">

  <!-- ✅ Review Section -->
  <?php
  $user_id = $_SESSION['user_id'];
  $has_booking = $conn->query("SELECT id FROM bookings WHERE user_id=$user_id AND show_id=$show_id")->num_rows > 0;

  if ($has_booking) {
      if (isset($_POST['submit_review'])) {
          $rating = intval($_POST['rating']);
          $review_text = $conn->real_escape_string($_POST['review_text']);
          $check = $conn->query("SELECT id FROM reviews WHERE user_id=$user_id AND show_id=$show_id");
          if ($check->num_rows > 0) {
              echo "<div class='alert alert-warning mt-3'>You’ve already submitted a review.</div>";
          } else {
              $stmt = $conn->prepare("INSERT INTO reviews (user_id, movie_id, show_id, review_text, rating) VALUES (?, ?, ?, ?, ?)");
              $stmt->bind_param('iiisi', $user_id, $movie_id, $show_id, $review_text, $rating);
              if ($stmt->execute()) echo "<div class='alert alert-success mt-3'>🎉 Review added successfully!</div>";
              else echo "<div class='alert alert-danger mt-3'>Error submitting review.</div>";
          }
      }
  ?>
  <h4 class="mb-3 mt-4 text-center">Your Review</h4>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Your Rating (1–5 ⭐)</label>
      <select name="rating" class="form-select" required>
        <option value="">Select rating</option>
        <option value="1">⭐</option>
        <option value="2">⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Your Review</label>
      <textarea name="review_text" class="form-control" rows="4" required></textarea>
    </div>
    <div class="text-end">
      <button type="submit" name="submit_review" class="btn btn-grd btn-grd-primary px-4">Submit Review</button>
    </div>
  </form>
  <?php } else {
      echo "<div class='alert alert-info mt-4'>You must book this show before submitting a review.</div>";
  } ?>

<hr class="text-light mt-5 mb-4">

<h4 class="mb-4 text-center text-uppercase">Audience Reviews</h4>
<?php
$reviews = $conn->query("SELECT r.*, u.username 
                         FROM reviews r 
                         JOIN users u ON r.user_id=u.id 
                         WHERE r.show_id=$show_id 
                         ORDER BY r.created_at DESC");
if ($reviews->num_rows > 0) {
    echo "<div class='review-grid'>";
    while ($rev = $reviews->fetch_assoc()) {
        echo "
        <div class='review-box'>
          <div class='review-header'>
            <strong class='review-username'>" . htmlspecialchars($rev['username']) . "</strong>
            <span class='review-stars'>" . str_repeat('⭐', $rev['rating']) . "</span>
          </div>
          <p class='review-text'>" . htmlspecialchars($rev['review_text']) . "</p>
          <div class='review-footer'>
            <small class='review-date'>" . date('F j, Y, g:i a', strtotime($rev['created_at'])) . "</small>
          </div>
        </div>
        ";
    }
    echo "</div>";
} else {
    echo "<p class='text-center text-secondary'>No reviews yet. Be the first to review!</p>";
}
?>

</div>


    </div>
  </div>
</main>



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
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/js/main.js"></script>
<script>
$(document).ready(function() {
  function calculateTotal() {
    const normal = $('input[name="normal_seats"]').val() * 1500;
    const gold = $('input[name="gold_seats"]').val() * 4500;
    const platinum = $('input[name="platinum_seats"]').val() * 3000;
    const box = $('input[name="box_seats"]').val() * 6000;
    const total = normal + gold + platinum + box;
    $('#totalAmount').text(total.toLocaleString());
  }
  $('input[type="number"]').on('input', calculateTotal);
});
</script>

</body>

</html>