<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize and validate input
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = sanitizeInput($_POST['name']);
    $companyName = sanitizeInput($_POST['companyName']);
    $email = sanitizeInput($_POST['email']);
    $studentTypeName = sanitizeInput($_POST['studentType']);
    $phone = sanitizeInput($_POST['phone']);

    if (empty($name) || empty($companyName) || empty($email) || empty($studentTypeName) || empty($phone)) {
        echo "";
    } else {
        $conn = new mysqli("localhost", "root", "", "registration");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $checkTypeSql = "SELECT id FROM student_types WHERE type_name='$studentTypeName'";
        $result = $conn->query($checkTypeSql);

        if ($result->num_rows == 0) {
            $insertTypeSql = "INSERT INTO student_types (type_name) VALUES ('$studentTypeName')";
            $conn->query($insertTypeSql);
        }

        $getTypeIdSql = "SELECT id FROM student_types WHERE type_name='$studentTypeName'";
        $result = $conn->query($getTypeIdSql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $studentTypeId = $row['id'];

            $insertClientSql = "INSERT INTO clients (name, companyName, email, student_type_id, phone_number) VALUES ('$name', '$companyName', '$email', '$studentTypeId', '$phone')";
            if ($conn->query($insertClientSql) === TRUE) {
                echo "<script>window.location.href = './clients.php';</script>";
            } else {
                echo "Error submitting the form: " . $conn->error;
            }
        } else {
            echo "Error submitting the form.";
        }

        $conn->close();
    }
}