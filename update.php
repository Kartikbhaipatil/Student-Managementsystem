<?php
include('sidebar.php');

$host = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

// Connect to database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}

// Get student ID from URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch student details
    $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $info = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "<script>alert('No ID provided!'); window.location.href='viewstudent_admin.php';</script>";
    exit();
}

// Handle update form submission
if (isset($_POST['update'])) {
    $name = $_POST['username']; // Corrected input name
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password']; // Fixed case issue

    // ✅ Check if email already exists (excluding current user's email)
    $check_email = $conn->prepare("SELECT id FROM user WHERE email = ? AND id != ?");
    $check_email->bind_param("si", $email, $id);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        // ❌ Email already exists, show alert
        echo "<script>alert('Email already exists! Please use a different email.');</script>";
    } else {
        // ✅ Email is unique, proceed with update
        $stmt = $conn->prepare("UPDATE user SET username=?, email=?, phone=?, password=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $email, $phone, $password, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Update successful'); window.location.href='viewstudent_admin.php';</script>";
        } else {
            echo "<script>alert('Update failed');</script>";
        }
        $stmt->close();
    }
    $check_email->close();
}
?>

<head>
    <style>
        .container {
            max-width: 400px;
            background: white;
            padding: 20px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transform: translateY(100px);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Update Student</h2>
    <form action="" method="POST">
        <label>Name:</label>
        <input type="text" name="username" required value="<?php echo htmlspecialchars($info['username']); ?>">

        <label>Email:</label>
        <input type="email" name="email" required value="<?php echo htmlspecialchars($info['email']); ?>">

        <label>Phone:</label>
        <input type="text" name="phone" required value="<?php echo htmlspecialchars($info['phone']); ?>">

        <label>Password:</label>
        <input type="password" name="password" required value="<?php echo htmlspecialchars($info['password']); ?>">

        <button type="submit" name="update">Update</button>
    </form>
</div>
</body>
</html>
