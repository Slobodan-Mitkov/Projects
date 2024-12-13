<?php
session_start();
require './db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: ./main.php");
    exit();
}

$bookId = $_GET['id'];
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
$isAdmin = $user_role === 'admin';
$isLoggedIn = isset($_SESSION['user_id']);

$stmt = $conn->prepare("
  SELECT books.title, authors.id AS author_id, authors.name AS author, books.description, books.image_url
  FROM books
  JOIN authors ON books.author_id = authors.id
  WHERE books.id = :bookId
");
$stmt->bindParam(':bookId', $bookId);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    echo "Book not found.";
    exit();
}

$authorsStmt = $conn->prepare("SELECT id, name FROM authors WHERE deleted_at IS NULL");
$authorsStmt->execute();
$authors = $authorsStmt->fetchAll(PDO::FETCH_ASSOC);

$categoriesStmt = $conn->prepare("SELECT id, name FROM categories");
$categoriesStmt->execute();
$categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);

$bookCategoriesStmt = $conn->prepare("SELECT category_id FROM book_category WHERE book_id = :bookId");
$bookCategoriesStmt->bindParam(':bookId', $bookId);
$bookCategoriesStmt->execute();
$bookCategories = $bookCategoriesStmt->fetchAll(PDO::FETCH_COLUMN, 0);

$stmt = $conn->prepare("
    SELECT comments.id, comments.comment_text, comments.status, users.username, comments.user_id
    FROM comments
    JOIN users ON comments.user_id = users.id
    WHERE comments.book_id = :bookId
    AND comments.is_deleted = 0
");
$stmt->bindParam(':bookId', $bookId);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$comments) {
    $comments = [];
}

