<?php
include "config/db.php";
include "includes/header.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = mysqli_real_escape_string($conn, $_POST['password']);

    $q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$pass'");

    if (mysqli_num_rows($q) == 1) {
        $user = mysqli_fetch_assoc($q);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role']    = $user['role'];
        $_SESSION['name']    = $user['name'];

        if ($user['role'] === 'admin') {
            header("Location: Admin/dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<div class="container" style="justify-content: center; display: flex; min-height: 70vh; align-items: center;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <h2 style="color: #333;">Login</h2>
        
        <?php if(isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="post">
            <div style="text-align: left; margin-bottom: 15px;">
                <label>Email</label>
                <input name="email" type="email" placeholder="Enter your email" required
                       style="width:100%; padding:10px; margin-top:5px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="text-align: left; margin-bottom: 20px;">
                <label>Password</label>
                <input name="password" type="password" placeholder="Enter your password" required
                       style="width:100%; padding:10px; margin-top:5px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</div>

<?php include "includes/footer.php"; ?>
