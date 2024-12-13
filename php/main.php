<?php
session_start();
require './db_connect.php';

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

if ($isAdmin && isset($_POST['delete_book_id'])) {
    $bookId = $_POST['delete_book_id'];
    $stmt = $conn->prepare("UPDATE books SET deleted_at = NOW() WHERE id = :bookId");
    $stmt->bindParam(':bookId', $bookId);
    $stmt->execute();
}

$selectedCategories = isset($_GET['categories']) ? $_GET['categories'] : [];

$sql = "
    SELECT books.id, books.title, authors.name AS author, books.image_url, GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories
    FROM books
    JOIN authors ON books.author_id = authors.id
    JOIN book_category ON books.id = book_category.book_id
    JOIN categories ON book_category.category_id = categories.id
    WHERE books.deleted_at IS NULL
";

if (!empty($selectedCategories)) {
    $categoryPlaceholders = implode(',', array_fill(0, count($selectedCategories), '?'));
    $sql .= " AND categories.id IN ($categoryPlaceholders)";
}

$sql .= " GROUP BY books.id, books.title, authors.name, books.image_url";

$stmt = $conn->prepare($sql);

if (!empty($selectedCategories)) {
    foreach ($selectedCategories as $index => $categoryId) {
        $stmt->bindValue($index + 1, $categoryId, PDO::PARAM_INT);
    }
}

$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

$categoryStmt = $conn->prepare("SELECT * FROM categories WHERE deleted_at IS NULL");
$categoryStmt->execute();
$categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

$authorStmt = $conn->prepare("SELECT * FROM authors WHERE deleted_at IS NULL");
$authorStmt->execute();
$authors = $authorStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!---------------------------- CDN links for Bootstrap and Font Awesome ---------------------------->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
<!---------------------------- CSS ---------------------------->
    <link rel="stylesheet" href="../css/pageStyle.css" />
    <link rel="stylesheet" href="../css/main.css" />
<!---------------------------- Website icon ---------------------------->
    <link rel="icon" type="image/x-icon" href="../Logo.png" />
<!---------------------------- Meta tag ---------------------------->
    <meta name="description" content="Brainster Library books catalog" />
    <title>Brainster Library</title>
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
<!---------------------------- Category filter ---------------------------->
    <div class="container container-1">
        <div class="row">
            <div class="col">
                <p class="category">Category:</p>
                <div id="list1" class="dropdown-check-list" tabindex="100">
                    <span class="dropdown-header">
                        Select Category<i class="fa-solid fa-caret-down"></i>
                    </span>
                    <ul class="items">
                        <?php foreach ($categories as $category): ?>
                        <li>
                            <input id="<?= htmlspecialchars($category['name']); ?>" value="<?= htmlspecialchars($category['name']); ?>" type="checkbox" />
                            <label for="<?= htmlspecialchars($category['name']); ?>"><?= htmlspecialchars($category['name']); ?></label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <button class="dropdown-reset btn btn-secondary mx-3">Reset Categories</button>
            </div>
            <div class="col">
                <div class="input-group">
                    <input id="search-input" type="text" class="form-control search-input" placeholder="Search the book you want..." aria-label="search-input" aria-describedby="basic-addon2" />
                    <button class="text-reset" type="button"><i class="fa-solid fa-x fa-sm" style="color: #ff0000;"></i></button>
                </div>
            </div>
        </div>
    </div>
<!---------------------------- Sidebar menu ---------------------------->
    <?php if ($isAdmin): ?>
        <button id="sidebarToggle" class="sidebar-toggle">
            <i id="sidebarIcon" class="fa-solid fa-bars"></i>
        </button>
        <div id="sidebar" class="sidebar">
            <button id="openCategoryModal" class="sidebar-btn">
                <i class="fa fa-folder" aria-hidden="true"></i><p>Categories</p>
            </button>
            <button id="openAuthorModal" class="sidebar-btn">
                <i class="fa fa-user" aria-hidden="true"></i><p>Authors</p>
            </button>
            <a href="./add_book.php" class="sidebar-btn">
                <i class="fa fa-book" aria-hidden="true"></i><p>Add Book</p>
            </a>
        </div>
<!---------------------------- Categories ---------------------------->
        <div id="categoryModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Manage Categories</h3>
                <form method="POST" action="./add_category.php" class="mb-3">
                    <input type="text" name="category_name" placeholder="Add new category" required />
                    <button type="submit" class="btn btn-success">Add Category</button>
                </form>
                <ul class="list-group">
                    <?php foreach ($categories as $category): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <form method="POST" action="./edit_category.php" class="d-inline">
                                <input type="hidden" name="category_id" value="<?= $category['id']; ?>">
                                <input type="text" name="category_name" value="<?= htmlspecialchars($category['name']); ?>" required>
                                <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                            </form>
                            <form method="POST" action="./delete_category.php" class="d-inline">
                                <input type="hidden" name="category_id" value="<?= $category['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
<!---------------------------- Authors ---------------------------->
        <div id="authorModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Manage Authors</h3>
                <form method="POST" action="./add_author.php" class="mb-3">
                    <input type="text" name="author_name" placeholder="Add new author" required />
                    <button type="submit" class="btn btn-success">Add Author</button>
                </form>
                <ul class="list-group">
                    <?php foreach ($authors as $author): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <form method="POST" action="./edit_author.php" class="d-inline">
                                <input type="hidden" name="author_id" value="<?= $author['id']; ?>">
                                <input type="text" name="author_name" value="<?= htmlspecialchars($author['name']); ?>" required>
                                <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                            </form>
                            <form method="POST" action="./delete_author.php" class="d-inline">
                                <input type="hidden" name="author_id" value="<?= $author['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
<!---------------------------- Load Books ---------------------------->
    <div class="container container-books mt-3">
        <?php if (count($books) > 0): ?>
            <div class="row">
                <?php foreach ($books as $row): ?>
                    <div class="col book-card">
                        <div class="card">
                            <a href="./book.php?id=<?= $row['id']; ?>">
                                <img src="<?= htmlspecialchars($row['image_url']); ?>" class="card-img-top"
                                alt="<?= htmlspecialchars($row['title']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($row['title']); ?></h5>
                                    <p><?= htmlspecialchars($row['author']); ?></p>
                                    <p class="book-category"><?= htmlspecialchars($row['categories']); ?></p>
                                </div>
                            </a>
                            <?php if ($isAdmin): ?>
                                <form method="POST" action="" class="mt-2">
                                    <input type="hidden" name="delete_book_id" value="<?= $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger delete-btn" data-book-id="<?= $row['id']; ?>">Delete Book</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p>No books found.</p>
        <?php endif; ?>
    </div>
<!---------------------------- Delete Book Modal ---------------------------->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this book?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        <input type="hidden" name="delete_book_id" id="deleteBookId">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                </div>
            </div>
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
<script src="../javascript/footer.js"></script>
<script src="../javascript/sidebar-button.js"></script>
<script src="../javascript/admin-tools.js"></script>
<script src="../javascript/category-filter.js"></script>
<script src="../javascript/delete-modal.js"></script>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous">
</script>
</body>
</html>
