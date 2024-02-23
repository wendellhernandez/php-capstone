<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>

        <link rel="shortcut icon" href="/assets/images/organic_shop_favicon.ico" type="image/x-icon">

        <script src="/assets/js/vendor/jquery.min.js"></script>
        <script src="/assets/js/vendor/popper.min.js"></script>
        <script src="/assets/js/vendor/bootstrap.min.js"></script>
        <script src="/assets/js/vendor/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/vendor/bootstrap-select.min.css">

        <link rel="stylesheet" href="/assets/css/custom/admin_global.css">
        <link rel="stylesheet" href="/assets/css/custom/admin_products.css">
        <script src="/assets/js/global/admin_products.js"></script>
    </head>
    <body>
        <div class="wrapper">
    <?php
        $this->load->view('partials/admin_orders_header');
    ?>
            <section>
              
            </section>
            <!-- 
                ADD PRODUCT FORM MODAL
             -->
            <div class="modal fade form_modal" id="add_product_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                        <form class="add_product_form" action="/products/add_product" method="post">
                            <h2>Add a Product</h2>
                            <ul>
                                <li>
                                    <input type="text" name="product_name">
                                    <label>Product Name</label>
						            <div id="add_product_name_error" class="validation_error"></div>
                                </li>
                                <li>
                                    <textarea name="description"></textarea>
                                    <label>Description</label>
						            <div id="add_description_error" class="validation_error"></div>
                                </li>
                                <li>
                                    <label>Category</label>
                                    <select class="selectpicker" name="category">
<?php
    foreach($categories as $category){
?>
                                        <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
<?php
    }
?>
                                    </select>
                                </li>
                                <li>
                                    <input type="text" name="price" value="1">
                                    <label>Price</label>
						            <div id="add_price_error" class="validation_error"></div>
                                </li>
                                <li>
                                    <input type="text" name="inventory" value="1">
                                    <label>Inventory</label>
						            <div id="add_inventory_error" class="validation_error"></div>
                                </li>
                                <li>
                                    <label>Upload Images (5 Max)</label>
                                    <ul>
                                        <li><button type="button" class="upload_image"></button></li>
                                    </ul>
                                    <input type="file" name="image" accept="image/*" class="image_input">
                                </li>
                            </ul>
                            <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 
                EDIT PRODUCT FORM MODAL
             -->
             <div class="modal fade form_modal" id="edit_product_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                        <form class="delete_product_form" action="/products/edit_product" method="post">
                            <h2>Edit Product</h2>
                            <ul>
                                <li>
                                    <input type="text" name="product_name">
                                    <label>Product Name</label>
                                </li>
                                <li>
                                    <textarea name="description"></textarea>
                                    <label>Description</label>
                                </li>
                                <li>
                                    <label>Category</label>
                                    <select class="selectpicker">
                                        <option>Vegetables</option>
                                        <option>Fruits</option>
                                        <option>Pork</option>
                                        <option>Beef</option>
                                        <option>Chicken</option>
                                    </select>
                                </li>
                                <li>
                                    <input type="number" name="price" value="1">
                                    <label>Price</label>
                                </li>
                                <li>
                                    <input type="number" name="inventory" value="1">
                                    <label>Inventory</label>
                                </li>
                                <li>
                                    <label>Upload Images (5 Max)</label>
                                    <ul>
                                        <li><button type="button" class="upload_image"></button></li>
                                    </ul>
                                    <input type="file" name="image" accept="image/*" class="image_input">
                                </li>
                            </ul>
                            <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="popover_overlay"></div>
    </body>
</html>