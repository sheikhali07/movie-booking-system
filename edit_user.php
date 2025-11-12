<?php
include 'partials/config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone_number'];
    $age = $_POST['age'];
    $country = $_POST['country'];
    $language = $_POST['language'];
    $user_type = $_POST['user_type'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    if(!empty($_POST['password']) && $_POST['password'] == $_POST['confirm_password']){
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "UPDATE users SET 
                    first_name=?, last_name=?, username=?, email_address=?, phone_number=?, age=?, 
                    country=?, language=?, user_type=?, is_active=?, is_admin=?, password=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssisssiiii", $first_name, $last_name, $username, $email, $phone, $age, 
                          $country, $language, $user_type, $is_active, $is_admin, $password, $id);
    } else {
        $sql = "UPDATE users SET 
                    first_name=?, last_name=?, username=?, email_address=?, phone_number=?, age=?, 
                    country=?, language=?, user_type=?, is_active=?, is_admin=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssisssiii", $first_name, $last_name, $username, $email, $phone, $age, 
                          $country, $language, $user_type, $is_active, $is_admin, $id);
    }

    if($stmt->execute()){
        header("Location: listUsers");
        exit();
    } else {
        echo "Error: ".$stmt->error;
    }
}
?>
