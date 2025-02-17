<?php
include('sidebar.php');

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST['add_course'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $faculty_name = $_POST['faculty_name'];

    $stmt = $conn->prepare("INSERT INTO courses (name,description,faculty_name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $description,$faculty_name);

    if ($stmt->execute()) {
        echo "<script>alert('Course added successfully!'); window.location.href='viewcourse.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
        
    $stmt->close();
    } 

$conn->close();
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 500px;
        background: white;
        padding: 20px;
        margin: 50px auto;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        color: #333;
    }
    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }
    input, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    input[type="file"] {
        border: none;
    }
    button {
        width: 100%;
        padding: 10px;
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        margin-top: 15px;
        border-radius: 5px;
        font-size: 16px;
    }
    button:hover {
        background: #0056b3;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Add Course</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Course Name:</label>
        <input type="text" name="name" required>

        <label>Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label>faculty Name:</label>
        <input type="text" name="faculty_name" required>

        <button type="submit" name="add_course">Add Course</button>
    </form>
</div>

</body>
</html>
