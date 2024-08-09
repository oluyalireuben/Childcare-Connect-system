<?php
session_start();
include '../config/db.php';

if ($_SESSION['user_type'] !== 'parent') {
    header("Location: ../public/login.php");
    exit();
}

$providers_sql = "SELECT * FROM users WHERE user_type = 'provider'";
$providers_stmt = $conn->prepare($providers_sql);
$providers_stmt->execute();
$providers = $providers_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Providers</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="container">
    <h2>Search for Providers</h2>
    <ul class="users-list">
        <?php foreach ($providers as $provider) : ?>
            <li>
                <strong><?php echo $provider['username']; ?></strong>
                <p>Qualification: <?php echo $provider['qualification']; ?></p>
                <p>Experience: <?php echo $provider['experience']; ?></p>
                <p>Services: <?php echo $provider['services']; ?></p>
                <p>Hourly Rate: $<?php echo $provider['hourly_rate']; ?></p>
                <form action="request_service.php" method="POST">
                    <input type="hidden" name="provider_id" value="<?php echo $provider['id']; ?>">
                    <button type="submit">Request Service</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>
