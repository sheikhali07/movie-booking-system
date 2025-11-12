<?php
include 'partials/config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM theaters WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: listTheaters");
exit();
?>
