<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FIT.AI - Sign In</title>
    <link rel="icon" href="#">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    session_start();
    require_once 'users.php';

    if (isset($_SESSION['user'])) {
        header('Location: dashboard.php');
        exit();
    } elseif (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
        header('Location: dashboard.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        if (isset($_POST['user']) && isset($_POST['password'])) {
            $username = $_POST['user'];
            $password = $_POST['password'];

            if (array_key_exists($username, $users) && $users[$username]['password'] === $password) {
                $_SESSION['user'] = $username;

                if (isset($_POST['remember'])) {
                    setcookie('user', $username, time() + (86400 * 30), "/");
                }

                header('Location: dashboard.php');
                exit();
            } else {
                $failed = true;
            }
        }
    }
    ?>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <div class="hero">
                <h1 class="full">Log In</h1>
                <div class="form-wrapper">
                    <?php if (isset($failed)) { echo "<div>Invalid username/password</div>"; } ?>
                    <form action="" method="post" class="form">
                        <input type="text" placeholder="Username" name="user" required maxlength="20" class="username">
                        <input type="password" placeholder="Password" name="password" required maxlength="30" class="password" id="passwordInput">
                        <div class="button-container">
                            <button type="submit" name="login" class="button button--light button--half">Login</button>
                            <a href="sign-up.php" class="button button--dark button--half"><p>Create Account</p></a>
                        </div>
                    </form>
                </div>  
            </div>  
        </div>  
    </main>
    <?php include 'footer.php' ?>
</body>
</html>
