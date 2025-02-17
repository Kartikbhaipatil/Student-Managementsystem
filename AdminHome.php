<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }
    
    body {
        display: flex;
        height: 100vh;
        background-color: #f4f4f4;
    }
    
    .sidebar {
        width: 250px;
        background-color: #2c3e50;
        color: white;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .profile {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 10px;
        border: 2px solid white;
    }

    .profile h3 {
        font-size: 18px;
    }

    .profile p {
        font-size: 14px;
        color: #dfe6e9;
    }

    .menu {
        list-style: none;
        padding: 0;
    }

    .menu li {
        padding: 12px;
        cursor: pointer;
        border-radius: 5px;
    }

    .menu li:hover {
        background-color: #34495e;
    }

    .menu li a {
        color: white;
        text-decoration: none;
        font-size: 16px;
    }

    .main-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .navbar {
        background-color: #2980b9;
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 20px;
    }

    .logout-btn {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 14px;
        border-radius: 5px;
    }

    .logout-btn:hover {
        background-color: #c0392b;
    }

    .dashboard-content {
        padding: 20px;
    }

    .dashboard-content h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    .dashboard-content p {
        font-size: 16px;
        color: #555;
    }
</style>
</head>
<body>

    <div class="sidebar">
        <div class="profile">
            <img src="image/user-3.jpg" alt="Admin Profile">
            <h3>Admin</h3>
            <p>admin@gmail.com</p>
        </div>
        <ul class="menu">
            <li><a href="addmission_admin.php">🏫 Admission Panel</a></li>
            <li><a href="Addstudent_admin.php">👨‍🎓 Add Student</a></li>
            <li><a href="viewstudent_admin.php">📜 View Student</a></li>
            <li><a href="Addteacher.php">👨‍🏫 Add Teacher</a></li>
            <li><a href="viewteacher.php">📖 View Teacher</a></li>
            <li><a href="Addcourse.php">📚 Add Courses</a></li>
            <li><a href="viewcourse.php">📅 view Course</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="navbar">
            <span>Admin Dashboard</span>
            <button class="logout-btn"><a href="login.php">Logout</a></button>
        </div>

        <div class="dashboard-content">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>Manage students, teachers, courses, and attendance from the sidebar.</p>
        </div>
    </div>

</body>
</html>
