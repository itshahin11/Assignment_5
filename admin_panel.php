<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Admin panel content, including role management functionality.
?>

<!-- Your HTML for admin panel -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        .content {
            margin-top: 20px;
        }
        .button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<a href="role_management.php">Role Management</a>
    <div class="header">
        <h1>Welcome to the Admin Panel</h1>
    </div>
    <div class="container">
        <div class="content">
            <h2>Admin Panel Overview</h2>
            <p>Welcome to the admin panel. Here, you have access to various administrative functions and can manage user roles and permissions.</p>

            <h2>Role Management</h2>
            <p>Use the following options to manage user roles:</p>
            <button class="button">Create Role</button>
            <button class="button">Edit Role</button>
            <button class="button">Delete Role</button>

            <h2>User Management</h2>
            <p>Admins can also manage user accounts and permissions:</p>
            <button class="button">View Users</button>
            <button class="button">Edit User</button>
            <button class="button">Delete User</button>
        </div>
    </div>
</body>
</html>
