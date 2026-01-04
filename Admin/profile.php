<?php
include "../config/db.php";
include "admin_header.php";

// Fetch admin info
$admin_id = $_SESSION['user_id'];
$admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $admin_id"));

// Handle profile update
if(isset($_POST['update_profile'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $update_sql = "UPDATE users SET name='$name', email='$email' WHERE id=$admin_id";
    if(mysqli_query($conn, $update_sql)){
        $_SESSION['name'] = $name; // update session name
        echo "<p class='success-msg'>Profile updated successfully!</p>";
        $admin['name'] = $name;
        $admin['email'] = $email;
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}

// Handle password change
if(isset($_POST['change_password'])){
    $current_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if($new_pass !== $confirm_pass){
        echo "<p class='error-msg'>New password and confirm password do not match.</p>";
    } else {
        // Fetch current password from DB
        $res = mysqli_query($conn, "SELECT password FROM users WHERE id=$admin_id");
        $row = mysqli_fetch_assoc($res);

        if($row['password'] !== $current_pass){
            echo "<p class='error-msg'>Current password is incorrect.</p>";
        } else {
            mysqli_query($conn, "UPDATE users SET password='$new_pass' WHERE id=$admin_id");
            echo "<p class='success-msg'>Password updated successfully!</p>";
        }
    }
}
?>

<div class="main">
    <h2 class="page-title">My Profile</h2>

    <div class="profile-container">
        <!-- Profile Info Form -->
        <form method="POST" class="profile-form">
            <h3>Update Profile</h3>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($admin['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($admin['email']); ?>" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <input type="text" value="<?= htmlspecialchars($admin['role']); ?>" disabled>
            </div>
            <button type="submit" name="update_profile" class="btn-submit">Update Profile</button>
        </form>

        <!-- Change Password Form -->
        <form method="POST" class="profile-form" style="margin-top:30px;">
            <h3>Change Password</h3>
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit" name="change_password" class="btn-submit">Change Password</button>
        </form>
    </div>
</div>

<style>
.page-title {
    font-size: 28px;
    margin-bottom: 25px;
    color: #333;
}
.profile-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
}
.profile-form {
    background: #fff;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
.profile-form h3 {
    margin-bottom: 20px;
    color: #e91e63;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #555;
}
.form-group input {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 16px;
    transition: border 0.3s, box-shadow 0.3s;
}
.form-group input:focus {
    border-color: #e91e63;
    box-shadow: 0 0 6px rgba(233,30,99,0.2);
    outline: none;
}
.btn-submit {
    background-color: #e91e63;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}
.btn-submit:hover {
    background-color: #c2185b;
    transform: translateY(-2px);
}
.success-msg {
    color: #4caf50;
    margin-bottom: 15px;
    font-weight: 500;
}
.error-msg {
    color: #f44336;
    margin-bottom: 15px;
    font-weight: 500;
}
@media(max-width:768px){
    .profile-container { flex-direction: column; }
}
</style>

<?php include "admin_footer.php"; ?>
