<?php
include './db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_name'])) {
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (:name)");
    $stmt->bindParam(':name', $_POST['category_name']);
    $stmt->execute();
}

header('Location: ./main.php');
exit;