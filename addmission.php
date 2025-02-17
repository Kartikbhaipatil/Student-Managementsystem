<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Background Image */
        body {
            background: url('https://www.vibesofindia.com/wp-content/uploads/2022/01/1599193361PuCampus-1.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form Container */
        .form-container {
            width: 400px;
            background: rgba(254, 244, 244, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form {
            margin-bottom: 15px;
        }

        .form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form input, .form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #0c0808;
            border-radius: 5px;
            font-size: 16px;
        }

        .form input[type="file"] {
            border: none;
        }

        .form input:focus, .form select:focus {
            outline: none;
            border-color: #007bff;
        }

        .btn {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-transform: uppercase;
        }

        .btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

    <div class="form-container">
        <h2>Admission Form</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Full Name" required>
            </div>
            <div class="form">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form">
                <label for="phone">Phone Number</label>
                <input type="number" id="phone" name="phone" placeholder="Enter Phone Number" required>
            </div>
            <div class="form">
                <label for="course">Select Course</label>
                <select id="course" name="course" required>
                    <option value="">Choose Course</option>
                    <option value="BCA">BCA</option>
                    <option value="MCA">MCA</option>
                    <option value="B.Tech">B.Tech</option>
                    <option value="MBA">MBA</option>
                </select>
            </div>
            <div class="form">
                <label for="image">Upload Photo</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" name="submit" value="submit" id="submit" class="btn">Submit</button>
        </form>
    </div>

</body>
</html>

<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "sms";


$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST["submit"])) {
    $admission_name = $_POST['name'];
    $admission_email = $_POST['email'];
    $admission_phone = $_POST['phone'];
    $admission_course = $_POST['course'];
    $image = $_FILES['image']['name'];

    // Folder to Store Images
    $target_dir = "image/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); 
    }
    
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        echo "<script>alert('File is not an image.');</script>";
        exit();
    }

   
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        
        $stmt = $conn->prepare("INSERT INTO admisson (name, email, phone, course, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $admission_name, $admission_email, $admission_phone, $admission_course, $target_file);
        
        if ($stmt->execute()) {
            echo "<script>alert('Application submitted successfully!');</script>";
        } else {
            echo "<script>alert('Application failed. Please try again.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
    }
}

$conn->close();
?>
