                        <ul>
                            <form></form>
<?php
    foreach($cart_products as $cart_product){
        $images = json_decode($cart_product['product_image_json'] , true);
?>
                            <li>
                                <img src="/assets/images/products/<?= $images['image_1'] ?>">
                                <h3><?= $cart_product['name'] ?></h3>
                                <span>$ <?= $cart_product['price'] ?></span>
                                <ul>
                                    <li>
                                        <form action="/carts/edit_cart/<?= $cart_product['id'] ?>" method="post" class="quantity_form">
                                            <label>Quantity</label>
                                            <input type="text" min-value="1" value="<?= $cart_product['carts_quantity'] ?>" name="quantity">
                                            <ul>
                                                <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="1"></button></li>
                                                <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="0"></button></li>
                                            </ul>
                                        </form>
                                    </li>
                                    <li>
                                        <label>Total Amount</label>
                                        <span class="total_amount">$ <?= $cart_product['product_total'] ?></span>
                                    </li>
                                    <li>
                                        <button type="button" class="remove_item"></button>
                                    </li>
                                </ul>
                                <div>
                                    <form action="/carts/delete_cart/<?= $cart_product['id'] ?>" method="post" class="remove_form">
                                        <p>Are you sure you want to remove this item?</p>
                                        <button type="button" class="cancel_remove">Cancel</button>
                                        <button type="submit" class="remove">Remove</button>
                                    </form>
                                </div>
                            </li>
<?php
    }
?>
                        </ul>   