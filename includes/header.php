<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Korean Beauty Nepal</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <h1>Korean Beauty Nepal</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="shop.php">Shop</a>
    <a href="cart.php">Cart</a>

<?php if(isset($_SESSION['user'])): ?>
    <span style="color:white;">Welcome, <?= $_SESSION['user']['name'] ?></span>
    <a href="logout.php">Logout</a>
<?php else: ?>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
<?php endif; ?>

    <a href="about.php">About</a>
    <a href="contact.php">Contact</a>
</nav>
