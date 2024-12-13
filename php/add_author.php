<?php
session_start();
require './db_connect.php';

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    if (isset($_POST['author_name']) && !empty($_POST['author_name'])) {
        $authorName = trim($_POST['author_name']);

        $stmt = $conn->prepare("INSERT INTO authors (name) VALUES (:authorName)");
        $stmt->bindParam(':authorName', $authorName);
        $stmt->execute();

        header('Location: ./main.php');
        exit;
    }
} else {
    echo "Unauthorized access.";
}
?>