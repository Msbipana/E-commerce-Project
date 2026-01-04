<?php
include "../config/db.php";
include "admin_header.php";

$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<div class="main">
    <h2 class="page-title">Manage Users</h2>
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php $rowCount = 0; ?>
                    <?php while($user = mysqli_fetch_assoc($result)): ?>
                        <tr class="<?= ($rowCount % 2 == 0)?'even':'odd'; ?>">
                            <td><?= $user['id']; ?></td>
                            <td><?= htmlspecialchars($user['name']); ?></td>
                            <td><?= htmlspecialchars($user['email']); ?></td>
                            <td><?= htmlspecialchars($user['role']); ?></td>
                            <td>
                                <a href="edituser.php?id=<?= $user['id']; ?>" class="btn-edit">Edit</a>
                                <a href="deleteuser.php?id=<?= $user['id']; ?>" class="btn-delete" onclick="return confirm('Delete this user?')">Delete</a>
                            </td>
                        </tr>
                        <?php $rowCount++; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="no-data">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "admin_footer.php"; ?>
