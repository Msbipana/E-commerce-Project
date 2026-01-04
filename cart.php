<?php
include "config/db.php";
include "includes/header.php"; 
?>

<section style="padding:40px; text-align:center;">
    <h2>Your Cart</h2>

    <div style="
        max-width: 500px;
        margin: 30px auto;
        padding: 25px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fafafa;
        text-align: left;
    ">
        <?php
        if (empty($_SESSION['cart'])) {
            echo "<p style='text-align:center;'>Your cart is empty.</p>";
        } else {
            $total = 0;

            foreach ($_SESSION['cart'] as $id) {
                $q = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
                $p = mysqli_fetch_assoc($q);

                $total += $p['price'];

                echo "
                <div style='
                    display:flex;
                    justify-content:space-between;
                    padding:8px 0;
                    border-bottom:1px solid #ddd;
                '>
                    <span>{$p['name']}</span>
                    <strong>Rs. {$p['price']}</strong>
                </div>
                ";
            }

            echo "
                <div style='margin-top:15px; font-weight:bold; text-align:right;'>
                    Total: Rs. $total
                </div>

                <a href='checkout.php'>
                    <button style='
                        width:100%;
                        margin-top:20px;
                        padding:12px;
                        background:#e91e63;
                        color:#fff;
                        border:none;
                        border-radius:5px;
                        cursor:pointer;
                        font-size:16px;
                    '>
                        Proceed to Checkout
                    </button>
                </a>
            ";
        }
        ?>
    </div>
</section>

<?php include "includes/footer.php"; ?>
