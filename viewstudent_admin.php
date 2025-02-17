<?php
include('sidebar.php');

$host = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error connecting: " . $conn->connect_error);
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0px;
      background: #f4f4f4;
    }
    
    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
    }
    
    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
      padding-top: 10px;
    }
    
    .table-wrapper {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background: #007bff;
      color: #fff;
    }
    
    thead th {
      text-align: left;
      padding: 12px;
      font-size: 16px;
    }
    
    tbody td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      vertical-align: middle;
    }
    
    tbody tr:nth-child(even) {
      background: #f9f9f9;
    }
    
    .profile-pic {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }
    
    @media (max-width: 768px) {
      thead, tbody, th, td, tr {
        display: block;
      }
      
      thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }
      
      tr {
        border: 1px solid #ccc;
        margin-bottom: 10px;
      }
      
      td {
        border: none;
        padding-left: 50%;
        position: relative;
      }
      
      td:before {
        position: absolute;
        left: 10px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
      }
      
      td:nth-of-type(1):before { content: "Profile"; }
      td:nth-of-type(2):before { content: "Name"; }
      td:nth-of-type(3):before { content: "Email"; }
      td:nth-of-type(4):before { content: "Phone"; }
      td:nth-of-type(5):before { content: "Course"; }
    }
    .btn{
    color: #63c0b7;
    background-color: #63f472;
    padding: 10px;
    text-align: center;
    height: 10px;
    width: 80px;
    border-radius: 8px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>View Students</h1>
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Profile</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
            <th>Delete</th>
            <th>Update</th>
          </tr>
        </thead>
        <tbody>
       
    <?php
        while ($viewdata = $result->fetch_assoc()) {
    ?>
          <tr>
            <td>
              <img src="student1.jpg" alt="Student 1" class="profile-pic">
            </td>
            <td><?php echo "{$viewdata['username']}"; ?></td>
            <td><?php echo "{$viewdata['email']}"; ?></td>
            <td><?php echo "{$viewdata['phone']}"; ?></td>
            <td><?php echo "{$viewdata['password']}"; ?></td>
            <td class="btn" style="background-color:red">
            <a href="#" onclick="checkdata(<?php echo $viewdata['id']; ?>)">Delete</a></td>
            <td class="btn">
            <a href="update.php?id=<?php echo $viewdata['id']; ?>">Update</a>
            </td>
          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function checkdata(id) {
        var confirmDelete = confirm('Are you sure you want to delete this record?');
        if (confirmDelete) {
            window.location.href = "delete.php?id=" + id;
        }
    }
  </script>

</body>
</html>
