<?php
// Establish connection to the database
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "internetbanking"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aadhar=$_POST['aadhar'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone= $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $source_of_funds = $_POST['source_of_funds'];
    $photo = $_POST['photo']; // Note: This should be handled as a file upload, not a text field
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../admin/dist/img/" . $_FILES["photo"]["name"]);
    $income_proof= $_POST['income_proof'];

    // Insert data into the database
    $sql = "INSERT INTO kyc (aadhar,fullname, email, phone, dob, address, income_proof,source_of_funds, photo)
            VALUES ('$aadhar','$fullname', '$email','$phone', '$dob', '$address', '$income_proof','$source_of_funds', '$photo')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
