<?php
include "../config/db.php";
include "admin_header.php";

// Fetch summary stats
$total_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders"))['total'];
$total_revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_amount) AS total FROM orders"))['total'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT user_id) AS total FROM orders"))['total'];
?>

<div class="main">
    <h2 class="page-title">Sales Reports</h2>

    <div class="dashboard-cards">
        <div class="card"><span>🧾</span>Total Orders<strong><?= $total_orders ?></strong></div>
        <div class="card"><span>💰</span>Total Revenue<strong>Rs. <?= $total_revenue ?? 0 ?></strong></div>
        <div class="card"><span>👥</span>Unique Users<strong><?= $total_users ?></strong></div>
    </div>

    <p style="margin-top:30px; color:#777;">Note: Product-level reports require an order_items table linking orders and products.</p>
</div>

<style>
    .dashboard-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .card {
        flex: 1 1 200px;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .card span {
        font-size: 28px;
        display: block;
        margin-bottom: 8px;
    }

    .card strong {
        font-size: 24px;
        display: block;
        margin-top: 5px;
        color: #e91e63;
    }

    @media(max-width:768px) {
        .dashboard-cards {
            flex-direction: column;
        }
    }
</style>

<?php include "admin_footer.php"; ?>