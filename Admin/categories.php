<?php
include "../config/db.php";
include "admin_header.php";

// Handle delete
if(isset($_GET['delete_id'])){
    $delete_id = (int)$_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM categories WHERE id = $delete_id");
    header("Location: manage_categories.php");
    exit;
}

// Handle add
if(isset($_POST['add_category'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    mysqli_query($conn, "INSERT INTO categories (name) VALUES ('$name')");
}

// Handle edit
if(isset($_POST['edit_category'])){
    $id = (int)$_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    mysqli_query($conn, "UPDATE categories SET name='$name' WHERE id=$id");
}

// Fetch all categories
$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
?>

<div class="main">
    <h2 class="page-title">Manage Categories</h2>

    <!-- Add Category Form -->
    <form method="POST" class="category-form">
        <input type="text" name="name" placeholder="New category name" required>
        <button type="submit" name="add_category" class="btn-submit">Add Category</button>
    </form>

    <!-- Categories Table -->
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($category = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $category['id']; ?></td>
                            <td><?= htmlspecialchars($category['name']); ?></td>
                            <td>
                                <!-- Edit using modal form -->
                                <button onclick="showEditModal(<?= $category['id']; ?>,'<?= htmlspecialchars($category['name']); ?>')" class="btn-edit">Edit</button>
                                <a href="?delete_id=<?= $category['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="no-data">No categories found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3>Edit Category</h3>
        <form method="POST">
            <input type="hidden" name="id" id="edit_id">
            <input type="text" name="name" id="edit_name" required>
            <button type="submit" name="edit_category" class="btn-submit">Update</button>
        </form>
    </div>
</div>

<style>
/* Table & form styling */
.category-form {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
    max-width: 400px;
}
.category-form input[type="text"] {
    flex: 1;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
}
.category-form .btn-submit {
    background-color: #e91e63;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s;
}
.category-form .btn-submit:hover {
    background-color: #c2185b;
}

/* Modal styling */
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    justify-content: center; align-items: center;
}
.modal-content {
    background: #fff;
    padding: 25px 20px;
    border-radius: 12px;
    max-width: 400px;
    position: relative;
}
.close-btn {
    position: absolute;
    top: 10px; right: 15px;
    font-size: 22px;
    cursor: pointer;
}
.modal-content input[type="text"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #ddd;
}
.modal-content .btn-submit {
    width: 100%;
}

/* Responsive */
@media(max-width:768px){
    .category-form { flex-direction: column; }
}
</style>

<script>
function showEditModal(id, name){
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('editModal').style.display = 'flex';
}
function closeModal(){
    document.getElementById('editModal').style.display = 'none';
}
</script>

<?php include "admin_footer.php"; ?>
