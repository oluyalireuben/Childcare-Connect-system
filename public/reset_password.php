<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        // Generate a password reset token (in a real system, you should email this token)
        $reset_token = bin2hex(random_bytes(16));
        $sql = "UPDATE users SET reset_token = :reset_token WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['reset_token' => $reset_token, 'email' => $email]);

        echo "Password reset link has been sent to your email.";
    } else {
        echo "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<form action="reset_password.php" method="POST">
    <h2>Reset Password</h2>
    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <button type="submit">Send Reset Link</button>
</form>
</body>
</html>
