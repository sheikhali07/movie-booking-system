<?php
include 'partials/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];
    $country = $_POST['country'];
    $language = $_POST['language'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $is_active = $_POST['is_active'];
    $is_admin = $_POST['is_admin'];
    $age = $_POST['age'];
    $user_type = $_POST['user_type'];

    // Check if username or email already exists
    $check_sql = "SELECT * FROM users WHERE username=? OR email_address=?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $username, $email_address);
    $check_stmt->execute();
    $check_stmt->store_result();

    if($check_stmt->num_rows > 0){
        $error_message = "⚠️ Username or Email already exists! Please try another.";
    } else {
        // Insert new user
        $sql = "INSERT INTO users 
        (first_name, last_name, phone_number, email_address, country, language, username, password, is_active, is_admin, age, user_type)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssiiis", $first_name, $last_name, $phone_number, $email_address, $country, $language, $username, $password, $is_active, $is_admin, $age, $user_type);

        if ($stmt->execute()) {
            header("Location: listUsers");
            exit();
        } else {
            $error_message = "❌ Something went wrong while saving data. Error: " . $stmt->error;
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
