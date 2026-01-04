<?php
include "../config/db.php";
include "admin_header.php";

// Fetch all products (no JOIN yet)
$result = mysqli_query($conn, "SELECT id, name, price, image, is_best_seller, category_id FROM products ORDER BY id DESC");
?>

<div class="main">
    <h2 class="page-title">Manage Products</h2>

    <a href="add_product.php" class="btn-edit" style="margin-bottom:15px; display:inline-block;">
        Add New Product
    </a>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Category ID</th>
                    <th>Best Seller</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php $rowCount = 0; ?>
                    <?php while($product = mysqli_fetch_assoc($result)): ?>
                        <tr class="<?= ($rowCount % 2 == 0)?'even':'odd'; ?>">
                            <td><?= $product['id']; ?></td>
                            <td><?= htmlspecialchars($product['name']); ?></td>
                            <td>Rs. <?= $product['price']; ?></td>
                            <td><?= $product['category_id']; ?></td>
                            <td><?= ($product['is_best_seller'] ? 'Yes' : 'No'); ?></td>
                            <td>
                                <a href="edit_product.php?id=<?= $product['id']; ?>" class="btn-edit">Edit</a>
                                <a href="delete_product.php?id=<?= $product['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </td>
                        </tr>
                        <?php $rowCount++; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-data">No products found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "admin_footer.php"; ?>
