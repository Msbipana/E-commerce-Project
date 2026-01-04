<?php
include "../config/db.php";
include "admin_header.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $is_best_seller = isset($_POST['is_best_seller']) ? 1 : 0;

    // Handle image upload
    $image_path = "";
    if(isset($_FILES['image']) && $_FILES['image']['name'] !== "") {
        $target_dir = "../uploads/products/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image_name = time() . "_" . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = "uploads/products/" . $image_name;
        } else {
            echo "<p class='error-msg'>Failed to upload image.</p>";
        }
    }

    // Insert product into DB
    $sql = "INSERT INTO products (name, price, image, is_best_seller, category_id) 
            VALUES ('$name', '$price', '$image_path', '$is_best_seller', '$category_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<p class='success-msg'>Product added successfully!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<div class="main">
    <h2 class="page-title">Add New Product</h2>

    <form action="" method="POST" enctype="multipart/form-data" class="product-form">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" required placeholder="Enter product name">
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" required placeholder="Enter price">
        </div>

        <div class="form-group">
            <label for="category_id">Category ID</label>
            <input type="number" name="category_id" id="category_id" required placeholder="Enter category ID">
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        <div class="form-group checkbox-group">
            <label>
                <input type="checkbox" name="is_best_seller"> Is Best Seller
            </label>
        </div>

        <button type="submit" class="btn-submit">Add Product</button>
    </form>
</div>

<style>
/* Form card styling */
.product-form {
    max-width: 600px;
    background: #fff;
    padding: 30px 25px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-form:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.page-title {
    font-size: 30px;
    margin-bottom: 25px;
    color: #333;
}

/* Form groups */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 500;
    margin-bottom: 8px;
    color: #555;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group input[type="file"] {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    transition: border 0.3s, box-shadow 0.3s;
}

.form-group input[type="text"]:focus,
.form-group input[type="number"]:focus,
.form-group input[type="file"]:focus {
    border-color: #e91e63;
    box-shadow: 0 0 6px rgba(233,30,99,0.2);
    outline: none;
}

/* Checkbox styling */
.checkbox-group label {
    font-weight: 500;
    color: #555;
}

.checkbox-group input[type="checkbox"] {
    margin-right: 8px;
    width: 18px;
    height: 18px;
}

/* Submit button */
.btn-submit {
    background-color: #e91e63;
    color: #fff;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

.btn-submit:hover {
    background-color: #c2185b;
    transform: translateY(-2px);
}

/* Success & error messages */
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

/* Responsive */
@media(max-width:768px) {
    .product-form {
        padding: 20px 15px;
    }
}
</style>

<?php include "admin_footer.php"; ?>
