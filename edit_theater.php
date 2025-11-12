<?php
include 'partials/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $normal_seats = $_POST['normal_seats'];
    $gold_seats = $_POST['gold_seats'];
    $platinum_seats = $_POST['platinum_seats'];
    $box_seats = $_POST['box_seats'];
    $total_seats = $normal_seats + $gold_seats + $platinum_seats + $box_seats;
    $status = $_POST['status'];

    // Prepare the update query
    $sql = "UPDATE theaters SET 
                name=?, city=?, address=?, contact_number=?, email=?, 
                normal_seats=?, gold_seats=?, platinum_seats=?, box_seats=?, total_seats=?, status=?,
                updated_at=NOW()
            WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssiiiiisi", 
        $name, $city, $address, $contact_number, $email, 
        $normal_seats, $gold_seats, $platinum_seats, $box_seats, $total_seats, $status, $id
    );

    if ($stmt->execute()) {
        header("Location: listTheaters");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
