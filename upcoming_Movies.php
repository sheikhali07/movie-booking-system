<!doctype html>
<html lang="en" data-bs-theme="blue-theme">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySey | Upcoming Movies</title>
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
  <link href="assets/css/pace.min.css" rel="stylesheet">
  <script src="assets/js/pace.min.js"></script>
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/simplebar/css/simplebar.css">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
  <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
  <link href="sass/main.css" rel="stylesheet">
  <link href="sass/dark-theme.css" rel="stylesheet">
  <link href="sass/blue-theme.css" rel="stylesheet">
  <link href="sass/semi-dark.css" rel="stylesheet">
  <link href="sass/bordered-theme.css" rel="stylesheet">
  <link href="sass/responsive.css" rel="stylesheet">

  <style>
    .play-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 60px;
      color: white;
      cursor: pointer;
      opacity: 0.8;
      transition: 0.3s;
    }
    .play-icon:hover {
      opacity: 1;
      color: #ff4c4c;
    }
  </style>
</head>

<body>

<?php include 'partials/header.php'; ?>


<?php include 'partials/sidebarUser.php'; ?>

<main class="main-wrapper">
  <div class="main-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Movies</div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
      <?php
      include 'partials/config.php';
      $query = "SELECT * FROM movies WHERE status = 'Active'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <div class="col">
        <div class="card rounded-4 shadow-lg border-0 position-relative">
          <img src="uploads/posters/<?php echo $row['poster_image']; ?>" class="card-img rounded-4" alt="<?php echo $row['title']; ?>">
          
          <!-- Play Icon -->
          <span class="material-icons-outlined play-icon" data-trailer="<?php echo $row['trailer_url']; ?>">play_circle</span>

          <div class="card-img-overlay d-flex flex-column justify-content-end" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
            <p class="mb-1 text-white text-uppercase small"><?php echo $row['genre']; ?> | <?php echo $row['language']; ?></p>
            <h4 class="card-title text-white fw-bold mb-1"><?php echo $row['title']; ?></h4>
            <p class="text-white small mb-2">Directed by <?php echo $row['director']; ?><br>
              Rating: ⭐ <?php echo $row['rating']; ?>/10</p>
            <p class="text-white small mb-2">
              Status: <span class="badge bg-info text-dark"><?php echo $row['movie_status']; ?></span><br>
              Release: <?php echo date('d M Y', strtotime($row['release_date'])); ?>
            </p>
          </div>

          <div class="bottom-0 position-absolute m-3">
            <button class="btn btn-light px-3  d-flex gap-2 align-items-center readMoreBtn"
              data-id="<?php echo $row['id']; ?>"
              data-title="<?php echo htmlspecialchars($row['title']); ?>"
              data-genre="<?php echo htmlspecialchars($row['genre']); ?>"
              data-language="<?php echo htmlspecialchars($row['language']); ?>"
              data-duration="<?php echo htmlspecialchars($row['duration']); ?>"
              data-release_date="<?php echo htmlspecialchars($row['release_date']); ?>"
              data-director="<?php echo htmlspecialchars($row['director']); ?>"
              data-cast="<?php echo htmlspecialchars($row['cast']); ?>"
              data-description="<?php echo htmlspecialchars($row['description']); ?>"
              data-trailer_url="<?php echo htmlspecialchars($row['trailer_url']); ?>"
              data-poster="uploads/posters/<?php echo htmlspecialchars($row['poster_image']); ?>"
              data-rating="<?php echo htmlspecialchars($row['rating']); ?>"
              data-status="<?php echo htmlspecialchars($row['movie_status']); ?>">
              More Details <span class="material-icons-outlined">east</span>
            </button>
          </div>
        </div>
      </div>
      <?php
        }
      } else {
        echo "<p class='text-center'>No movies found.</p>";
      }
      ?>
    </div>
  </div>
</main>

<!-- Movie Detail Modal -->
<div class="modal fade" id="movieDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-grd-info text-white">
        <h5 class="modal-title" id="movieTitle"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-5">
            <img id="moviePoster" src="" alt="Poster" class="img-fluid rounded-3 shadow">
          </div>
          <div class="col-md-7">
            <p style="font-size:16px;"  ><strong>Genre:</strong> <span id="movieGenre"></span></p>
            <p style="font-size:16px;" ><strong>Language:</strong> <span id="movieLanguage"></span></p>
            <p style="font-size:16px;" ><strong>Duration:</strong> <span id="movieDuration"></span> mins</p>
            <p style="font-size:16px;" ><strong>Release Date:</strong> <span id="movieRelease"></span></p>
            <p style="font-size:16px;" ><strong>Director:</strong> <span id="movieDirector"></span></p>
            <p style="font-size:16px;" ><strong>Cast:</strong> <span id="movieCast"></span></p>
            <p style="font-size:16px;" ><strong>Rating:</strong> ⭐ <span id="movieRating"></span>/10</p>
            <p style="font-size:16px;" ><strong>Status:</strong> <span class="badge bg-info text-dark" id="movieStatus"></span></p>
            <p style="font-size:16px;" ><strong>Description:</strong></p>
            <p style="font-size:16px;"  id="movieDescription"></p>
<button id="watchTrailerBtn" class="btn btn-danger mt-3 px-4 py-2  shadow-sm">
              <span class="material-icons-outlined align-middle me-1">play_circle</span> Watch Trailer
            </button>          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  
</style>

<!-- Trailer Modal -->
<div class="modal fade" id="trailerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-body p-0">
        <iframe id="trailerFrame" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>

<div class="overlay btn-toggle"></div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/metismenu/metisMenu.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/js/main.js"></script>

<script>
$(document).ready(function() {
  // Read More modal
  $('.readMoreBtn').on('click', function() {
    $('#movieTitle').text($(this).data('title'));
    $('#movieGenre').text($(this).data('genre'));
    $('#movieLanguage').text($(this).data('language'));
    $('#movieDuration').text($(this).data('duration'));
    $('#movieRelease').text($(this).data('release_date'));
    $('#movieDirector').text($(this).data('director'));
    $('#movieCast').text($(this).data('cast'));
    $('#movieDescription').text($(this).data('description'));
    $('#moviePoster').attr('src', $(this).data('poster'));
    $('#movieRating').text($(this).data('rating'));
    $('#movieStatus').text($(this).data('status'));
    $('#watchTrailerBtn').data('trailer', $(this).data('trailer_url'));
    $('#movieDetailModal').modal('show');
  });

  // Play trailer
  $(document).on('click', '.play-icon, #watchTrailerBtn', function() {
    var url = $(this).data('trailer');
    if (url.includes('youtube.com') || url.includes('youtu.be')) {
      url = url.replace("watch?v=", "embed/");
    }
    $('#trailerFrame').attr('src', url);
    $('#trailerModal').modal('show');
  });

  // Stop trailer on close
  $('#trailerModal').on('hidden.bs.modal', function() {
    $('#trailerFrame').attr('src', '');
  });
});
</script>
</body>
</html>
