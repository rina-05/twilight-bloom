<?php

session_start();

// check if user loggedin
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    //redirect to login page in loggediin
    header("Location: login-register.html");
    exit;
}

//show content if logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Twilight-Bloom</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>This is your dashboard. You are logged in.</p>
    </div>
</body>
</html>
