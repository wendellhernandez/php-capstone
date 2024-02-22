                <form action="/products/admin_products_partial" method="post" class="search_form">
                    <input type="hidden" name="category" value="<?= $current_category ?>">
                    <input type="text" name="search" placeholder="Search Products" value="<?= $search ?>">
                </form>
                <button class="add_product" data-toggle="modal" data-target="#add_product_modal">Add Product</button>
                <form action="process.php" method="post" class="status_form">
                    <h3>Categories</h3>
                    <ul>
                        <form></form>
                        <li>
                            <form action="/products/admin_products_partial" method="post" class="category_form">
                                <input type="hidden" name="category" value="">
                                <input type="hidden" name="search" value="<?= $search ?>">
                                <button type="submit">
                                    <span><?= $total_count ?></span><img src="/assets/images/apple.png"><h4>All Products</h4>
                                </button>
                            </form>
                        </li>
<?php
    foreach($categories as $category){
?>
                    <li>
                        <form action="/products/admin_products_partial" method="post" class="category_form">
                            <input type="hidden" name="category" value="<?= $category['category_name'] ?>">
                            <input type="hidden" name="search" value="<?= $search ?>">
                            <button type="submit">
                                <span><?= $category['product_count'] ?></span><img src="/assets/images/apple.png"><h4><?= $category['category_name'] ?></h4>
                            </button>
                        </form>
                    </li>
<?php
    }
?>
                    </ul>
                </form>
                <div>
                    <table class="products_table">
                        <thead>
                            <tr>
                                <th><h3><?= !empty($current_category) ? $current_category : 'All Products' ?>(<?= count($products) ?>)</h3></th>
                                <th>ID #</th>
                                <th>Price</th>
                                <th>Caregory</th>
                                <th>Inventory</th>
                                <th>Sold</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    foreach($products as $product){
?>
                            <tr>
                                <td>
                                    <span>
                                        <img src="/assets/images/food.png" alt="#">
                                        <?= $product['product_name'] ?>
                                    </span>
                                </td>
                                <td><span><?= $product['product_id'] ?></span></td>
                                <td><span>$ <?= $product['product_price'] ?></span></td>
                                <td><span><?= $product['category_name'] ?></span></td>
                                <td><span><?= $product['inventory'] ?></span></td>
                                <td><span><?= $product['products_sold'] ?></span></td>
                                <td>
                                    <span>
                                        <button class="edit_product" data-toggle="modal" data-target="#edit_product_modal">Edit</button>
                                        <button class="delete_product">X</button>
                                    </span>
                                    <form class="delete_product_form" action="process.php" method="post">
                                        <p>Are you sure you want to remove this item?</p>
                                        <button type="button" class="cancel_remove">Cancel</button>
                                        <button type="submit">Remove</button>
                                    </form>
                                </td>
                            </tr>
<?php
    }
?>
                        </tbody>
                    </table>
                </div>