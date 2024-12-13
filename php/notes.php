<?php
session_start();
require './db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die('Unauthorized access');
}

$userId = $_SESSION['user_id'];
$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $bookId = $_POST['book_id'];
    $noteText = $_POST['note_text'];
    
    $stmt = $conn->prepare("INSERT INTO notes (book_id, user_id, note_text) VALUES (:bookId, :userId, :noteText)");
    $stmt->bindParam(':bookId', $bookId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':noteText', $noteText);
    $stmt->execute();

    echo json_encode(['success' => true, 'note_id' => $conn->lastInsertId()]);
    exit();
}

if ($action === 'edit') {
    $noteId = $_POST['note_id'];
    $noteText = $_POST['note_text'];

    $stmt = $conn->prepare("UPDATE notes SET note_text = :noteText WHERE id = :noteId AND user_id = :userId");
    $stmt->bindParam(':noteId', $noteId);
    $stmt->bindParam(':noteText', $noteText);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    echo json_encode(['success' => true]);
    exit();
}

if ($action === 'delete') {
    $noteId = $_POST['note_id'];

    $stmt = $conn->prepare("UPDATE notes SET deleted_at = NOW() WHERE id = :noteId AND user_id = :userId");
    $stmt->bindParam(':noteId', $noteId);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    echo json_encode(['success' => true]);
    exit();
}
?>