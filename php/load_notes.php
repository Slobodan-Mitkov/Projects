<?php
require './db_connect.php';

$bookId = $_GET['book_id'] ?? 0;

$stmt = $conn->prepare("SELECT id, note_text FROM notes WHERE book_id = :bookId AND deleted_at IS NULL");
$stmt->bindParam(':bookId', $bookId);
$stmt->execute();
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['notes' => $notes]);
?>