<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FIT.AI - Sign Up</title>
    <link rel="icon" href="#">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        $email = $_POST['email'];
        $username = $_POST['user'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        } elseif (empty($username) || empty($password)) {
            $error = "All fields are required";
        } else {
            include 'users.php';

            if (array_key_exists($username, $users)) {
                $error = "Username already exists";
            } else {
                $users[$username] = [
                    'email' => $email,
                    'password' => $password
                ];

                $users_content = "<?php\n\$users = " . var_export($users, true) . ";\n?>";

                error_log("Attempting to write to users.php");
                error_log("Users content: " . $users_content);

                if (file_put_contents('users.php', $users_content) === false) {
                    $error = "Failed to save user data. Please try again later.";
                    error_log("Error: Could not write to users.php");
                } else {
                    header('Location: sign-in.php');
                    exit;
                }
            }
        }
    }
    ?>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <div class="hero">
                <h1>Sign Up</h1>    
                <div class="form-wrapper">
                    <?php if (isset($error)): ?>
                        <div class="error"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form action="" method="post" class="form form--sign-up">
                        <input type="email" placeholder="Email" name="email" class="email" maxlength="50" required>
                        <input type="text" placeholder="Username" name="user" required maxlength="20" class="username-signup">
                        <input type="password" placeholder="Password" name="password" required maxlength="30" class="password-signup">
                        <button type="submit" name="register" class="button button--light">Register</button>
                        <a href="sign-in.php"><p class="goto-sign-in">Already have an account? Sign In</p></a>
                    </form>
                </div>
            </div>   
        </div>
    </main>
    <?php include 'footer.php' ?>
</body>
</html>
