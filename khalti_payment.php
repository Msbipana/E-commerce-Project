<?php
$total_amount = 1000; // in paisa
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
</head>
<body>

<script>
    var config = {
        publicKey: "test_public_key_xxxxx",
        productIdentity: "order_123",
        productName: "Korean Beauty Nepal Order",
        productUrl: "http://localhost/korean_beauty_nepal",
        paymentPreference: ["KHALTI"],

        eventHandler: {
            onSuccess(payload) {
                window.location.href = "payment_success.php";
            },
            onError(error) {
                window.location.href = "payment_failed.php";
            },
            onClose() {
                window.location.href = "checkout.php";
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    checkout.show({amount: <?= $total_amount * 100 ?>});
</script>

</body>
</html>
