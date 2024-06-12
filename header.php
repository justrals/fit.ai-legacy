<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FIT.AI</title>
    <link rel="icon" href="#">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        <?php include 'css/header.css'; ?>
    </style>
</head>
<body>
<header>
    <div class="container">
        <div class="header-wrapper">
            <a href="index.php"><p class="logo">FIT.AI</p></a>
            <ul class="nav">
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="dropbtn"><?php echo $_SESSION['user']; ?></button>
                            <div class="dropdown-content" id="dropdownMenu">
                                <p><?php echo $_SESSION['user']; ?></p>
                                <a href="dashboard.php">Dashboard</a>
                                <a href="settings.php">Settings</a>
                                <a href="sign-out.php">Log out</a>
                            </div>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item sign-in-button"><a href="sign-in.php"><p>Sign in</p></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>

<script>
    <?php include 'js/dropdown.js'; ?>
</script>
</body>
</html>
