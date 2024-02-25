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
                        <form class="add_product_form" action="/products/add_product" method="post" enctype="multipart/form-data">
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
    foreach($categories_table as $category){
?>
                                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
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
                                    <label>Upload Images (4 Max)</label>
                                    <ul>
                                        <li>
                                            <button type="button" class="upload_image add_image_button"></button>
                                        </li>
                                    </ul>
                                    <ul class="add_preview_image_container">

                                    </ul>
                                    <input type="file" id="add_image_input" name="add_image[]" multiple="multiple">
                                </li>
                            </ul>
                            <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="add_product_form_submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 
                EDIT PRODUCT FORM MODAL
             -->
            <div class="modal fade form_modal" id="edit_product_modal" tabindex="-1" aria-hidden="true">
                
            </div>

            <!-- 
                ADD / REMOVE CATEGORY FORM MODAL
             -->
             <div class="modal fade form_modal" id="add_remove_category_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                        <form class="add_remove_category_form" action="/products/add_category" method="post" enctype="multipart/form-data">
                            <h2>Add / Remove Category</h2>
                            <ul>
                                <li>
                                    <input type="text" name="category_name">
                                    <label>Category Name</label>
                                </li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li>
                                    <label>Upload Image</label>
                                    <ul>
                                        <li>
                                            <button type="button" class="upload_image add_category_button"></button>
                                        </li>
                                    </ul>
                                    <ul class="category_preview_image_container">

                                    </ul>
                                    <input type="file" id="add_category_input" name="add_category_image">
                                <label>Remove Category</label>
                                </li>
<?php
    foreach($categories_table as $category){
?>
                                <li class="category_modal_image_container">
                                    <label><?= $category['name'] ?></label>
                                    <img src="/assets/images/categories/<?= $category['image_link'] ?>" class="category_modal_image">
                                    <a href="/products/delete_category/<?= $category['id'] ?>" class="delete_image"></a>
                                </li>
<?php
    }
?>
                            </ul>
                            <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="add_product_form_submit">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="popover_overlay"></div>
    </body>
</html>