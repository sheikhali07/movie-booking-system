<?php
// auth.php
session_start();
include 'partials/config.php';

$register_errors = [];
$login_errors = [];

// Handle Registration
if (isset($_POST['register'])) {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $email_address = $conn->real_escape_string($_POST['email_address']);
    $country = $conn->real_escape_string($_POST['country']);
    $language = $conn->real_escape_string($_POST['language']);
    $username = $conn->real_escape_string($_POST['username']);
    $age = intval($_POST['age']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $register_errors[] = "Passwords do not match!";
    }

    // Check if email or username exists
    $check = $conn->query("SELECT id FROM users WHERE email_address='$email_address' OR username='$username'");
    if ($check->num_rows > 0) {
        $register_errors[] = "Email or username already exists!";
    }

    if (empty($register_errors)) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // By default, new registered users are 'user' type
        $user_type = 'user';

        $stmt = $conn->prepare("INSERT INTO users (first_name,last_name,phone_number,email_address,country,language,username,password,age,user_type) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssiss", $first_name,$last_name,$phone_number,$email_address,$country,$language,$username,$password_hash,$age,$user_type);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful! You can now login.";
            header("Location: auth");
            exit();
        } else {
            $register_errors[] = "Database error: ".$conn->error;
        }
    }
}

// Handle Login
if (isset($_POST['login'])) {
    $login_user = $conn->real_escape_string($_POST['login_user']);
    $login_pass = $_POST['login_pass'];

    $stmt = $conn->prepare("
        SELECT id, username, password, user_type 
        FROM users 
        WHERE (username = ? OR email_address = ?) 
        AND is_active = 1 
        LIMIT 1
    ");
    $stmt->bind_param("ss", $login_user, $login_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($login_pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];

            // Redirect based on user type
            if ($user['user_type'] === 'Admin') {
                header("Location: adminDashboard");
            } else {
                header("Location: dashboard");
            }
            exit();
        } else {
            $login_errors[] = "Incorrect password!";
        }
    } else {
        $login_errors[] = "Invalid Credentials !!";
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="blue-theme">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Auth | Skyset</title>
<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
<link href="assets/css/pace.min.css" rel="stylesheet">
<script src="assets/js/pace.min.js"></script>
<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
<link href="sass/main.css" rel="stylesheet">
<link href="sass/dark-theme.css" rel="stylesheet">
<link href="sass/blue-theme.css" rel="stylesheet">
<link href="sass/responsive.css" rel="stylesheet">
</head>
<body style="background-image: url('assets/images/bg-themes/bg.webp'); background-size: cover; background-repeat: no-repeat; background-position: center;">

<div class="section-authentication-cover">
<div class="">
<div class="row g-0">

<!-- Left Side -->
<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end bg-transparent">
    <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent bg-none">
        <div class="card-body"></div>
    </div>
</div>

<!-- Right Side (Forms) -->
<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
<div class="card rounded-0 m-3 border-0 shadow-none bg-none">
<div class="card-body p-sm-5">

<h4 class="fw-bold">Get Started Now</h4>

<!-- Success Message -->
<?php if(isset($_SESSION['success'])) { 
    echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
} ?>

<!-- Login Errors -->
<?php if(!empty($login_errors)) { 
    echo '<div class="alert alert-danger">';
    foreach($login_errors as $error) { echo $error.'<br>'; }
    echo '</div>';
} ?>

<!-- Tabs -->
<ul class="nav nav-tabs mb-3" role="tablist">
<li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" style="color: #fff;" href="#loginTab" role="tab">Login</a></li>
<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#registerTab" style="color: #fff;" role="tab">Register</a></li>
</ul>

<div class="tab-content">

<!-- Login Form -->
<div class="tab-pane fade show active" id="loginTab" role="tabpanel">
<form method="POST" action="">
    <div class="row g-3">
        <div class="col-12">
            <label class="form-label">Username or Email</label>
            <input type="text" name="login_user" class="form-control" placeholder="Username or Email" required>
        </div>
        <div class="col-12">
            <label class="form-label">Password</label>
            <input type="password" name="login_pass" class="form-control" placeholder="Password" required>
        </div>
        <div class="d-grid mb-3">
            <button type="submit" name="login" class="btn btn-grd-danger">Login</button>
        </div>
        <p class="mb-0">Don't have an account? <a href="#registerTab" data-bs-toggle="tab">Register here</a></p>
    </div>
</form>
</div>

<!-- Register Form -->
<div class="tab-pane fade" id="registerTab" role="tabpanel">
<?php if(!empty($register_errors)) { 
    echo '<div class="alert alert-danger">';
    foreach($register_errors as $error) { echo $error.'<br>'; }
    echo '</div>';
} ?>
<form class="row g-3" method="POST" action="">
    <div class="col-6"><label class="form-label">First Name</label><input type="text" name="first_name" class="form-control" required></div>
    <div class="col-6"><label class="form-label">Last Name</label><input type="text" name="last_name" class="form-control" required></div>
    <div class="col-6"><label class="form-label">Phone Number</label><input type="text" name="phone_number" class="form-control"></div>
    <div class="col-6"><label class="form-label">Email Address</label><input type="email" name="email_address" class="form-control" required></div>
    <div class="col-6"><label class="form-label">Country</label><input type="text" name="country" class="form-control"></div>
    <div class="col-6"><label class="form-label">Language</label>
        <select name="language" class="form-select">
            <option value="">---</option>
            <option value="Urdu">Urdu</option>
            <option value="English">English</option>
            <option value="Chinese">Chinese</option>
            <option value="Spanish">Spanish</option>
        </select>
    </div>
    <div class="col-6"><label class="form-label">Username</label><input type="text" name="username" class="form-control" required></div>
    <div class="col-6"><label class="form-label">Age</label><input type="number" name="age" class="form-control"></div>
    <div class="col-6"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
    <div class="col-6"><label class="form-label">Confirm Password</label><input type="password" name="confirm_password" class="form-control" required></div>
    <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="terms" required>
            <label class="form-check-label">I read and agree to Terms & Conditions</label>
        </div>
    </div>
    <div class="col-12"><div class="d-grid"><button type="submit" name="register" class="btn btn-grd-danger">Register</button></div></div>
    <p class="mb-0">Already have an account? <a href="#loginTab" data-bs-toggle="tab">Login here</a></p>
</form>
</div>

</div> <!-- tab-content -->
</div></div></div>
</div></div></div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
