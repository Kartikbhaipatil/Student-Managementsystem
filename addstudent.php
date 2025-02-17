<?php

session_start();
if(isset($_SESSION['uid']))
{
    echo "";
}
else{
    header('location: login.php');
}
  

include('header.php');
include('titleheader.php');
if(isset($_POST['submit'])){
    $_POST['submit'] = false;
}
?>
<br>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            height: 70vh;
        }
        h1{
            color: black;
            margin: 0px;
        }
        .form-container {
            width: 30%;
            margin: 40px auto;
            background: white;
            padding: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group input[type="file"] {
            padding: 5px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #4CAF50;
        }
        .submit-btn {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Add Students To The Records</h1>

    <div class="form-container">
        <form method="post" action="" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Roll No</label>
                <input type="text" name="rollno" placeholder="Enter Roll No" required>
            </div>

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter Full Name" required>
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" placeholder="Enter City" required>
            </div>

            <div class="form-group">
                <label>Parents Contact No.</label>
                <input type="text" name="pcon" placeholder="Enter Parents Contact Number" required>
            </div>

            <div class="form-group">
                <label>Standard</label>
                <input type="number" name="standard" placeholder="Enter Standard" required min="1" max="12">

            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" name="simg">
            </div>

            <button type="submit" name="submit" class="submit-btn">Submit</button>

        </form>
    </div>

</body>
</html>

<?php

if(isset($_POST['submit'])){
    $con = mysqli_connect('localhost','root','','sms');

	if($con == false){
		echo "Connection not successful";
	}
    $rollno = $_POST['rollno'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $pcon = $_POST['pcon'];
    $std = $_POST['standard'];
    $imagename = $_FILES['simg']['name'];
    $tempname = $_FILES['simg']['tmp_name'];
        
    move_uploaded_file($tempname,"dataimg/$imagename");
    
    
    
    
    $qry = "INSERT INTO `student`(`name`, `city`, `pcont`, `standard`, `rollno`,`image`) VALUES ('$name','$city','$pcon','$std','$rollno','$imagename')";
   
    $run = mysqli_query($con,$qry);
    
    if($run == true){
        ?>
        <script>
            alert('Data Inserted Successfully');
        </script>
        <?php
    }
        
}
?>