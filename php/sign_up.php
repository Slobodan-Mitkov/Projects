<?php
session_start();
require './db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hashed);
        $stmt->execute();

        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['username'] = $username;
        header("Location: ./main.php");
        exit();
    } catch(PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "This email is already registered.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>