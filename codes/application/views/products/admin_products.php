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
                                    <input type="text" name="product_name" value="pork">
                                    <label>Product Name</label>
						            <div id="add_product_name_error" class="validation_error"></div>
                                </li>
                                <li>
                                    <textarea name="description">So Clean. So good. So</textarea>
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
                                    <label>Upload Images (5 Max)</label>
                                    <ul>
                                        <li>
                                            <img src="/assets/images/blank.png" class="add_preview_image_1">
                                        </li>
                                        <li>
                                            <img src="/assets/images/blank.png" class="add_preview_image_2">
                                        </li>
                                        <li>
                                            <img src="/assets/images/blank.png" class="add_preview_image_3">
                                        </li>
                                        <li>
                                            <img src="/assets/images/blank.png" class="add_preview_image_4">
                                        </li>
                                        <li>
                                            <img src="/assets/images/blank.png" class="add_preview_image_5">
                                        </li>
                                    </ul>
                                    <input type="file" name="image_1" class="add_image_1">
                                    <input type="file" name="image_2" class="add_image_2">
                                    <input type="file" name="image_3" class="add_image_3">
                                    <input type="file" name="image_4" class="add_image_4">
                                    <input type="file" name="image_5" class="add_image_5">
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
            
        </div>
        <div class="popover_overlay"></div>
    </body>
</html>