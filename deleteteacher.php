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

    $sql = "DELETE FROM teacher WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Teacher deleted successfully!'); window.location.href='viewteacher.php';</script>";
    } else {
        echo "<script>alert('Error deleting teacher.'); window.location.href='viewteacher.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
