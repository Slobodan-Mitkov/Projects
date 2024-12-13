<?php
session_start();
require './db_connect.php';

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    if (isset($_POST['author_id'])) {
        $authorId = $_POST['author_id'];

        $stmt = $conn->prepare("UPDATE authors SET deleted_at = NOW() WHERE id = :authorId");
        $stmt->bindParam(':authorId', $authorId);
        $stmt->execute();

        header('Location: ./main.php');
        exit;
    }
} else {
    echo "Unauthorized access.";
}
?>