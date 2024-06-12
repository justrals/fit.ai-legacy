<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>FIT.AI</title>
        <link rel="icon" href="#">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <main>
            <div class="hero">
                <div class="container">
                    <h1>FIT.AI</h1>
                    <p class="hero-description text-center">Create your own fitness plan using AI</p>
                    <div class="mx-center">
                        <a href="dashboard.php" class="get-started-button mx-auto"><p>Get Started</p></a>
                    </div>
                </div>
            </div>    
        </main>
        <?php include 'footer.php' ?>
    </body>
</html>