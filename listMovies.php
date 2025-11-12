<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | List Movies</title>
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
					<div class="breadcrumb-title pe-3">List Movies</div>
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
      
   
				
				<h6 class="mb-0 text-uppercase">Movies  </h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
<?php
include 'partials/config.php';

$sql = "SELECT id, title, genre, language, duration, release_date, director, cast, description, trailer_url, poster_image, rating, status, created_at, updated_at, movie_status FROM movies";
$result = $conn->query($sql);
?>
<table id="example2" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Title</th>
      <th>Genre</th>
      <th>Language</th>
      <th>Duration</th>
      <th>Release Date</th>
      <th>Director</th>
      <th>Rating</th>
      <th>Movie Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['title']); ?></td>
      <td><?= htmlspecialchars($row['genre']); ?></td>
      <td><?= htmlspecialchars($row['language']); ?></td>
      <td><?= htmlspecialchars($row['duration']); ?> min</td>
      <td><?= htmlspecialchars($row['release_date']); ?></td>
      <td><?= htmlspecialchars($row['director']); ?></td>
      <td><?= htmlspecialchars($row['rating']); ?>/10</td>
      <td><span class="badge bg-info"><?= htmlspecialchars($row['movie_status']); ?></span></td>
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
                data-title="<?= htmlspecialchars($row['title']); ?>"
                data-genre="<?= htmlspecialchars($row['genre']); ?>"
                data-language="<?= htmlspecialchars($row['language']); ?>"
                data-duration="<?= htmlspecialchars($row['duration']); ?>"
                data-release_date="<?= htmlspecialchars($row['release_date']); ?>"
                data-director="<?= htmlspecialchars($row['director']); ?>"
                data-cast="<?= htmlspecialchars($row['cast']); ?>"
                data-description="<?= htmlspecialchars($row['description']); ?>"
                data-trailer_url="<?= htmlspecialchars($row['trailer_url']); ?>"
                data-poster_image="<?= htmlspecialchars($row['poster_image']); ?>"
                data-rating="<?= htmlspecialchars($row['rating']); ?>"
                data-status="<?= htmlspecialchars($row['status']); ?>"
                data-movie_status="<?= htmlspecialchars($row['movie_status']); ?>"
                data-bs-toggle="modal" data-bs-target="#editMovieModal">
                <i class="material-icons-outlined me-1" style="font-size:18px;">edit</i> Edit
              </a>
            </li>
            <li>
              <a class="dropdown-item text-danger"
                href="delete_movie?id=<?= $row['id']; ?>"
                onclick="return confirm('Are you sure you want to delete this movie?')">
                <i class="material-icons-outlined me-1" style="font-size:18px;">delete</i> Delete
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

  <!-- Edit movie Modal -->
<div class="modal fade" id="editMovieModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-grd-info py-2">
        <h5 class="modal-title">Edit Movie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="edit_movie" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" id="edit_id">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="edit_title" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Genre</label>
              <input type="text" class="form-control" name="genre" id="edit_genre">
            </div>

            <div class="col-md-6">
              <label class="form-label">Language</label>
              <input type="text" class="form-control" name="language" id="edit_language">
            </div>

            <div class="col-md-6">
              <label class="form-label">Duration (min)</label>
              <input type="number" class="form-control" name="duration" id="edit_duration">
            </div>

            <div class="col-md-6">
              <label class="form-label">Release Date</label>
              <input type="date" class="form-control" name="release_date" id="edit_release_date">
            </div>

            <div class="col-md-6">
              <label class="form-label">Director</label>
              <input type="text" class="form-control" name="director" id="edit_director">
            </div>

            <div class="col-md-12">
              <label class="form-label">Cast</label>
              <textarea class="form-control" name="cast" id="edit_cast"></textarea>
            </div>

            <div class="col-md-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" name="description" id="edit_description"></textarea>
            </div>

            <div class="col-md-6">
              <label class="form-label">Trailer URL</label>
              <input type="url" class="form-control" name="trailer_url" id="edit_trailer_url">
            </div>

            <div class="col-md-6">
              <label class="form-label">Poster Image</label>
              <input type="file" class="form-control" name="poster_image">
              <img id="current_poster" src="" alt="Poster" class="img-fluid mt-2 rounded" width="80">
            </div>

            <div class="col-md-6">
              <label class="form-label">Rating</label>
              <input type="number" step="0.1" class="form-control" name="rating" id="edit_rating">
            </div>

            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select name="status" class="form-select" id="edit_status">
  <option value="Active">Active</option>
  <option value="Inactive">Inactive</option>
</select>

            </div>

            <div class="col-md-6">
              <label class="form-label">Movie Status</label>
              <select name="movie_status" class="form-select" id="edit_movie_status">
                <option value="Coming Soon">Coming Soon</option>
                <option value="Released">Released</option>
              </select>
            </div>
          </div>

          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-grd-primary">Update Movie</button>
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
    $('#edit_title').val(btn.data('title'));
    $('#edit_genre').val(btn.data('genre'));
    $('#edit_language').val(btn.data('language'));
    $('#edit_duration').val(btn.data('duration'));
    $('#edit_release_date').val(btn.data('release_date'));
    $('#edit_director').val(btn.data('director'));
    $('#edit_cast').val(btn.data('cast'));
    $('#edit_description').val(btn.data('description'));
    $('#edit_trailer_url').val(btn.data('trailer_url'));
    $('#current_poster').attr('src', 'uploads/posters/' + btn.data('poster_image'));
    $('#edit_rating').val(btn.data('rating'));

    // Status dropdown fix (case-insensitive match)
    $('#edit_status option').each(function(){
      if ($(this).val().toLowerCase() == btn.data('status').toString().toLowerCase()) {
        $(this).prop('selected', true);
      }
    });

    // Movie status dropdown fix
    $('#edit_movie_status option').each(function(){
      if ($(this).val().toLowerCase() == btn.data('movie_status').toString().toLowerCase()) {
        $(this).prop('selected', true);
      }
    });
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