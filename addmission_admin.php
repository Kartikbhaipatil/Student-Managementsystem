<?php
    include('sidebar.php');
    // Database Connection
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sms";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM admisson";
    $result = mysqli_query($conn, $sql);
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('background.jpg');
        background-size: cover;
        background-position: center;
        margin: 0;
        text-align: center;
    }

    h1 {
        padding-top: 24px;
        color: blue;
        text-shadow: rgba(0, 0, 0, 0.1);
    }

    .profile-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .profile-card {
        background: white;
        width: 250px;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .profile-card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #007bff;
    }

    .profile-card h3 {
        margin: 10px 0;
        color: #333;
    }

    .profile-card p {
        color: #777;
    }
</style>
</head>
<body>

    <h1><strong>Student Admission Profiles</strong></h1>
    <div class="profile-container">
        
    <?php
      while ($getdata = $result->fetch_assoc()) {
         
    ?>

        <div class="profile-card">
        <img src="<?php echo $getdata['image']; ?>" alt="student Image">
           
            <h3><?php echo htmlspecialchars($getdata['name']); ?></h3>
            <p><?php echo htmlspecialchars($getdata['email']); ?></p>
            <p><?php echo htmlspecialchars($getdata['phone']); ?></p>
            <p><?php echo htmlspecialchars($getdata['course']); ?></p>
        </div>

    <?php
      }
    ?>

    </div>
</body>
</html>

