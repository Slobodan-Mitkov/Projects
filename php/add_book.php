<?php
session_start();
require './db_connect.php';

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

if (!$isAdmin) {
    header("Location: ./main.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $category_ids = $_POST['category_ids'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare("
        SELECT id FROM books WHERE title = :title AND author_id = :author_id LIMIT 1
    ");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author_id', $author_id);
    $stmt->execute();
    $existingBook = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingBook) {
        $error = "The book titled '$title' by this author already exists.";
    } else {
        $stmt = $conn->prepare("
            INSERT INTO books (title, author_id, description, image_url, created_at, updated_at)
            VALUES (:title, :author_id, :description, :image_url, NOW(), NOW())
        ");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->execute();

        $book_id = $conn->lastInsertId();

        foreach ($category_ids as $category_id) {
            $stmt = $conn->prepare("INSERT INTO book_category (book_id, category_id) VALUES (:book_id, :category_id)");
            $stmt->bindParam(':book_id', $book_id);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->execute();
        }

        header("Location: ./main.php");
        exit();
    }
}

$categoriesStmt = $conn->prepare("SELECT id, name FROM categories");
$categoriesStmt->execute();
$categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);

$authorsStmt = $conn->prepare("SELECT id, name FROM authors WHERE deleted_at IS NULL");
$authorsStmt->execute();
$authors = $authorsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------------------------- CDN links for Bootstrap ---------------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!---------------------------- CSS ---------------------------->
    <link rel="stylesheet" href="css/book.css">
    <link rel="stylesheet" href="../css/pageStyle.css" />
    <!---------------------------- Website icon ---------------------------->
    <link rel="icon" type="image/x-icon" href="../Logo.png" />
    <title>Add New Book</title>
</head>
<body>
<!---------------------------- Navbar ---------------------------->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="./main.php"><img src="../Logo.png" class="logo" alt="logo"> <p class="logo-text">Brainster Library</p></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./main.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about-us.php">About us</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../sign-up.html">Sign up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login.html">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!---------------------------- Add Book ---------------------------->
<div class="container mt-3">
    <h1>Add New Book</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="add_book.php">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" required>
    </div>
    <div class="mb-3">
        <label for="author_id" class="form-label">Author</label>
        <select class="form-select" name="author_id" required>
            <?php foreach ($authors as $author): ?>
                <option value="<?php echo $author['id']; ?>"><?php echo htmlspecialchars($author['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Categories</label>
        <div id="category-container">
            <div class="category-row mb-2">
                <select class="form-select" name="category_ids[]" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="add-category">Add Another Category</button>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="image_url" class="form-label">Image URL</label>
        <input type="text" class="form-control" name="image_url" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Book</button>
</form>
<a href="./main.php" class="btn btn-secondary mb-3 mt-3">Go Back</a>
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