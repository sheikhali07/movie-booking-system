<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkySet | List Shows</title>
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
  <link href="assets/css/pace.min.css" rel="stylesheet">
  <script src="assets/js/pace.min.js"></script>

  <!--plugins-->
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
<?php include 'partials/sidebar.php'; ?>

<main class="main-wrapper">
  <div class="main-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">List Shows</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>

    <h6 class="mb-0 text-uppercase">Shows</h6>
    <hr>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <?php
          include 'partials/config.php';
          $sql = "SELECT s.*, m.title AS movie_title, t.name AS theater_name
                  FROM shows s
                  LEFT JOIN movies m ON s.movie_id = m.id
                  LEFT JOIN theaters t ON s.theater_id = t.id";
          $result = $conn->query($sql);
          ?>
          <table id="example2" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Movie</th>
                <th>Theater</th>
                <th>Show Date</th>
                <th>Show Time</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['movie_title']); ?></td>
                <td><?= htmlspecialchars($row['theater_name']); ?></td>
                <td><?= $row['show_date']; ?></td>
                <td><?= $row['show_time']; ?></td>
                <td><?= $row['status']; ?></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="actionDropdown<?= $row['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                    <ul class="dropdown-menu" aria-labelledby="actionDropdown<?= $row['id']; ?>">
                      <li>
                        <a class="dropdown-item editShowBtn"
                          href="javascript:void(0);"
                          data-id="<?= $row['id']; ?>"
                          data-movie_id="<?= $row['movie_id']; ?>"
                          data-theater_id="<?= $row['theater_id']; ?>"
                          data-show_date="<?= $row['show_date']; ?>"
                          data-show_time="<?= $row['show_time']; ?>"
                          data-status="<?= $row['status']; ?>"
                          data-bs-toggle="modal" data-bs-target="#editShowModal">
                          <i class="material-icons-outlined me-1" style="font-size:18px;">edit</i> Edit
                        </a>
                      </li>
                         <li>
        <a class="dropdown-item text-danger"
          href="delete_show?id=<?= $row['id']; ?>"
          onclick="return confirm('Are you sure you want to delete this Show?')">
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

    <!-- Edit Show Modal -->
    <div class="modal fade" id="editShowModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header border-bottom-0 py-2 bg-grd-info">
            <h5 class="modal-title">Edit Show</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="edit_show" method="POST">
              <input type="hidden" name="id" id="edit_show_id">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Movie</label>
                  <select name="movie_id" id="edit_movie_id" class="form-select">
                    <option value="">Select Movie</option>
                    <?php
                    $movies = $conn->query("SELECT * FROM movies WHERE status='Active'");
                    while($m = $movies->fetch_assoc()):
                    ?>
                    <option value="<?= $m['id']; ?>"><?= htmlspecialchars($m['title']); ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Theater</label>
                  <select name="theater_id" id="edit_theater_id" class="form-select">
                    <option value="">Select Theater</option>
                    <?php
                    $theaters = $conn->query("SELECT * FROM theaters WHERE status='Active'");
                    while($t = $theaters->fetch_assoc()):
                    ?>
                    <option value="<?= $t['id']; ?>"><?= htmlspecialchars($t['name']); ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Show Date</label>
                  <input type="date" class="form-control" name="show_date" id="edit_show_date">
                </div>

                <div class="col-md-3">
                  <label class="form-label">Show Time</label>
                  <input type="time" class="form-control" name="show_time" id="edit_show_time">
                </div>

                <div class="col-md-3">
                  <label class="form-label">Status</label>
                  <select name="status" id="edit_status" class="form-select">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                </div>

                <!-- Additional fields for movie details -->
                <div class="col-md-3">
                  <label class="form-label">Genre</label>
                  <input type="text" class="form-control" id="edit_genre" readonly>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Language</label>
                  <input type="text" class="form-control" id="edit_language" readonly>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Director</label>
                  <input type="text" class="form-control" id="edit_director" readonly>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Cast</label>
                  <input type="text" class="form-control" id="edit_cast" readonly>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Rating</label>
                  <input type="text" class="form-control" id="edit_rating" readonly>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Duration</label>
                  <input type="text" class="form-control" id="edit_duration" readonly>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Poster Image</label>
                  <input type="text" class="form-control" id="edit_poster_image" readonly>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Trailer Url</label>
                  <input type="text" class="form-control" id="edit_trailer_url" readonly>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Description</label>
                  <textarea class="form-control" id="edit_description" readonly></textarea>
                </div>

                <!-- Theater seats -->
                <div class="col-md-3">
                  <label class="form-label">Normal Seats Total</label>
                  <input type="number" class="form-control" id="edit_normal_seats_total" name="normal_seats_total" readonly>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Gold Seats Total</label>
                  <input type="number" class="form-control" id="edit_gold_seats_total" name="gold_seats_total" readonly>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Platinum Seats Total</label>
                  <input type="number" class="form-control" id="edit_platinum_seats_total" name="platinum_seats_total" readonly>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Box Seats Total</label>
                  <input type="number" class="form-control" id="edit_box_seats_total" name="box_seats_total" readonly>
                </div>
              <div class="col-md-3">
                <label class="form-label">Normal Seats Available</label>
                <input type="number" class="form-control" id="edit_normal_seats_available" name="normal_seats_available" >
              </div>
              <div class="col-md-3">
                <label class="form-label">Gold Seats Available</label>
                <input type="number" class="form-control" id="edit_gold_seats_available" name="gold_seats_available" >
              </div>
              <div class="col-md-3">
                <label class="form-label">Platinum Seats Available</label>
                <input type="number" class="form-control" id="edit_platinum_seats_available" name="platinum_seats_available" >
              </div>
              <div class="col-md-3">
                <label class="form-label">Box Seats Available</label>
                <input type="number" class="form-control" id="edit_box_seats_available" name="box_seats_available">
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

