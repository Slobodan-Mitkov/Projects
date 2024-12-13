<?php
session_start();
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
    <link rel="stylesheet" href="../css/about-us.css" />
    <!---------------------------- Website icon ---------------------------->
    <link rel="icon" type="image/x-icon" href="../Logo.png" />
    <title>About us</title>
  </head>
  <body>
    <!---------------------------- Navbar ---------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="./main.php"><img src="../Logo.png" class="logo" alt="logo"> <p class="logo-text">Brainster Library</p></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link active"
                aria-current="page"
                href="./main.php"
                >Home</a
              >
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
    <!---------------------------- About us description ---------------------------->
    <div class="container">
      <h1>About us</h1>
      <p>
      Brainster Library is a forward-thinking technology company specializing in digital solutions for education and knowledge sharing. One of its flagship products is an online library that provides users with access to a vast collection of books, research papers, and educational resources. Brainster Library's online platform is designed to cater to a wide audience, from students and academics to casual readers. The platform offers both free and premium content, with subscriptions available for institutions and individuals alike. Its vast repository includes fiction, non-fiction, academic textbooks, and industry-specific publications, all accessible through a user-friendly web and mobile interface. The company emphasizes seamless user experience, leveraging advanced search algorithms to help users quickly find relevant content. It also integrates personalized recommendations, offering tailored suggestions based on reading habits and preferences. Users can highlight, bookmark, and annotate sections, making it ideal for both casual reading and serious research. Behind the scenes, Brainster Library’s development team has built the platform on a robust infrastructure, ensuring high availability and security. They employ the latest technologies, including cloud storage, to handle the large volume of data and traffic. Moreover, their focus on cybersecurity guarantees that user data and transactions are protected at all times. With a mission to make knowledge accessible globally, Brainster Library collaborates with publishers, authors, and educational institutions to expand its library. They continually innovate, incorporating features such as virtual book clubs, author interviews, and interactive reading experiences to keep users engaged. Brainster Library is not just about providing books; it’s about creating a community of learners and readers, connected through the love of knowledge and the power of technology
      </p>
    </div>
    <!---------------------------- About us members ---------------------------->
    <div class="container">
      <h2>The Team</h2>
      <div class="row">
        <div class="col">
          <img
            src="https://t3.ftcdn.net/jpg/01/21/64/88/360_F_121648819_ZQ0tZ6tjLzxim1SG7CQ86raBw4sglCzB.jpg"
            alt="member"
          />
        </div>
        <div class="col">
          <img
            src="https://t3.ftcdn.net/jpg/01/21/64/88/360_F_121648819_ZQ0tZ6tjLzxim1SG7CQ86raBw4sglCzB.jpg"
            alt="member"
          />
        </div>
        <div class="col">
          <img
            src="https://t3.ftcdn.net/jpg/01/21/64/88/360_F_121648819_ZQ0tZ6tjLzxim1SG7CQ86raBw4sglCzB.jpg"
            alt="member"
          />
        </div>
      </div>
    </div>
    <!---------------------------- About us sponsors ---------------------------->
    <div class="container container-sponsors">
      <h2>Our Sponsors</h2>
      <div class="row">
        <div class="col">
          <img
            src="https://pgmha.com/wp-content/uploads/sites/1696/2021/05/Sponsor-Icon-300x300Red2.png"
            alt="sponsor"
          />
        </div>
        <div class="col">
          <img
            src="https://pgmha.com/wp-content/uploads/sites/1696/2021/05/Sponsor-Icon-300x300Red2.png"
            alt="sponsor"
          />
        </div>
        <div class="col">
          <img
            src="https://pgmha.com/wp-content/uploads/sites/1696/2021/05/Sponsor-Icon-300x300Red2.png"
            alt="sponsor"
          />
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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
