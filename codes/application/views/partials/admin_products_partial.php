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
                                    <span><?= $total_count ?></span><img src="/assets/images/categories/all_products.png"><h4>All Products</h4>
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
                                    <span><?= $category['product_count'] ?></span><img src="/assets/images/categories/<?= $category['category_image'] ?>"><h4><?= $category['category_name'] ?></h4>
                                </button>
                            </form>
                        </li>
<?php
    }
?>
                        <li>
                            <button type="button" data-toggle="modal" data-target="#add_remove_category_modal">
                                <img src="/assets/images/add_remove_category.png"><h4>Add / Remove Category</h4>
                            </button>
                        </li>
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
    for($i=6*($page-1); $i<6*$page; $i++){
        if(!empty($products[$i])){
            $images = json_decode($products[$i]['product_image_json'] , true);
?>
                            <tr>
                                <td>
                                    <span>
                                        <img src='/assets/images/products/<?= $images['image_1'] ?>'>
                                        <?= $products[$i]['product_name'] ?>
                                    </span>
                                </td>
                                <td><span><?= $products[$i]['product_id'] ?></span></td>
                                <td><span>$ <?= $products[$i]['product_price'] ?></span></td>
                                <td><span><?= $products[$i]['category_name'] ?></span></td>
                                <td><span><?= $products[$i]['inventory'] ?></span></td>
                                <td><span><?= $products[$i]['products_sold'] ?></span></td>
                                <td>
                                    <span>
                                        <form action="/products/update_edit_form/<?= $products[$i]['product_id'] ?>" class="update_edit_form">
                                            <button class="edit_product" data-toggle="modal" data-target="#edit_product_modal">Edit</button>
                                        </form>
                                        <button class="delete_product">X</button>
                                    </span>
                                    <form class="delete_product_form" action="/products/delete_product/<?= $products[$i]['product_id'] ?>" method="post">
                                        <input type="hidden" name="category" value="<?= $current_category ?>">
                                        <input type="hidden" name="page" value="<?= $page ?>">
                                        <input type="hidden" name="search" value="<?= $search ?>">
                                        <p>Are you sure you want to remove this item?</p>
                                        <button type="button" class="cancel_remove">Cancel</button>
                                        <button type="submit">Remove</button>
                                    </form>
                                </td>
                            </tr>
<?php
        }
    }
?>


                        </tbody>
                    </table>
                </div>
                <div class="pagination">
<?php
    for($i=0; $i<count($products)/6; $i++){
?>
                    <form action="/products/admin_products_partial" class="pagination_form" method="post">
                        <input type="hidden" name="page" value="<?= $i+1 ?>">
                        <input type="hidden" name="category" value="<?= $current_category ?>">
                        <input type="hidden" name="search" value="<?= $search ?>">
                        <input type="submit" value="<?= $i+1 ?>">
                    </form>
<?php
    }
?>
                </div>