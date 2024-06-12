<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="submit_product_form">
    <label for="product_name">Product Name:</label>
    <input type="text" name="product_name" id="product_name" required>
    <!-- Add more input fields for other product details -->

    <!-- Example input field for product image upload -->
    <label for="product_image">Product Image:</label>
    <input type="file" name="product_image" id="product_image" accept="image/*">

    <input type="submit" value="Submit">
</form>
