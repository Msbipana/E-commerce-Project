<?php
include "config/db.php";
include "includes/header.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    mysqli_query($conn,
        "INSERT INTO users (name, email, password, role) 
         VALUES ('$name', '$email', '$pass', 'user')"
    );

    echo "<p style='text-align:center; color:green;'>
            Registration successful. <a href='login.php'>Login</a>
          </p>";
}
?>

<section style="padding:40px; text-align:center;">
    <h2>User Registration</h2>

    <form method="post" style="
        max-width: 400px;
        margin: 30px auto;
        padding: 25px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fafafa;
        text-align: left;
    ">
        <label>Full Name</label>
        <input name="name" placeholder="Enter your full name" required
               style="width:100%; padding:10px; margin:8px 0 15px;">

        <label>Email</label>
        <input name="email" type="email" placeholder="Enter your email" required
               style="width:100%; padding:10px; margin:8px 0 15px;">

        <label>Password</label>
        <input name="password" type="password" placeholder="Create a password" required
               style="width:100%; padding:10px; margin:8px 0 20px;">

        <button style="
            width: 100%;
            padding: 12px;
            background: #e91e63;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        ">
            Register
        </button>
    </form>
</section>

<?php include "includes/footer.php"; ?>
