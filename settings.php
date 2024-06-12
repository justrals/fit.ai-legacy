<?php
session_start();
require_once 'users.php';

if (!isset($_SESSION['user'])) {
    header("Location: sign-in.php");
    exit();
}

$change_success = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $username = $_SESSION['user'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (isset($users[$username]) && $users[$username]['password'] === $old_password) {
        if ($new_password === $confirm_password) {
            $users[$username]['password'] = $new_password;
            $user_data = '<?php $users = ' . var_export($users, true) . '; ?>';
            if (file_put_contents('users.php', $user_data)) {
                $change_success = true;
                session_unset();
                session_destroy();
                header("Location: sign-in.php");
                exit();
            } else {
                $error_message = "Failed to save new password. Please try again later.";
            }
        } else {
            $error_message = "New passwords do not match.";
        }
    } else {
        $error_message = "Old password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FIT.AI - Settings</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <div class="hero">
                <h1>Settings</h1>
                <?php if ($change_success): ?>
                    <p>Password changed successfully.</p>
                <?php else: ?>
                    <div class="form-wrapper">
                        <p>Logged in as: <?php echo $_SESSION['user']; ?></p>
                        <form action="settings.php" method="post" class="form">
                            <input type="password" placeholder="Old Password" name="old_password" required maxlength="30" class="password-old">
                            <input type="password" placeholder="New Password" name="new_password" required maxlength="30" class="password-new">
                            <input type="password" placeholder="Confirm New Password" name="confirm_password" maxlength="30" required class="password-confirm">
                            <button type="submit" name="change_password" class="button button--light">Change Password</button>
                        </form>
                        <?php if (!empty($error_message)): ?>
                            <p><?php echo $error_message; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
