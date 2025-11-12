<?php
include 'partials/config.php';

if (isset($_POST['show_id'])) {
    $show_id = intval($_POST['show_id']);
    $query = $conn->query("SELECT normal_seats_total, gold_seats_total, platinum_seats_total, box_seats_total,
                                  normal_seats_available, gold_seats_available, platinum_seats_available, box_seats_available
                           FROM shows
                           WHERE id = $show_id");
    $data = $query->fetch_assoc();
    echo json_encode($data);
}
?>
