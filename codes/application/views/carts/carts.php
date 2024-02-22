<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>

        <link rel="shortcut icon" href="/assets/images/organic_shop_fav.ico" type="image/x-icon">

        <script src="/assets/js/vendor/jquery.min.js"></script>
        <script src="/assets/js/vendor/popper.min.js"></script>
        <script src="/assets/js/vendor/bootstrap.min.js"></script>
        <script src="/assets/js/vendor/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/vendor/bootstrap-select.min.css">
        <script src="https://js.stripe.com/v2/"></script>

        <link rel="stylesheet" href="/assets/css/custom/global.css">
        <link rel="stylesheet" href="/assets/css/custom/cart.css">
        <script src="/assets/js/global/cart.js"></script>
        <script src="/assets/js/global/checkout.js"></script>
    </head>
    <body>
        <div class="wrapper">
<?php
    $this->load->view('partials/header');
?>
            <section >
                <form action="/products" method="post" class="search_form">
                    <input type="text" name="search" placeholder="Search Products">
                </form>
                <a class="show_cart" href="/carts">Cart (<?= count($cart_products) ?>)</a>
                <section>
                    <form class="cart_items_form">
                    </form>
                    <form class="checkout_form" action="/shipping_informations/add_shipping_info" method="post">
<?php
    if($this->session->flashdata('success')){
?>
                        <div class="alert alert-success text-center">
                            <p><?= $this->session->flashdata('success') ?></p>
                        </div>
<?php
    }
?>
                        <h3>
                            Shipping Information
                            <input type="checkbox" id="same_billing_checkbox">
                            <label for="same_billing_checkbox">Same with billing</label>
                        </h3>
                        <ul>
                            <li>
                                <input type="text" name="first_name" value="<?= $shipping_information['first_name'] ?>">
                                <label>First Name</label>
						        <div id="first_name" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="last_name" value="<?= $shipping_information['last_name'] ?>">
                                <label>Last Name</label>
						        <div id="last_name" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="address_1" value="<?= $shipping_information['address_1'] ?>">
                                <label>Address 1</label>
						        <div id="address_1" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="address_2" value="<?= $shipping_information['address_2'] ?>">
                                <label>Address 2</label>
						        <div id=""address_2" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="city" value="<?= $shipping_information['city'] ?>">
                                <label>City</label>
						        <div id="city" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="state" value="<?= $shipping_information['state'] ?>">
                                <label>State</label>
						        <div id="state" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="zip" value="<?= $shipping_information['zip'] ?>">
                                <label>Zip Code</label>
						        <div id="zip" class="validation_error"></div>
                            </li>
                        </ul>
                        <h3 class="billing_title">Billing Information</h3>
                        <ul>
                            <li>
                                <input type="text" name="first_name_billing">
                                <label>First Name</label>
						        <div id="first_name_billing" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="last_name_billing">
                                <label>Last Name</label>
						        <div id="last_name_billing" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="address_1_billing">
                                <label>Address 1</label>
						        <div id="address_1_billing" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="address_2_billing">
                                <label>Address 2</label>
						        <div id=""address_2_billing" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="city_billing">
                                <label>City</label>
						        <div id="city_billing" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="state_billing">
                                <label>State</label>
						        <div id="state_billing" class="validation_error"></div>
                            </li>
                            <li>
                                <input type="text" name="zip_billing">
                                <label>Zip Code</label>
						        <div id="zip_billing" class="validation_error"></div>
                            </li>
                        </ul>
                        <h3>Order Summary</h3>
                        <h4>Items <span class="total_cart_amount"></span></h4>
                        <h4>Shipping Fee <span class="shipping_fee"></span></h4>
                        <h4 class="total_amount">Total Amount <span class="total_plus_shipping"></span></h4>
<?php
    if(!empty($total_plus_shipping)){
?>
                        <button type="submit" class="checkout_form_button">Proceed to Checkout</button>
<?php
    }
?>
                        
                    </form>
                </section>
            </section>
            
            <div class="form_modal" id="card_details_modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                        <form role="form" action="/handleStripePayment" method="post"
                        class="pay_form" data-cc-on-file="false"
                        data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>">
                            <h2>Card Details</h2>
                            <ul>
                                <li>
                                    <input type="text" name="card_name" placeholder="Test" value="Test">
                                    <label>Card Name</label>
                                </li>
                                <li>
                                    <input type="text" name="card_number" class="card-number" placeholder="4242 4242 4242 4242" value="4242 4242 4242 4242">
                                    <label>Card Number</label>
                                </li>
                                <li>
                                    <input type="text" name="card_expiry_month" class="card-expiry-month" placeholder="12" value="12">
                                    <label>Exp Month</label>
                                </li>
                                <li>
                                    <input type="text" name="card_expiry_year" class="card-expiry-year" placeholder="2025" value="2025">
                                    <label>Exp Year</label>
                                </li>
                                <li>
                                    <input type="text" name="cvc" class="card-cvc" placeholder="456" value="456">
                                    <label>CVC</label>
                                </li>
                            </ul>
                            <h3>Total Amount <span class="total_plus_shipping"></span></h3>
                            <div class='error hide'>Error occured while making the payment.</div>
                            
                            <button type="sumbit">Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="popover_overlay"></div>
    </body>
</html>