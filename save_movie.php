<?php
include 'partials/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $title         = $_POST['title'];
    $genre         = $_POST['genre'];
    $language      = $_POST['language'];
    $duration      = $_POST['duration'];
    $release_date  = $_POST['release_date'];
    $director      = $_POST['director'];
    $cast          = $_POST['cast'];
    $description   = $_POST['description'];
    $trailer_url   = $_POST['trailer_url'];
    $rating        = $_POST['rating'];
    $status        = $_POST['status'];
    $movie_status  = $_POST['movie_status'];

    // Handle poster upload
    $poster_image = "";
    if (!empty($_FILES['poster_image']['name'])) {
        $target_dir = "uploads/posters/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES["poster_image"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["poster_image"]["tmp_name"], $target_file)) {
            $poster_image = $file_name;
        } else {
            $error_message = "❌ Failed to upload poster image.";
        }
    }

    // If no upload errors
    if (empty($error_message)) {
        // Check for duplicate movie title
        $check_sql = "SELECT * FROM movies WHERE title = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $title);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error_message = "⚠️ A movie with this title already exists! Please choose another.";
        } else {
            // Insert movie record
            $sql = "INSERT INTO movies 
                (title, genre, language, duration, release_date, director, cast, description, trailer_url, poster_image, rating, status, created_at, updated_at, movie_status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "sssssssssssss",
                $title,
                $genre,
                $language,
                $duration,
                $release_date,
                $director,
                $cast,
                $description,
                $trailer_url,
                $poster_image,
                $rating,
                $status,
                $movie_status
            );

            if ($stmt->execute()) {
                header("Location: listMovies");
                exit();
            } else {
                $error_message = "❌ Error while saving data: " . $stmt->error;
            }
        }
    }
}
?>

<?php if (!empty($error_message)): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Error</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    body {
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    .error-card {
        max-width: 600px;
        width: 100%;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        background-color: #fff;
        text-align: center;
        animation: pop 0.3s ease-in-out;
    }
    @keyframes pop {
        from {transform: scale(0.9); opacity: 0;}
        to {transform: scale(1); opacity: 1;}
    }
    .error-icon {
        font-size: 60px;
        color: #dc3545;
        margin-bottom: 20px;
    }
    .btn-custom {
        background-color: #dc3545;
        color: #fff;
        border-radius: 8px;
        padding: 10px 25px;
        transition: 0.3s;
    }
    .btn-custom:hover {
        background-color: #b02a37;
    }
</style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h3 class="text-danger fw-bold">Error Occurred</h3>
        <p class="text-muted mt-2"><?= htmlspecialchars($error_message) ?></p>
        <a href="javascript:history.back()" class="btn btn-custom mt-3">← Go Back</a>
    </div>
</body>
</html>
<?php endif; ?>
