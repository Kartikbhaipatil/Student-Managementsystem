<?php
include('sidebar.php');
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

<body>

<div class="container">
    <h2>Add Teacher</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Course:</label>
        <input type="text" name="course" required>

        <label>Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Upload Image:</label>
        <input type="file" name="image" required>

        <button type="submit" name="add_teacher">Add Teacher</button>
    </form>
</div>

<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sms";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    if (isset($_POST['add_teacher'])) {
        $name = $_POST['name'];
        $course = $_POST['course'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];

        $folder = "./image/" . $image;
        $folder_db = "image/" . $image;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $folder)) {
    
            $stmt = $conn->prepare("INSERT INTO teacher (name, course, discription, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $course, $description, $folder_db);

            if ($stmt->execute()) {
                echo "<script>alert('Teacher added successfully!'); window.location.href='viewteacher.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "<script>alert('Failed to upload image.');</script>";
        }
    }

    $conn->close();
?>
</body>
</html>
