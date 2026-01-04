<?php
include "config/db.php";
include "includes/header.php";
?>

<div class="container">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM products");

    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="card">
           <img
    src="http://localhost/korean_beauty_nepal/<?= htmlspecialchars($row['image']) ?>"
    width="150"
    alt="<?= htmlspecialchars($row['name']) ?>">


            <h3><?= $row['name'] ?></h3>
            <p>Rs. <?= $row['price'] ?></p>
            <a href="add_to_cart.php?id=<?= $row['id'] ?>">
                <button>Add to Cart</button>
            </a>
        </div>
    <?php } ?>
</div>

<?php include "includes/footer.php"; ?>