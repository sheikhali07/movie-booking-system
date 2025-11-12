<?php
include 'partials/config.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone_number = $_POST['phone_number'];
$age = $_POST['age'];
$email_address = $_POST['email_address'];
$country = $_POST['country'];
$language = $_POST['language'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if($password != $confirm_password){
    die("Passwords do not match");
}

$hashed_password = $password ? password_hash($password, PASSWORD_DEFAULT) : null;

if($id > 0){
    // Update existing user
    if($hashed_password){
        $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, phone_number=?, age=?, email_address=?, country=?, language=?, username=?, password=? WHERE id=?");
        $stmt->bind_param("sssisssssi",$first_name,$last_name,$phone_number,$age,$email_address,$country,$language,$username,$hashed_password,$id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, phone_number=?, age=?, email_address=?, country=?, language=?, username=? WHERE id=?");
        $stmt->bind_param("sssissssi",$first_name,$last_name,$phone_number,$age,$email_address,$country,$language,$username,$id);
    }
    $stmt->execute();
    header("Location: upcoming_Movies?msg=updated");
}else{
    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (first_name,last_name,phone_number,age,email_address,country,language,username,password) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssisssss",$first_name,$last_name,$phone_number,$age,$email_address,$country,$language,$username,$hashed_password);
    $stmt->execute();
    header("Location: upcoming_Movies?msg=added");
}
