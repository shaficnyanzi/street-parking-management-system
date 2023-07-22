<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Database connection details
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'smart_users';

    // Connect to the MySQL server
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the current user's ID (you can modify this based on your authentication method)
    $userId = 1; // Assuming the user ID is 1 for demonstration purposes

    // Retrieve the current user's information from the database
    $selectQuery = "SELECT * FROM users WHERE id = $userId";
    $result = mysqli_query($conn, $selectQuery);
    $user = mysqli_fetch_assoc($result);

    // Verify the current password
    if (password_verify($currentPassword, $user['password'])) {
        // Check if the new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE id = $userId";
            mysqli_query($conn, $updateQuery);

            echo "Password updated successfully.";
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }

    // Close the connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Password</title>
</head>
<body>
    <h2>Update Password</h2>
    <form method="POST" action="">
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required><br><br>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <input type="submit" value="Update Password">
    </form>
</body>
</html>