if (isset($_POST['add_comment']) && $user_role !== 'guest') {
    $commentText = $_POST['comment_text'];
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("
        INSERT INTO comments (book_id, user_id, comment_text, status)
        VALUES (:bookId, :userId, :commentText, 'pending')
    ");
    $stmt->bindParam(':bookId', $bookId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':commentText', $commentText);
    $stmt->execute();

    header("Location: book.php?id=$bookId");
    exit();
}

if (isset($_GET['action']) && isset($_GET['comment_id'])) {
    $commentId = $_GET['comment_id'];
    $action = $_GET['action'];

    if ($isAdmin) {
        if ($action === 'approve') {
            $stmt = $conn->prepare("UPDATE comments SET status = 'approved' WHERE id = :commentId");
        } elseif ($action === 'disapprove') {
            $stmt = $conn->prepare("UPDATE comments SET status = 'disapproved' WHERE id = :commentId");
        } elseif ($action === 'delete') {
            $stmt = $conn->prepare("UPDATE comments SET is_deleted = 1 WHERE id = :commentId");
        }

        if (isset($stmt)) {
            $stmt->bindParam(':commentId', $commentId);
            $stmt->execute();
        }

        header("Location: book.php?id=$bookId");
        exit();
    } elseif ($userId) {
        if ($action === 'delete') {
            $stmt = $conn->prepare("SELECT user_id FROM comments WHERE id = :commentId AND user_id = :userId");
            $stmt->bindParam(':commentId', $commentId);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $commentOwner = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($commentOwner) {
                $stmt = $conn->prepare("UPDATE comments SET is_deleted = 1 WHERE id = :commentId AND user_id = :userId");
                $stmt->bindParam(':commentId', $commentId);
                $stmt->bindParam(':userId', $userId);
                $stmt->execute();
            }
            header("Location: book.php?id=$bookId");
            exit();
        }
    }
}

if (isset($_POST['update_book']) && $isAdmin) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $author_id = $_POST['author_id'];
    $category_ids = isset($_POST['category_ids']) ? $_POST['category_ids'] : [];

    $updateBookStmt = $conn->prepare("
        UPDATE books 
        SET title = :title, description = :description, image_url = :image_url, author_id = :author_id, updated_at = NOW()
        WHERE id = :bookId
    ");
    $updateBookStmt->bindParam(':title', $title);
    $updateBookStmt->bindParam(':description', $description);
    $updateBookStmt->bindParam(':image_url', $image_url);
    $updateBookStmt->bindParam(':author_id', $author_id);
    $updateBookStmt->bindParam(':bookId', $bookId);
    $updateBookStmt->execute();

    $deleteCategoriesStmt = $conn->prepare("DELETE FROM book_category WHERE book_id = :bookId");
    $deleteCategoriesStmt->bindParam(':bookId', $bookId);
    $deleteCategoriesStmt->execute();

    foreach ($category_ids as $category_id) {
        $insertCategoryStmt = $conn->prepare("
            INSERT INTO book_category (book_id, category_id) VALUES (:bookId, :categoryId)
        ");
        $insertCategoryStmt->bindParam(':bookId', $bookId);
        $insertCategoryStmt->bindParam(':categoryId', $category_id);
        $insertCategoryStmt->execute();
    }

    header("Location: book.php?id=$bookId");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------------------------- CDN links for Bootstrap ---------------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!---------------------------- Website icon ---------------------------->
    <link rel="icon" type="image/x-icon" href="./Logo.png" />
    <title><?php echo htmlspecialchars($book['title']); ?></title>
    <!---------------------------- CSS ---------------------------->
    <link rel="stylesheet" href="../css/pageStyle.css" />
</head>

<body>
    <!---------------------------- Navbar ---------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../Logo.png" class="logo" alt="logo"> <p class="logo-text">Brainster Library</p></a>
        </div>
    </nav>
    <!---------------------------- Book ---------------------------->
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <a href="./main.php" class="btn btn-secondary mb-3">Go Back</a>
                <h1><?php echo htmlspecialchars($book['title']); ?></h1>
                <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                <p><?php echo htmlspecialchars($book['description']); ?></p>
                <img src="<?php echo htmlspecialchars($book['image_url']); ?>" alt="Book cover" class="img-fluid">
                <!---------------------------- Edit Book ---------------------------->
                <?php if ($isAdmin): ?>
                    <h3>Edit Book</h3>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="author_id" class="form-label">Author</label>
                            <select class="form-select" name="author_id" required>
                                <?php foreach ($authors as $author): ?>
                                    <option value="<?php echo $author['id']; ?>" 
                                        <?php echo ($author['id'] == $book['author_id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($author['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categories</label>
                            <div id="category-container">
                                <?php foreach ($bookCategories as $index => $bookCategoryId): ?>
                                    <div class="category-row mb-2">
                                        <select class="form-select" name="category_ids[]" <?php echo $index === 0 ? 'required' : ''; ?>>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $bookCategoryId) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($category['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if ($index !== 0):?>
                                            <button type="button" class="btn btn-danger btn-sm remove-category mt-2">Remove</button>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button type="button" class="btn btn-primary" id="add-category">Add Another Category</button>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" required><?php echo htmlspecialchars($book['description']); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image URL</label>
                            <input type="text" class="form-control" name="image_url" value="<?php echo htmlspecialchars($book['image_url']); ?>" required>
                        </div>

                        <button type="submit" name="update_book" class="btn btn-primary">Update Book</button>
                    </form>
                <?php endif; ?>
            </div>
            <!---------------------------- Notes ---------------------------->
            <?php if ($isLoggedIn): ?>
                <div class="col notes">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col notes">
                                <h5>Your Notes</h5>
                                <div id="notes-list">
                                </div>
                                <form id="add-note-form">
                                    <textarea id="note-text" class="form-control" rows="2" placeholder="Add a new note..."></textarea>
                                    <button type="submit" class="btn btn-primary mt-2">Add Note</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!---------------------------- Comments ---------------------------->            
    <div class="container mt-5">
        <div class="row">
            <?php if ($isAdmin): ?>
                <div class="col-md-4">
                    <h5>Pending Comments</h5>
                    <div class="comment-section">
                        <?php foreach ($comments as $comment) : ?>
                            <?php if ($comment['status'] === 'pending') : ?>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <p><strong><?php echo htmlspecialchars($comment['username']); ?>:</strong></p>
                                        <p><?php echo htmlspecialchars($comment['comment_text']); ?></p>
                                        <a href="book.php?id=<?php echo $bookId; ?>&action=approve&comment_id=<?php echo $comment['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                                        <a href="book.php?id=<?php echo $bookId; ?>&action=disapprove&comment_id=<?php echo $comment['id']; ?>" class="btn btn-warning btn-sm">Disapprove</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5>Approved Comments</h5>
                    <div class="comment-section">
                        <?php foreach ($comments as $comment) : ?>
                            <?php if ($comment['status'] === 'approved') : ?>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <p><strong><?php echo htmlspecialchars($comment['username']); ?>:</strong></p>
                                        <p><?php echo htmlspecialchars($comment['comment_text']); ?></p>
                                        <a href="book.php?id=<?php echo $bookId; ?>&action=disapprove&comment_id=<?php echo $comment['id']; ?>" class="btn btn-warning btn-sm">Disapprove</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5>Disapproved Comments</h5>
                    <div class="comment-section">
                        <?php foreach ($comments as $comment) : ?>
                            <?php if ($comment['status'] === 'disapproved') : ?>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <p><strong><?php echo htmlspecialchars($comment['username']); ?>:</strong></p>
                                        <p><?php echo htmlspecialchars($comment['comment_text']); ?></p>
                                        <a href="book.php?id=<?php echo $bookId; ?>&action=approve&comment_id=<?php echo $comment['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <?php if ($isLoggedIn): ?>
                    <div class="mt-4">
                        <h5>Add a Comment</h5>
                        <form method="POST">
                            <div class="mb-3">
                                <textarea class="form-control" name="comment_text" rows="3" required></textarea>
                            </div>
                            <button type="submit" name="add_comment" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                <?php else: ?>
                    <p class="text-danger mt-4">You must be logged in to add a comment.</p>
                <?php endif; ?>

                <div class="col-md-12">
                    <h5>Comments</h5>
                    <div class="comment-section">
                        <?php foreach ($comments as $comment) : ?>
                            <?php if ($userId === $comment['user_id'] || $comment['status'] === 'approved') : ?>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <p><strong><?php echo htmlspecialchars($comment['username']); ?>:</strong></p>
                                        <p><?php echo htmlspecialchars($comment['comment_text']); ?></p>
                                        <?php if ($userId === $comment['user_id']) : ?>
                                            <p>Status: <strong><?php echo htmlspecialchars(ucfirst($comment['status'])); ?></strong></p>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<!---------------------------- Footer ---------------------------->
<footer class="mt-5">
    <div id="quote-container" class="mt-2">
        <blockquote id="quote-text" class="blockquote"></blockquote>
        <figcaption id="quote-author" class="blockquote-footer"></figcaption>
    </div>
</footer>
<!---------------------------- Javascript ---------------------------->
<script src="../footer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const notesList = document.getElementById('notes-list');
        const addNoteForm = document.getElementById('add-note-form');
        const noteTextInput = document.getElementById('note-text');

        function loadNotes() {
            fetch('load_notes.php?book_id=<?php echo $bookId; ?>')
            .then(response => response.json())
            .then(data => {
                notesList.innerHTML = '';
                data.notes.forEach(note => {
                    const noteElement = document.createElement('div');
                    noteElement.classList.add('note', 'mb-2');
                    noteElement.innerHTML = `
                        <p>${note.note_text}</p>
                        <button class="btn btn-sm btn-secondary edit-note" data-id="${note.id}">Edit</button>
                        <button class="btn btn-sm btn-danger delete-note" data-id="${note.id}">Delete</button>
                    `;
                    notesList.appendChild(noteElement);
                });
            });
        }

        loadNotes();

        addNoteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const noteText = noteTextInput.value.trim();
            if (noteText) {
                fetch('notes.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: new URLSearchParams({
                        action: 'add',
                        book_id: <?php echo $bookId; ?>,
                        note_text: noteText
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadNotes();
                        noteTextInput.value = '';
                    }
                });
            }
        });

        notesList.addEventListener('click', function(e) {
            if (e.target.classList.contains('edit-note')) {
                const noteId = e.target.getAttribute('data-id');
                const newNoteText = prompt("Edit your note:");
                if (newNoteText) {
                    fetch('notes.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        body: new URLSearchParams({
                            action: 'edit',
                            note_id: noteId,
                            note_text: newNoteText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                             loadNotes();
                        }
                    });
                }
            }

            if (e.target.classList.contains('delete-note')) {
                const noteId = e.target.getAttribute('data-id');
                if (confirm("Are you sure you want to delete this note?")) {
                    fetch('notes.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        body: new URLSearchParams({
                            action: 'delete',
                            note_id: noteId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                                loadNotes();
                        }
                    });
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const categoryContainer = document.getElementById('category-container');
        const addCategoryButton = document.getElementById('add-category');

        addCategoryButton.addEventListener('click', function() {
            const categoryRow = document.createElement('div');
            categoryRow.classList.add('category-row', 'mb-2');
            categoryRow.innerHTML = `
                <select class="form-select" name="category_ids[]" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="btn btn-danger btn-sm remove-category mt-2">Remove</button>
            `;
            categoryContainer.appendChild(categoryRow);
        });

        categoryContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-category')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
</body>
</html>