<div class="overlay btn-toggle"></div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
    function loadMovieDetails(movie_id){
        if(!movie_id) return;
        $.ajax({
            url:'get_movie_details',
            type:'POST',
            data:{movie_id:movie_id},
            dataType:'json',
            success:function(res){
                $('#edit_genre').val(res.genre);
                $('#edit_language').val(res.language);
                $('#edit_director').val(res.director);
                $('#edit_cast').val(res.cast);
                $('#edit_rating').val(res.rating);
                $('#edit_duration').val(res.duration);
                $('#edit_poster_image').val(res.poster_image);
                $('#edit_trailer_url').val(res.trailer_url);
                $('#edit_description').val(res.description);
            }
        });
    }
function loadTheaterDetails(theater_id){
    if(!theater_id) return;
    $.ajax({
        url:'get_theater_details',
        type:'POST',
        data:{theater_id:theater_id},
        dataType:'json',
        success:function(res){
            $('#edit_normal_seats_total').val(res.normal_seats);
            $('#edit_gold_seats_total').val(res.gold_seats);
            $('#edit_platinum_seats_total').val(res.platinum_seats);
            $('#edit_box_seats_total').val(res.box_seats);
            
        },
        error: function(xhr, status, error){
            console.error("AJAX Error:", status, error, xhr.responseText);
        }
    });
}
function loadShowSeats(show_id){
    if(!show_id) return;
    $.ajax({
        url:'get_show_details.php',
        type:'POST',
        data:{show_id: show_id},
        dataType:'json',
        success:function(res){
            // Total seats
            $('#edit_normal_seats_total').val(res.normal_seats_total);
            $('#edit_gold_seats_total').val(res.gold_seats_total);
            $('#edit_platinum_seats_total').val(res.platinum_seats_total);
            $('#edit_box_seats_total').val(res.box_seats_total);

            // Available seats
            $('#edit_normal_seats_available').val(res.normal_seats_available);
            $('#edit_gold_seats_available').val(res.gold_seats_available);
            $('#edit_platinum_seats_available').val(res.platinum_seats_available);
            $('#edit_box_seats_available').val(res.box_seats_available);
        },
        error: function(xhr, status, error){
            console.error("AJAX Error:", status, error, xhr.responseText);
        }
    });
}

    $('.editShowBtn').click(function(){
        var btn = $(this);
        $('#edit_show_id').val(btn.data('id'));
        $('#edit_show_date').val(btn.data('show_date'));
        $('#edit_show_time').val(btn.data('show_time'));
        $('#edit_status').val(btn.data('status'));
        $('#edit_movie_id').val(btn.data('movie_id')).change();
        $('#edit_theater_id').val(btn.data('theater_id')).change();
        loadMovieDetails(btn.data('movie_id'));
        loadTheaterDetails(btn.data('theater_id'));
        loadShowSeats(btn.data('id')); 
    });

    $('#edit_movie_id').change(function(){
        loadMovieDetails($(this).val());
    });
    $('#edit_theater_id').change(function(){
        loadTheaterDetails($(this).val());
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
        lengthChange:false,
        buttons:['copy','excel','pdf','print']
    });
    table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
});
</script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
