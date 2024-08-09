<?php
session_start();
include '../config/db.php';

if ($_SESSION['user_type'] !== 'parent') {
    header("Location: ../public/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    $sql = "UPDATE users SET username = :username, email = :email, phone = :phone, location = :location WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['username' => $username, 'email' => $email, 'phone' => $phone, 'location' => $location, 'id' => $id]);

    echo "Profile updated successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<form action="profile.php" method="POST">
    <h2>Update Profile</h2>
    <label for="username">Username:</label>
    <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="<?php echo $_SESSION['phone']; ?>">

    <label for="location">Location:</label>
    <input type="text" name="location" value="<?php echo $_SESSION['location']; ?>">

    <button type="submit">Update</button>
</form>
</body>
</html>
