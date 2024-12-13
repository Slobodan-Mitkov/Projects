<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!---------------- cdn link for bootstrap ---------------->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <!---------------- cdn link for font-awesome ---------------->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <!---------------- CSS ---------------->
    <link rel="stylesheet" href="../css/reboot.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
    <link rel="stylesheet" href="../css/clients.css" />
    <link rel="stylesheet" href="../css/footer.css" />
    <!---------------- Icon for page ---------------->
    <link rel="icon" type="image/x-icon" href="../images/Logo.png" />
    <title>Brainster Labs</title>
  </head>
  <body>
    <!---------------- Navbar ---------------->
    <header>
      <nav>
      <div class="logo">
        <div class="inner-logo">
          <a href=".././index.html">
            <img src=".././images/Logo.png" alt="brainster-logo" />
            <h6>BRAINSTER</h6>
          </a>
        </div>
      </div>
      <button type="button" class="btn-hamburger" data-action="nav-toggle">
        <span class="span1"></span>
        <span class="span2"></span>
        <span class="span3"></span>
        <span></span>
        <span></span>
      </button>
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="https://brainster.co/marketing/">Академија за маркетинг</a>
        </li>
        <li class="nav-item">
          <a href="https://brainster.co/full-stack/"
            >Академија за програмирање</a
          >
        </li>
        <li class="nav-item">
          <a href="https://brainster.co/data-science/"
            >Академија за data science</a
          >
        </li>
        <li class="nav-item">
          <a href="https://brainster.co/graphic-design/"
            >Академија за дизајн
          </a>
        </li>
        <a href="#" class="btn">Вработи наш студент</a>
        <a href="#" data-action="dropdown-toggle"></a>
      </ul>
      </nav>
    </header>
    <!---------------- Form page ---------------->
    <section>
      <div class="clients container-fluid py-3">
      <h2>Вработи студент</h2>
      <form name="myForm" id="applicationForm" action="./submit_form.php" method="post" onsubmit="return validateForm()">
        <div class="row align-items-end overflow">
          <div class="col-lg-6">
            <label for="name">Име и Презиме</label>
            <input
              type="text"
              id="name"
              name="name"
              required pattern="[a-zA-Z\s]+" 
              placeholder="Вашето име и презиме"
            />
            <div class="error-message" id="name-error"></div>
          </div>
          <div class="col-lg-6">
            <label for="companyName">Име на компанија</label>
            <input
              type="text"
              id="companyName"
              name="companyName"
              required pattern="[a-zA-Z\s]+" 
              placeholder="Име на вашата компанија" 
            /><div class="error-message" id="companyName-error"></div>
          </div>
          <div class="col-lg-6">
            <label for="email">Контакт мејл</label>
            <input
              type="email"
              id="email"
              name="email"
              required pattern="^[a-zA-Z0-9._%+-]+@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$"
              placeholder="Контакт имејл на вашата компанија"
            /><div class="error-message" id="email-error"></div>
          </div>
          <div class="col-lg-6">
            <label for="phone">Контакт телефон</label>
            <input
              type="tel"
              id="phone"
              name="phone"
              required pattern="\+389\d{8}" 
              placeholder="Контакт телефон на вашата компанија"
            /><div class="error-message" id="phone-error"></div>
          </div>
          <div class="col-lg-6">
            <label for="studentType">Тип на студенти</label>
            <select id="studentType" name="studentType" onchange="handleStudentTypeChange()">
              <?php
                    $selectedType = isset($_POST['studentType']) ? $_POST['studentType'] : '';

        
                    echo "<option value='' disabled";
                    if (empty($selectedType)) {
                    echo " selected";
                    }
                   echo ">Изберете тип на студент</option>";

                    $conn = new mysqli("localhost", "root", "", "registration");

                    if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    }

                    $fetchTypesSql = "SELECT * FROM student_types";
                    $result = $conn->query($fetchTypesSql);

                    while ($row = $result->fetch_assoc()) {
                    $typeValue = $row['type_name'];
                    echo "<option value='$typeValue'";
                    if ($selectedType === $typeValue) {
                    echo " selected";
                    }
                    echo ">Студенти од $typeValue</option>";
                    }

                    $conn->close();
               ?>
            </select>
          </div>
          <div class="col-lg-6">
            <input
              id="submitButton"
              class="button-last no-border"
              type="submit"
              value="Submit"
              onclick="submitForm(event);"
            />
          </div>
        </div>
      </form>
      </div>
    </section>
    <!---------------- Footer ---------------->
    <footer><p>Изработено со ❤️ од студентите од Brainster</p></footer>

    <!-------------- Javascript from js file -------------->
    <script src="../js/navbar.js"></script>
    <script src="../js/student_type.js"></script>
    <script src="../js/submit-form.js"></script>
    <script src="../js/first-option.js"></script>
    <script src="../js/error-message.js"></script>
    <!-------------- Javascript from this file -------------->
    <script>
       var requiredInputs = document.querySelectorAll('input[required]');
        requiredInputs.forEach(function (input) {
        input.addEventListener('invalid', function (e) {
        e.preventDefault();
        input.setCustomValidity('');
         });
        input.addEventListener('input', function () {
        input.setCustomValidity('');
         });
         });
      </script>
    <script>
      <?php
        $conn = new mysqli("localhost", "root", "", "registration");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $fetchTypesSql = "SELECT * FROM student_types";
        $result = $conn->query($fetchTypesSql);

        $studentTypes = array();
        while ($row = $result->fetch_assoc()) {
            $studentTypes[] = $row['type_name'];
        }

        echo "var studentTypes = " . json_encode($studentTypes) . ";";

        $conn->close();
        ?>
     </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous">
     </script>
  </body>
</html>
