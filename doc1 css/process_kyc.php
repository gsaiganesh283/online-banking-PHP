<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle uploaded files
    $target_dir = "uploads/";
    $identity_proof = $target_dir . basename($_FILES["identity_proof"]["name"]);
    $address_proof = $target_dir . basename($_FILES["address_proof"]["name"]);
    $photograph = $target_dir . basename($_FILES["photograph"]["name"]);
    $income_proof = $target_dir . basename($_FILES["income_proof"]["name"]);

    // Move uploaded files to server
    move_uploaded_file($_FILES["identity_proof"]["tmp_name"], $identity_proof);
    move_uploaded_file($_FILES["address_proof"]["tmp_name"], $address_proof);
    move_uploaded_file($_FILES["photograph"]["tmp_name"], $photograph);
    move_uploaded_file($_FILES["income_proof"]["tmp_name"], $income_proof);


       
    // Retrieve other form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $source_of_funds = $_POST['source_of_funds'];
  


    // Here you can process the form data, such as storing it in a database or performing additional validation
    // For demonstration purposes, we'll just display the submitted data
    echo "<h2>Submitted Details:</h2>";
    echo "<p><strong>Full Name:</strong> $full_name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Date of Birth:</strong> $dob</p>";                   
    echo "<p><strong>Address:</strong> $address</p>";
    echo "<p><strong>Source of Funds:</strong> $source_of_funds</p>";
    echo "<p><strong>Identity Proof:</strong> <a href='$identity_proof'>Download</a></p>";
    echo "<p><strong>Address Proof:</strong> <a href='$address_proof'>Download</a></p>";
    echo "<p><strong>Photograph:</strong> <a href='$photograph'>Download</a></p>";
    echo "<p><strong>Income Proof:</strong> <a href='$income_proof'>Download</a></p>";
}
?>