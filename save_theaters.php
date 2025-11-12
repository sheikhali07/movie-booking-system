<?php
include 'partials/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $normal_seats = $_POST['normal_seats'];
    $gold_seats = $_POST['gold_seats'];
    $platinum_seats = $_POST['platinum_seats'];
    $box_seats = $_POST['box_seats'];
    $status = $_POST['status'];

    // Auto calculate total seats (backup calculation in case JS didn't run)
    $total_seats = (int)$normal_seats + (int)$gold_seats + (int)$platinum_seats + (int)$box_seats;

    // Check if theater already exists
    $check_sql = "SELECT * FROM theaters WHERE name = ? OR email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $name, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if($check_stmt->num_rows > 0){
        $error_message = "⚠️ Theater name or email already exists! Please try another.";
    } else {
        $sql = "INSERT INTO theaters 
        (name, city, address, contact_number, email, total_seats, normal_seats, gold_seats, platinum_seats, box_seats, status, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssss", $name, $city, $address, $contact_number, $email, $total_seats, $normal_seats, $gold_seats, $platinum_seats, $box_seats, $status);

        if ($stmt->execute()) {
            header("Location: listTheaters");
            exit();
        } else {
            $error_message = "❌ Error while saving data: " . $stmt->error;
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
