<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["username"] !== "admin") {
    header("Location: dashboard.php"); // Redirect non-admin users
    exit();
}

// Load existing roles
$roles = file('roles.txt', FILE_IGNORE_NEW_LINES);

// Handle role creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_role"])) {
    $new_role = $_POST["new_role"];
    if (!in_array($new_role, $roles)) {
        $roles[] = $new_role;
        file_put_contents('roles.txt', implode("\n", $roles));
    }
}

// Handle role deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_role"])) {
    $role_to_delete = $_POST["role_to_delete"];
    $roles = array_diff($roles, [$role_to_delete]);
    file_put_contents('roles.txt', implode("\n", $roles));
}

// Handle role editing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_role"])) {
    $selected_role = $_POST["selected_role"];
    $updated_role = $_POST["updated_role"];

    if (in_array($selected_role, $roles)) {
        $index = array_search($selected_role, $roles);
        $roles[$index] = $updated_role;
        file_put_contents('roles.txt', implode("\n", $roles));
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Role Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            margin: 20px 0;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="submit"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        select {
            height: 30px;
        }
    </style>
</head>
<body>
    <h1>Role Management (Admin Only)</h1>
    <div class="container">
        <!-- Role creation form -->
        <form action="" method="post">
            <label for="new_role">New Role:</label>
            <input type="text" id="new_role" name="new_role" required>
            <input type="submit" name="create_role" value="Create Role">
        </form>

        <!-- Role deletion form -->
        <form action="" method="post">
            <label for="role_to_delete">Delete Role:</label>
            <select id="role_to_delete" name="role_to_delete" required>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="delete_role" value="Delete Role">
        </form>

        <!-- Role editing form -->
        <form action="" method="post">
            <label for="selected_role">Select Role to Edit:</label>
            <select id="selected_role" name="selected_role" required>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="updated_role">Updated Role:</label>
            <input type="text" id="updated_role" name="updated_role" required>
            <input type="submit" name="edit_role" value="Edit Role">
        </form>
    </div>
    <a href="dashboard.php">Dashboard</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
