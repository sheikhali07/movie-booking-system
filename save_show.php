<?php
include 'partials/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fields = [
        'theater_id', 'movie_id', 'show_date', 'show_time', 'genre', 'language', 'duration', 
        'director', 'cast', 'rating', 'description', 'poster_image', 'trailer_url', 'status', 
        'normal_seats_total', 'gold_seats_total', 'platinum_seats_total', 'box_seats_total', 
        'normal_seats_available', 'gold_seats_available', 'platinum_seats_available', 'box_seats_available'
    ];
    
    $data = [];
    foreach ($fields as $f) $data[$f] = $_POST[$f] ?? '';

    $sql = "INSERT INTO shows (" . implode(",", array_keys($data)) . ", created_at)
            VALUES ('" . implode("','", array_map([$conn, 'real_escape_string'], $data)) . "', NOW())";

    if ($conn->query($sql)) {
        echo "<script>alert('Show Added Successfully!'); window.location='listShows';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
