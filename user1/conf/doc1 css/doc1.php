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
    /*
    $photo = $_FILES['photo']['fullname']; // Note: This should be handled as a file upload, not a text field
    move_uploaded_file($_FILES["photo"]["fullname"], "../admin/dist/img/" . $_FILES["photo"]["fullname"]);*/
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Online KYC Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center; /* Center align the heading */
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            color: #1e90ff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        #video {
            width: 100%;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        #canvas {
            display: none;
        }

        #take-photo-button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #1e90ff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h2>KYC Form</h2>
    <form action="process_kyc.php" method="post" enctype="multipart/form-data">

        <label for="aadhar">Aadhar Number:</label>
        <input type="text" name="aadhar" id="aadhar" required><br><br>

        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" required><br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob" required><br><br>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea><br><br>

        <label for="exampleInputFile">Income Proof:</label>
        <input type="file" name="income_proof" id="exampleInputFile" required><br><br>

        <label for="source_of_funds">Source of Funds:</label>
        <input type="text" name="source_of_funds" id="source_of_funds" required><br><br>

        <video id="video" autoplay></video>
        <button id="take-photo-button">Take Photo</button>
        <canvas id="canvas" width="400" height="300"></canvas>
        <input type="hidden" name="photo" id="photo">

        <input type="submit" value="Submit">
    </form>

    <script>
        // Access the camera and stream video to the video element
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                var video = document.getElementById('video');
                video.srcObject = stream;
                video.play();
            })
            .catch(function (err) {
                console.log("An error occurred: " + err);
            });

        // Capture photo from the video stream
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        var video = document.getElementById('video');
        var takePhotoButton = document.getElementById('take-photo-button');
        takePhotoButton.addEventListener('click', function () {
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            var photoDataUrl = canvas.toDataURL('image/png');
            document.getElementById('photograph').value = photoDataUrl;
        });
    </script>
</body>
</html>
