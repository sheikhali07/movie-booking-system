<?php
include 'partials/config.php';

if (isset($_POST['theater_id'])) {
    $theater_id = intval($_POST['theater_id']);
    $query = $conn->query("SELECT normal_seats, gold_seats, platinum_seats, box_seats FROM theaters WHERE id = $theater_id");
    $data = $query->fetch_assoc();
    echo json_encode($data);
}
?>
