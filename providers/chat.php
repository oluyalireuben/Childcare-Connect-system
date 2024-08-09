<?php
session_start();
include '../config/db.php';

if ($_SESSION['user_type'] !== 'provider') {
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

$users_sql = "SELECT * FROM users WHERE user_type = 'parent'";
$users_stmt = $conn->prepare($users_sql);
$users_stmt->execute();
$users = $users_stmt->fetchAll();

$messages_sql = "SELECT m.message, u.username AS sender_name FROM messages m JOIN users u ON m.sender_id = u.id WHERE m.receiver_id = :receiver_id OR m.sender_id = :receiver_id ORDER BY m.sent_at DESC";
$messages_stmt = $conn->prepare($messages_sql);
$messages_stmt->execute(['receiver_id' => $_SESSION['user_id']]);
$messages = $messages_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with Parents</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="container">
    <h2>Chat with Parents</h2>
    <form action="chat.php" method="POST">
        <label for="receiver_id">Select Parent:</label>
        <select name="receiver_id" required>
            <?php foreach ($users as $user) : ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="message">Message:</label>
        <textarea name="message" required></textarea>

        <button type="submit">Send</button>
    </form>

    <div class="chat-messages">
        <?php foreach ($messages as $message) : ?>
            <div class="message">
                <strong><?php echo $message['sender_name']; ?>:</strong>
                <p><?php echo $message['message']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
