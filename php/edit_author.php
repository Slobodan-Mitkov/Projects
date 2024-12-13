<?php
session_start();
require './db_connect.php';

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    if (isset($_POST['author_id']) && isset($_POST['author_name']) && !empty($_POST['author_name'])) {
        $authorId = $_POST['author_id'];
        $authorName = trim($_POST['author_name']);

        $stmt = $conn->prepare("UPDATE authors SET name = :authorName WHERE id = :authorId");
        $stmt->bindParam(':authorName', $authorName);
        $stmt->bindParam(':authorId', $authorId);
        $stmt->execute();

        header('Location: ./main.php');
        exit;
    }
} else {
    echo "Unauthorized access.";
}
?>