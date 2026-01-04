<?php
include "../config/db.php";
include "admin_header.php";

// Dashboard stats
$productCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM products"))['total'];
$orderCount   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders"))['total'];
$userCount    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$revenue      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_amount) AS total FROM orders"))['total'];
?>

<div class="main">
    <h1>Welcome, Admin <?= htmlspecialchars($_SESSION['name']); ?></h1>

    <div class="dashboard-cards">
        <div class="card"><span>📦</span>Products<strong><?= $productCount ?></strong></div>
        <div class="card"><span>🧾</span>Orders<strong><?= $orderCount ?></strong></div>
        <div class="card"><span>👥</span>Users<strong><?= $userCount ?></strong></div>
        <div class="card"><span>💰</span>Revenue<strong>Rs. <?= $revenue ?? 0 ?></strong></div>
    </div>
</div>

<?php include "admin_footer.php"; ?>