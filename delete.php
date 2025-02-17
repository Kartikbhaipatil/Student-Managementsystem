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

    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('1 row deleted successfully'); window.location.href='viewstudent_admin.php';</script>";
    } else {
        echo "<script>alert('Error deleting record'); window.location.href='viewstudent_admin.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No ID provided!'); window.location.href='viewstudent_admin.php';</script>";
}

$conn->close();
?>
