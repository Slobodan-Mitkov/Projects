<?php
include './db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'], $_POST['category_name'])) {
    $stmt = $conn->prepare("UPDATE categories SET name = :name WHERE id = :id");
    $stmt->bindParam(':name', $_POST['category_name']);
    $stmt->bindParam(':id', $_POST['category_id']);
    $stmt->execute();
}

header('Location: ./main.php');
exit;