<?php
session_start();
include '../config/db.php';

if ($_SESSION['user_type'] !== 'provider') {
    header("Location: ../public/login.php");
    exit();
}

$sql = "SELECT r.id, r.request_message, r.status, u.username AS parent_name
        FROM requests r
        JOIN users u ON r.parent_id = u.id
        WHERE r.provider_id = :provider_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['provider_id' => $_SESSION['user_id']]);
$requests = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Requests</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<h2>View Requests from Parents</h2>
<ul>
    <?php foreach ($requests as $request) : ?>
        <li>
            <strong>Parent:</strong> <?php echo $request['parent_name']; ?> <br>
            <strong>Request:</strong> <?php echo $request['request_message']; ?> <br>
            <strong>Status:</strong> <?php echo ucfirst($request['status']); ?>
            <form action="requests.php" method="POST">
                <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                <button name="status" value="approved">Approve</button>
                <button name="status" value="declined">Decline</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
