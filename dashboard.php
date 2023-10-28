<!-- dashboard.php -->
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome, <?php echo $username; ?></title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?></h1>
    <!-- Add user-specific content here -->
    
    <a href="role_management.php">Role Management</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
