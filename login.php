<!-- login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login_process.php" method="post">
        Email: <input type="email" name="email"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

<!-- login_process.php -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($username, $stored_email, $stored_password) = explode('|', $user);
        if ($email == $stored_email && password_verify($password, $stored_password)) {
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit();
        }
    }

    // যদি সদস্যের সাথে কোনো মেলা না পাওয়া যায়
    echo "অবৈধ পরিচিতি। <a href='login.php'>আবার চেষ্টা করুন</a>";
}
?>
