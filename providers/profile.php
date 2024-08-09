<?php
session_start();
include '../config/db.php';

if ($_SESSION['user_type'] !== 'provider') {
    header("Location: ../public/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $services = $_POST['services'];
    $hourly_rate = $_POST['hourly_rate'];
    $payment_methods = $_POST['payment_methods'];
    $profile_image = $_POST['profile_image'];

    $sql = "UPDATE users SET username = :username, qualification = :qualification, experience = :experience, services = :services, hourly_rate = :hourly_rate, payment_methods = :payment_methods, profile_image = :profile_image WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'qualification' => $qualification,
        'experience' => $experience,
        'services' => $services,
        'hourly_rate' => $hourly_rate,
        'payment_methods' => $payment_methods,
        'profile_image' => $profile_image,
        'id' => $id
    ]);

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

    <label for="qualification">Qualification:</label>
    <textarea name="qualification" required><?php echo $_SESSION['qualification']; ?></textarea>

    <label for="experience">Experience:</label>
    <textarea name="experience" required><?php echo $_SESSION['experience']; ?></textarea>

    <label for="services">Services:</label>
    <textarea name="services" required><?php echo $_SESSION['services']; ?></textarea>

    <label for="hourly_rate">Hourly Rate:</label>
    <input type="text" name="hourly_rate" value="<?php echo $_SESSION['hourly_rate']; ?>">

    <label for="payment_methods">Payment Methods:</label>
    <textarea name="payment_methods" required><?php echo $_SESSION['payment_methods']; ?></textarea>

    <label for="profile_image">Profile Image:</label>
    <input type="file" name="profile_image">

    <button type="submit">Update</button>
</form>
</body>
</html>
