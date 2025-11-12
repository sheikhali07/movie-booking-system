<?php
include 'partials/config.php';

if (isset($_POST['movie_id'])) {
    $movie_id = intval($_POST['movie_id']);
    $query = $conn->query("SELECT genre, language, duration, director, cast, rating, description, poster_image, trailer_url FROM movies WHERE id = $movie_id");
    $data = $query->fetch_assoc();
    echo json_encode($data);
}
?>
