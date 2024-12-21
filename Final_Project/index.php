<?php
/* This is a PHP file that serves a split-screen landing page. */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="signin" href="week8login.php">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="split left">
        <img src="land_picture.jpg" alt="Left side image" class="image"> <!-- Replace 'your-image.jpg' with your image file name -->
    </div>
    <div class="split right">
        <div class="landee-header">Landee: Secure your Legacy</div> <!-- Added Landee header -->
        <h1>Welcome Back!</h1>
        <p>Sign in to access your land deed records..</p>
        <a href="week8login.php" class="btn">Sign In</a>
    </div>
</body>
</html>
