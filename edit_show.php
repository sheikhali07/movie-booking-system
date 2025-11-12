<?php
include 'partials/config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get and sanitize POST data
    $id = intval($_POST['id']);
    $movie_id = intval($_POST['movie_id']);
    $theater_id = intval($_POST['theater_id']);
    $show_date = $conn->real_escape_string($_POST['show_date']);
    $show_time = $conn->real_escape_string($_POST['show_time']);
    $status = $conn->real_escape_string($_POST['status']);

    // Seat totals and availability
    $normal_seats_total = intval($_POST['normal_seats_total']);
    $gold_seats_total = intval($_POST['gold_seats_total']);
    $platinum_seats_total = intval($_POST['platinum_seats_total']);
    $box_seats_total = intval($_POST['box_seats_total']);

    $normal_seats_available = intval($_POST['normal_seats_available']);
    $gold_seats_available = intval($_POST['gold_seats_available']);
    $platinum_seats_available = intval($_POST['platinum_seats_available']);
    $box_seats_available = intval($_POST['box_seats_available']);

    // Optional: Validate required fields
    $errors = [];
    if (!$movie_id) $errors[] = "Movie is required.";
    if (!$theater_id) $errors[] = "Theater is required.";
    if (!$show_date) $errors[] = "Show date is required.";
    if (!$show_time) $errors[] = "Show time is required.";

    if (count($errors) > 0) {
        $error_msg = implode(" ", $errors);
        header("Location: list_shows.php?error=" . urlencode($error_msg));
        exit;
    }

    // Update the show in the database
    $stmt = $conn->prepare("UPDATE shows SET 
        movie_id=?, 
        theater_id=?, 
        show_date=?, 
        show_time=?, 
        status=?, 
        normal_seats_total=?, 
        gold_seats_total=?, 
        platinum_seats_total=?, 
        box_seats_total=?, 
        normal_seats_available=?, 
        gold_seats_available=?, 
        platinum_seats_available=?, 
        box_seats_available=? 
        WHERE id=?"
    );
    $stmt->bind_param(
    "iisssiiiiiiiii", 
    $movie_id, 
    $theater_id, 
    $show_date, 
    $show_time, 
    $status,
    $normal_seats_total,
    $gold_seats_total,
    $platinum_seats_total,
    $box_seats_total,
    $normal_seats_available,
    $gold_seats_available,
    $platinum_seats_available,
    $box_seats_available,
    $id
);


    if ($stmt->execute()) {
        header("Location: listShows?success=" . urlencode("Show updated successfully."));
        exit;
    } else {
        header("Location: listShows?error=" . urlencode("Failed to update show."));
        exit;
    }

} else {
    header("Location: listShows");
    exit;
}
?>
