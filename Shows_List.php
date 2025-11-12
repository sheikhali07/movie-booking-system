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

</head>

<body>
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<?php
include 'partials/config.php';

// ✅ Corrected query: fetch shows + movies + theater details without conflicts
$sql = "
SELECT 
  s.id AS show_id,
  s.show_date,
  s.show_time,
  s.theater_id,
  m.id AS movie_id,
  m.title AS movie_title,
  m.genre,
  m.language,
  m.duration,
  m.director,
  m.cast,
  m.description AS movie_description,
  m.poster_image AS movie_poster,
  m.trailer_url,
  m.rating,
  t.name AS theater_name,
  t.city AS theater_city
FROM shows s
LEFT JOIN movies m ON s.movie_id = m.id
LEFT JOIN theaters t ON s.theater_id = t.id
ORDER BY s.show_date DESC
";

$result = $conn->query($sql);
?>

<main class="main-wrapper">
  <div class="main-content">
    
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Shows </div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <button type="button" class="btn btn-primary">Settings</button>
          <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
            <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
            <a class="dropdown-item" href="javascript:;">Action</a>
            <a class="dropdown-item" href="javascript:;">Another action</a>
            <a class="dropdown-item" href="javascript:;">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:;">Separated link</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-xl-2">
      <?php if ($result && $result->num_rows > 0) {
        while ($show = $result->fetch_assoc()) { ?>
          <div class="col">
            <div class="card rounded-4">
              <div class="row g-0 align-items-center">
                
                <!-- Poster Image -->
                <div class="col-md-4 border-end">
                  <div class="p-3 align-self-center">
                    <img src="uploads/posters/<?php echo htmlspecialchars($show['movie_poster']); ?>" 
                         class="w-100 rounded-start" 
                         alt="<?php echo htmlspecialchars($show['movie_title']); ?>">
                  </div>
                </div>

                <!-- Movie Info -->
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($show['movie_title']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($show['movie_description']); ?></p>
                  
                    <p>
                      <strong>Rating:</strong> <?php echo htmlspecialchars($show['rating']); ?>, <br>
                      <strong>Theater:</strong> <?php echo htmlspecialchars($show['theater_name']); ?>, 
                      <?php echo htmlspecialchars($show['theater_city']); ?><br>
                      <strong>Show Time:</strong> <?php echo htmlspecialchars($show['show_date']); ?> @ 
                      <?php echo htmlspecialchars($show['show_time']); ?>
                    </p> 
                    <div class="mt-4 d-flex align-items-center justify-content-between">
                      <a href="add-booking?
                      movie_id=<?php echo urlencode($show['movie_id']); ?>&
                      show_id=<?php echo urlencode($show['show_id']); ?>&"
                      class="btn btn-grd btn-grd-primary d-flex gap-2 px-3 border-0">
                      Add Booking
                    </a>

                      <div class="d-flex gap-1">
                        <a href="javascript:;" class="sharelink">
                          <i class="material-icons-outlined">favorite_border</i>
                        </a>
                        <?php if (!empty($show['trailer_url'])) { ?>
                          <a href="<?php echo htmlspecialchars($show['trailer_url']); ?>" target="_blank" class="sharelink">
                            <i class="material-icons-outlined">play_circle</i>
                          </a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
      <?php }
      } else { ?>
        <p>No shows released yet.</p>
      <?php } ?>
    </div><!--end row-->

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
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/js/main.js"></script>


</body>

</html>