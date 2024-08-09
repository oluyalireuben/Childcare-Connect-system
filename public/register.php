<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user_type = $_POST['user_type'];

    $sql = "INSERT INTO users (username, email, password, user_type) VALUES (:username, :email, :password, :user_type)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password, 'user_type' => $user_type]);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<form action="register.php" method="POST">
    <h2>Register</h2>
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="user_type">I am a:</label>
    <select name="user_type" required>
        <option value="parent">Parent</option>
        <option value="provider">Provider</option>
    </select>

    <button type="submit">Register</button>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</form>
</body>
</html>
