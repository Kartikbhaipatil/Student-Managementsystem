<?php
include('sidebar.php');

$host = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all teachers
$sql = "SELECT * FROM teacher";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teachers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .teacher-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .teacher-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 30%;
            text-align: center;
            position: relative;
        }
        .teacher-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .teacher-card h2 {
            color: #007bff;
            margin-top: 10px;
            font-size: 18px;
        }
        .teacher-card p {
            color: #555;
            font-size: 14px;
            margin-top: 5px;
        }
        .delete-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .delete-btn:hover {
            background: darkred;
        }
        @media screen and (max-width: 768px) {
            .teacher-card {
                width: 45%;
            }
        }
        @media screen and (max-width: 480px) {
            .teacher-card {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>View Teachers List</h1>
    <div class="teacher-grid">
    <?php 
        while ($row = $result->fetch_assoc())
        {
     ?>
        <div class="teacher-card">
            <img src="<?php echo $row['image']; ?>" alt="Teacher Image">
            <h2><?php echo htmlspecialchars($row['name']); ?></h2>
            <p><?php echo htmlspecialchars($row['discription']); ?></p>

            <a href="deleteteacher.php?id=<?php echo $row['id']; ?>" 
               class="delete-btn" 
               onclick="return confirm('Are you sure you want to delete this teacher?');">
               Delete
            </a>
        </div>
    <?php 
        } 
    ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
