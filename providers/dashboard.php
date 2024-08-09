<?php
session_start();
if ($_SESSION['user_type'] !== 'provider') {
    header("Location: ../public/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Provider Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<nav>
    <ul>
        <li><a href="profile.php">Update Profile</a></li>
        <li><a href="requests.php">Requests</a></li>
        <li><a href="chat.php">Chat</a></li>
        <li><a href="../public/logout.php">Logout</a></li>
    </ul>
</nav>
</body>
</html>
