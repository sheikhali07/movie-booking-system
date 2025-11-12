<?php
include 'partials/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $language = $_POST['language'];
    $duration = $_POST['duration'];
    $release_date = $_POST['release_date'];
    $director = $_POST['director'];
    $cast = $_POST['cast'];
    $description = $_POST['description'];
    $trailer_url = $_POST['trailer_url'];
    $rating = $_POST['rating'];
    $status = $_POST['status'];
    $movie_status = $_POST['movie_status'];

    // Handle poster image upload
    $poster_image = $_FILES['poster_image']['name'];
    if ($poster_image) {
        $targetDir = "uploads/posters/";
        $targetFile = $targetDir . basename($poster_image);
        move_uploaded_file($_FILES["poster_image"]["tmp_name"], $targetFile);
    } else {
        // keep old image
        $sql_old = "SELECT poster_image FROM movies WHERE id = ?";
        $stmt_old = $conn->prepare($sql_old);
        $stmt_old->bind_param("i", $id);
        $stmt_old->execute();
        $stmt_old->bind_result($poster_image);
        $stmt_old->fetch();
        $stmt_old->close();
    }

    $sql = "UPDATE movies SET 
            title=?, genre=?, language=?, duration=?, release_date=?, director=?, 
            cast=?, description=?, trailer_url=?, poster_image=?, rating=?, 
            status=?, movie_status=?, updated_at=NOW() 
            WHERE id=?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssdssi",
        $title, $genre, $language, $duration, $release_date, $director,
        $cast, $description, $trailer_url, $poster_image, $rating,
        $status, $movie_status, $id
    );

    if ($stmt->execute()) {
        header("Location: listMovies");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
