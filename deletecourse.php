<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Course deleted successfully!'); window.location.href='viewcourse.php';</script>";
    }
    $stmt->close();
}

$conn->close();
?>
