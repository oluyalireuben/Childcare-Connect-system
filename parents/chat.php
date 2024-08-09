<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../public/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['sender_id' => $_SESSION['user_id'], 'receiver_id' => $receiver_id, 'message' => $message]);

    echo "Message sent!";
}

$users_sql = "SELECT * FROM users WHERE user_type != :user_type";
$users_stmt = $conn->prepare($users_sql);
$users_stmt->execute(['user_type' => $_SESSION['user_type']]);
$users = $users_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<h2>Chat with <?php echo $_SESSION['user_type'] == 'parent' ? 'Providers' : 'Parents'; ?></h2>
<form action="chat.php" method="POST">
    <label for="receiver_id">Select User:</label>
    <select name="receiver_id" required>
        <?php foreach ($users as $user) : ?>
            <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="message">Message:</label>
    <textarea name="message" required></textarea>

    <button type="submit">Send</button>
</form>
</body>
</html>
