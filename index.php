<?php 
include "config/db.php"; // Database connection
include "includes/header.php"; 
?>

<!-- HERO SECTION -->
<section style="padding:60px 20px; text-align:center; background:#f9f4f8;">
    <h1 style="font-size:36px; color:#222;">Korean Beauty Nepal</h1>
    <p style="font-size:18px; max-width:700px; margin:15px auto; color:#555;">
        Your trusted destination for 100% authentic Korean skincare & beauty products in Nepal.
    </p>
    <a href="shop.php" 
       style="display:inline-block; margin-top:20px; padding:12px 25px; background:#e91e63; color:#fff; text-decoration:none; border-radius:5px;">
        Shop Now
    </a>
</section>

<!-- BEST SELLING PRODUCTS -->
<section style="padding:50px 20px; background:#fff;">
    <h2 style="text-align:center; margin-bottom:30px;">Best Selling Products ✨</h2>

    <div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap;">
        <?php
        $bestSelling = mysqli_query($conn, "SELECT * FROM products WHERE is_best_seller = 1");
        if(mysqli_num_rows($bestSelling) > 0) {
            while($product = mysqli_fetch_assoc($bestSelling)) {
                $imgPath = !empty($product['image']) ? "" . $product['image'] : "default.png";
                echo '<div style="width:220px; background:#fff; padding:15px; border-radius:8px; text-align:center; box-shadow:0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s;">
                        <img src="'. $imgPath .'" alt="'.htmlspecialchars($product['name']).'" style="width:100%; height:180px; object-fit:cover; border-radius:6px;">
                        <h4 style="margin:10px 0 5px;">'. htmlspecialchars($product['name']) .'</h4>
                        <p style="color:#e91e63; font-weight:bold;">Rs. '. htmlspecialchars($product['price']) .'</p>
                        <a href="products.php" 
                           style="display:inline-block; margin-top:10px; padding:8px 15px; background:#e91e63; color:#fff; text-decoration:none; border-radius:4px;">Buy Now</a>
                    </div>';
            }
        } else {
            echo "<p>No best-selling products found.</p>";
        }
        ?>
    </div>
</section>

<!-- WHY CHOOSE US -->
<section style="padding:50px 20px; background:#f9f9f9;">
    <h2 style="text-align:center; margin-bottom:30px;">Why Choose Korean Beauty Nepal?</h2>

    <div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap;">
        <div style="width:250px; padding:20px; border:1px solid #eee; border-radius:8px; text-align:center;">
            <h3>🇰🇷 Authentic Products</h3>
            <p>We sell only genuine Korean skincare products directly sourced from trusted brands.</p>
        </div>

        <div style="width:250px; padding:20px; border:1px solid #eee; border-radius:8px; text-align:center;">
            <h3>🚚 Fast Delivery</h3>
            <p>Quick and reliable delivery service across Nepal.</p>
        </div>

        <div style="width:250px; padding:20px; border:1px solid #eee; border-radius:8px; text-align:center;">
            <h3>💯 Quality Guaranteed</h3>
            <p>Safe, effective, and dermatologist-tested beauty solutions.</p>
        </div>
    </div>
</section>

<!-- POPULAR CATEGORIES -->
<section style="padding:50px 20px; background:#fff;">
    <h2 style="text-align:center; margin-bottom:30px;">Popular Categories</h2>

    <div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap;">
        <div style="width:220px; background:#fff; padding:15px; border-radius:8px; text-align:center; box-shadow:0 2px 5px rgba(0,0,0,0.05);">
            <h4>Cleansers</h4>
            <p>Gentle & deep cleansing products.</p>
        </div>

        <div style="width:220px; background:#fff; padding:15px; border-radius:8px; text-align:center; box-shadow:0 2px 5px rgba(0,0,0,0.05);">
            <h4>Serums & Essences</h4>
            <p>Hydration, glow & skin repair.</p>
        </div>

        <div style="width:220px; background:#fff; padding:15px; border-radius:8px; text-align:center; box-shadow:0 2px 5px rgba(0,0,0,0.05);">
            <h4>Face Masks</h4>
            <p>Instant glow & nourishment.</p>
        </div>

        <div style="width:220px; background:#fff; padding:15px; border-radius:8px; text-align:center; box-shadow:0 2px 5px rgba(0,0,0,0.05);">
            <h4>Sunscreen</h4>
            <p>Daily protection for healthy skin.</p>
        </div>
    </div>
</section>

<!-- ABOUT US -->
<section style="padding:50px 20px; background:#f9f4f8;">
    <h2 style="text-align:center;">About Us</h2>
    <p style="max-width:800px; margin:15px auto; text-align:center; color:#555;">
        Korean Beauty Nepal is dedicated to bringing the best of Korean skincare to beauty lovers in Nepal.
        Our mission is to provide safe, effective, and affordable products for every skin type.
    </p>
</section>

<!-- CALL TO ACTION -->
<section style="padding:40px 20px; text-align:center; background:#e91e63; color:#fff;">
    <h2>Start Your Skincare Journey Today ✨</h2>
    <p>Explore our wide range of Korean beauty products.</p>
    <a href="register.php"
       style="display:inline-block; margin-top:15px; padding:10px 22px; background:#fff; color:#e91e63; text-decoration:none; border-radius:5px;">
        Create an Account
    </a>
</section>

<?php include "includes/footer.php"; ?>
