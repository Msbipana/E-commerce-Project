<?php include "includes/header.php"; ?>

<section style="padding:40px; text-align:center;">
    <h2>Contact Us</h2>

    <form style="
        max-width: 450px;
        margin: 30px auto;
        padding: 25px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fafafa;
        text-align: left;
    ">
        <label>Your Name</label>
        <input type="text" placeholder="Your Name" required
               style="width:100%; padding:10px; margin:8px 0 15px;">

        <label>Your Email</label>
        <input type="email" placeholder="Your Email" required
               style="width:100%; padding:10px; margin:8px 0 15px;">

        <label>Message</label>
        <textarea placeholder="Message" required
                  style="width:100%; padding:10px; margin:8px 0 20px; height:120px;"></textarea>

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
            Send Message
        </button>
    </form>
</section>

<?php include "includes/footer.php"; ?>
