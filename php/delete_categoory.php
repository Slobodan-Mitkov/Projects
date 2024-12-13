<?php
include './db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])) {
    $stmt = $conn->prepare("UPDATE categories SET deleted_at = NOW() WHERE id = :id");
    $stmt->bindParam(':id', $_POST['category_id']);
    $stmt->execute();
}

header('Location: ./main.php');
exit;