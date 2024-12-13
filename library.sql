-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 08:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `deleted_at`) VALUES
(1, 'JK', NULL),
(2, 'J. K. Rowling', '2024-08-21 12:14:11'),
(3, 'J.K.Rowling', '2024-08-21 12:15:08'),
(4, 'Robert Kiyosaki', NULL),
(5, 'Peter Thiel', NULL),
(6, 'Jane Austen', NULL),
(7, 'Charles Dickens', NULL),
(8, 'Mark Twain', NULL),
(9, 'Virginia Woolf', NULL),
(10, 'Leo Tolstoy', NULL),
(11, 'Fyodor Dostoevsky', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author_id`, `description`, `image_url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'Harry Potter', 1, 'Harry is a wizard', 'https://musicart.xboxlive.com/7/5dbd5100-0000-0000-0000-000000000002/504/image.jpg?w=1920&h=1080', '2024-09-05 13:47:13', '2024-09-08 15:07:40', NULL),
(10, 'Rich Dad Poor Dad', 4, 'The most important lesson from Rich Dad, Poor Dad is that financial literacy is crucial to financial success. He argues that school education fails in this regard and needs to effectively teach financial literacy, including the basics of financial management and wealth building.', 'https://m.media-amazon.com/images/I/81BE7eeKzAL._AC_UF1000,1000_QL80_.jpg', '2024-09-08 15:00:38', '2024-09-08 15:00:38', NULL),
(11, 'Zero to One', 5, 'The concept of \'zero to one\' in business and entrepreneurship refers to the process of creating something completely new and unique. It\'s about creating a product or service that didn\'t exist before, thus going from \'zero\' to \'one\'.', 'https://m.media-amazon.com/images/I/51zGCdRQXOL._AC_UF1000,1000_QL80_.jpg', '2024-09-08 15:06:58', '2024-09-08 15:06:58', NULL),
(12, 'Pride and Prejudice', 6, 'Pride and Prejudice follows the turbulent relationship between Elizabeth Bennet, the daughter of a country gentleman, and Fitzwilliam Darcy, a rich aristocratic landowner. They must overcome the titular sins of pride and prejudice in order to fall in love and marry.', 'https://m.media-amazon.com/images/M/MV5BMTA1NDQ3NTcyOTNeQTJeQWpwZ15BbWU3MDA0MzA4MzE@._V1_.jpg', '2024-09-08 15:34:38', '2024-09-08 15:34:38', NULL),
(13, 'Great Expectations', 7, 'Great Expectations, Charles Dickens\' novel, tells the story of an orphan named Philip Pirrip (nicknamed Pip) who narrates the story of his life from childhood to adulthood. Pip is the protagonist of the tale and is also the narrator. Throughout the novel, Pip depicts his journey to becoming a gentleman.', 'https://m.media-amazon.com/images/M/MV5BYTRkYjAyNmEtMzdjMC00MjRhLWJkYjItNTU5OWNlNjc4ODk3XkEyXkFqcGdeQXVyMzA5NjkwNDM@._V1_.jpg', '2024-09-08 15:35:43', '2024-09-08 15:36:01', NULL),
(14, 'The Adventures of Huckleberry Finn', 8, 'Mark Twain\'s classic The Adventures of Huckleberry Finn (1884) is told from the point of view of Huck Finn, a barely literate teen who fakes his own death to escape his abusive, drunken father. He encounters a runaway slave named Jim, and the two embark on a raft journey down the Mississippi River.', 'https://m.media-amazon.com/images/I/91sBZnKzEfL._AC_UF1000,1000_QL80_.jpg', '2024-09-08 15:36:57', '2024-09-08 15:36:57', NULL),
(15, 'To the Lighthouse', 9, 'The three sections of the book take place between 1910 and 1920 and revolve around various members of the Ramsay family during visits to their summer residence on the Isle of Skye in Scotland. A central motif of the novel is the conflict between the feminine and masculine principles at work in the universe.', 'https://m.media-amazon.com/images/I/81uGyLbPszL._AC_UF1000,1000_QL80_.jpg', '2024-09-08 15:38:03', '2024-09-08 15:38:03', NULL),
(16, 'War and Peace', 10, 'The novel\'s primary historical setting is the French invasion of Russia in 1812, which was a turning point in the Napoleonic Wars and a period of patriotic significance to Russia. Some historians argue that this invasion was the event that metamorphosed into the Decembrist movement years later.', 'https://m.media-amazon.com/images/I/71wXZB-VtBL._AC_UF1000,1000_QL80_.jpg', '2024-09-08 15:39:32', '2024-09-08 15:39:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`book_id`, `category_id`) VALUES
(9, 1),
(9, 7),
(10, 4),
(10, 9),
(11, 2),
(11, 4),
(11, 8),
(11, 9),
(12, 4),
(12, 5),
(12, 8),
(13, 3),
(13, 5),
(13, 8),
(14, 1),
(14, 4),
(14, 5),
(15, 1),
(15, 3),
(15, 8),
(16, 1),
(16, 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `deleted_at`) VALUES
(1, 'Fiction', NULL),
(2, 'Non-Fiction', NULL),
(3, 'Science Fiction', NULL),
(4, 'Biography', NULL),
(5, 'History', NULL),
(6, 'Children\'s Books', NULL),
(7, 'Fantasy', NULL),
(8, 'Mystery', NULL),
(9, 'Self-Help', NULL),
(10, 'Romance', NULL),
(11, 'Comic\'s', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment_text` text DEFAULT NULL,
  `status` enum('approved','pending','disapproved') DEFAULT 'pending',
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note_text` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$p/Xxnm/E31wGGgdSDQFcmeO9r8lgGichyMvwhyJalOrAhvS4Z2Yzm', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`book_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`);

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
