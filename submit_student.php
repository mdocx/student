<?php
$servername = "localhost";
$username = "niniodatabase"; // Replace with your MySQL username
$password = "Mjrkmb2131$"; // Replace with your MySQL password
$dbname = "students_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO students (first_name, last_name, email, phone, address, age, birthdate, course, country, zipcode)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === FALSE) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssisssss", $first_name, $last_name, $email, $phone, $address, $age, $birthdate, $course, $country, $zipcode);

    // Set parameters and execute
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $course = $_POST['course'];
    $country = $_POST['country'];
    $zipcode = $_POST['zipcode'];

    if ($stmt->execute()) {
        // Redirect to the success page
        header("Location: success.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
