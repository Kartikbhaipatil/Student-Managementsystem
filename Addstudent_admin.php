<?php
 include('sidebar.php');

?>

  <style>
    .form-container {
      background: #fff;
      width: 300px;
      height: 60vh;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      transform: translate(160%,30%);
    }
    
    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
      color: #333;
    }
    
    .group {
      margin-bottom: 15px;
    }
    
    .group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      font-size: 14px;
      color: #555;
    }
    
    .group input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }
    
    .submit{
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      border: none;
      color: #fff;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }
    
    .submit:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Add Student</h2>
    <form action="" method="post">
      <div class="group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter name" required>
      </div>
      <div class="group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required>
      </div>
      <div class="group">
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter phone" required>
      </div>
      <div class="group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
      </div>
      <button type="submit" class="submit" name="add_student">Add Student</button>
    </form>
  </div>
</body>
</html>


<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sms";

    $conn = mysqli_connect($host,$username,$password,$dbname);

    if(!$conn)
    {
        die("error ". $conn);
    }

  if (isset($_POST['add_student'])) {
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $user_password = $_POST['password'];
    $role = "student";

    // **Check if the email already exists**
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_count = $result->num_rows; // **Set $row_count to avoid the undefined variable error**

    if ($row_count > 0) {
        echo "Email already exists. Try another one.";
    } else {
        $stmt = $conn->prepare("INSERT INTO user(username, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user_name, $user_email, $user_phone, $user_password);
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>
                    alert('Data uploaded successfully');
                  </script>";
        } else {
            echo "Data not uploaded";
        }
    }
    
    $stmt->close();
    $conn->close();
}
?>

