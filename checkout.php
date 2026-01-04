<?php
include "includes/header.php";

// --- Start: Ensure cart is valid array ---
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
} else {
    // Sanitize each item
    foreach ($_SESSION['cart'] as $key => $item) {
        if (!is_array($item) || !isset($item['name'], $item['price'], $item['qty'])) {
            unset($_SESSION['cart'][$key]); // remove invalid entries
        }
    }
}
// Reindex array after removing invalid items
$_SESSION['cart'] = array_values($_SESSION['cart']);
// --- End: Cart validation ---

// Calculate total safely
$total_amount = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_amount += $item['price'] * $item['qty'];
}
$_SESSION['total_amount'] = $total_amount;
?>

<section style="padding:40px; text-align:center;">
    <h2 style="color:#e91e63; margin-bottom:30px;">Checkout</h2>

    <form method="post" style="
        max-width: 500px;
        margin: 0 auto;
        padding: 25px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fafafa;
        text-align: left;
    ">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Enter your full name" required
               style="width:100%; padding:10px; margin:8px 0 15px; border-radius:5px; border:1px solid #ccc;">

        <label>Delivery Address</label>
        <input type="text" name="address" placeholder="Enter your address" required
               style="width:100%; padding:10px; margin:8px 0 15px; border-radius:5px; border:1px solid #ccc;">

        <label>Payment Method</label>
        <select name="payment_method" required
                style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ccc;">
            <option value="">-- Select Payment Method --</option>
            <option value="cod">Cash on Delivery</option>
            <option value="esewa">eSewa</option>
            <option value="khalti">Khalti</option>
        </select>

        <button type="submit" style="
            width:100%;
            padding:12px;
            background:#e91e63;
            color:#fff;
            border:none;
            border-radius:5px;
            cursor:pointer;
            font-size:16px;
        ">Place Order</button>
    </form>

    <!-- <div style="max-width:500px; margin:20px auto; text-align:left;">
        <h3>Order Summary</h3>
        <ul>
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <li><?= htmlspecialchars($item['name']) ?> × <?= $item['qty'] ?> = Rs. <?= $item['price'] * $item['qty'] ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No items in cart.</li>
            <?php endif; ?>
        </ul>
        <p><strong>Total Amount: Rs. <?= $_SESSION['total_amount'] ?></strong></p>
    </div> -->
</section>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "config/db.php";

    $name    = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $payment = $_POST['payment_method'];
    $total_amount = $_SESSION['total_amount'];

    if ($payment == "cod") {
        mysqli_query($conn, "INSERT INTO orders (user_id, total_amount, payment_method, order_date) VALUES ('{$_SESSION['user_id']}','$total_amount','cod',NOW())");
        unset($_SESSION['cart']);
        unset($_SESSION['total_amount']);
        echo "<p style='text-align:center; color:green; margin-top:20px;'>Order placed successfully! (Cash on Delivery)</p>";

    } elseif ($payment == "esewa") {
        $order_id = uniqid('ORDER_');
        $_SESSION['pending_order'] = [
            'order_id' => $order_id,
            'name' => $name,
            'address' => $address,
            'total_amount' => $total_amount
        ];
        ?>
        <form action="https://uat.esewa.com.np/epay/main" method="POST" id="esewaForm" style="display:none;">
            <input value="<?= $total_amount ?>" name="tAmt">
            <input value="<?= $total_amount ?>" name="amt">
            <input value="0" name="txAmt">
            <input value="0" name="psc">
            <input value="0" name="pdc">
            <input value="EPAYTEST" name="scd">
            <input value="<?= $order_id ?>" name="pid">
            <input type="hidden" value="http://localhost/korean_beauty_nepal/esewa_success.php" name="su">
            <input type="hidden" value="http://localhost/korean_beauty_nepal/esewa_fail.php" name="fu">
        </form>
        <script>document.getElementById('esewaForm').submit();</script>
        <?php

    } elseif ($payment == "khalti") {
        header("Location: khalti_payment.php");
        exit;
    }
}
?>

<?php include "includes/footer.php"; ?>
