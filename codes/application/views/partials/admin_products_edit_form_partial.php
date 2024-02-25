                <div class="modal-dialog">
                    <div class="modal-content">
                        <button data-dismiss="modal" aria-label="Close" class="close_modal edit_close_modal"></button>
                        <form class="edit_product_form" action="/products/edit_product/<?= $product['product_id'] ?>" method="post" enctype="multipart/form-data">
                            <h2>Edit Product</h2>
                            <ul>
                                <li>
                                    <input type="text" name="product_name" value="<?= $product['product_name'] ?>">
                                    <label>Product Name</label>
						            <div id="edit_product_name_error" class="validation_error"></div>
                                </li>
                                <li>
                                    <textarea name="description"><?= $product['description'] ?></textarea>
                                    <label>Description</label>
						            <div id="edit_description_error" class="validation_error"></div>
                                </li>
                                <li>
                                    <label>Category</label>
                                    <select class="edit_select_picker" name="category">
<?php
    foreach($categories_table as $category){
?>
                                        <option value="<?= $category['id'] ?>" <?= ($product['category_id'] == $category['id']) ? 'selected' : '' ?>><?= $category['name'] ?></option>
<?php
    }
?>
                                    </select>
                                </li>
                                <li>
                                    <input type="text" name="price" value="<?= $product['price'] ?>">
                                    <label>Price</label>
						            <div id="edit_price_error" class="validation_error"></div>
                                </li>
                                <li>
                                    <input type="text" name="inventory" value="<?= $product['stocks'] ?>">
                                    <label>Inventory</label>
						            <div id="edit_inventory_error" class="validation_error"></div>
                                </li>
                                <li>
                                    <label>Upload Images (4 Max)</label>
                                    <ul>
                                        <li>
                                            <button type="button" class="upload_image edit_image_button"></button>
                                        </li>
                                    </ul>
                                    <ul class="edit_preview_image_container">

                                    </ul>
                                    <input type="file" id="edit_image_input" name="add_image[]" multiple="multiple">
                                </li>
                            </ul>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="edit_cancel_modal">Cancel</button>
                            <button type="submit" class="edit_product_form_submit">Save</button>
                        </form>
                    </div>
                </div>