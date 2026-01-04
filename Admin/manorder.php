<?php
include "../config/db.php";
include "admin_header.php";

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
?>

<div class="main">
    <h2 class="page-title">Manage Orders</h2>
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php $rowCount = 0; ?>
                    <?php while ($order = mysqli_fetch_assoc($result)): ?>
                        <tr class="<?= ($rowCount % 2 == 0) ? 'even' : 'odd'; ?>">
                            <td><?= $order['id']; ?></td>
                            <td><?= $order['user_id']; ?></td>
                            <td>Rs. <?= $order['total_amount']; ?></td>
                            <td><?= htmlspecialchars($order['payment_method']); ?></td>
                            <td><?= $order['order_date']; ?></td>
                            <td>
                                <a href="update_order.php?id=<?= $order['id']; ?>&status=Completed" class="btn-edit">Mark Completed</a>
                            </td>
                        </tr>
                        <?php $rowCount++; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-data">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "admin_footer.php"; ?>