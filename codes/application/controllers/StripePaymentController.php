<?php
    class StripePaymentController extends CI_Controller {
        public function handlePayment()
        {
            require_once('application/libraries/stripe-php/init.php');
        
            \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

            $cart_products = $this->Cart->get_cart_products();
            $total_price = $this->Cart->get_cart_total_price();
            $shipping_fee = count($cart_products) * 1.7;
            $total_plus_shipping = $total_price + $shipping_fee;
            $shipping_info = $this->Shipping_information->get_user_shipping_info();
            $shipping_info_concat = "{$shipping_info['first_name']} {$shipping_info['last_name']} - {$shipping_info['address_1']}, {$shipping_info['city']}, {$shipping_info['state']}, {$shipping_info['zip']}";
        
            \Stripe\Charge::create ([
                    'amount' => 100 * $total_plus_shipping,
                    'currency' => 'usd',
                    'source' => $this->input->post('stripeToken'),
                    'description' => $shipping_info_concat
            ]);
                
            $this->session->set_flashdata('success', 'Payment has been successful.');

            $this->Order->set_orders();

            $this->Product->set_product_sold();

            $this->Cart->delete_user_cart();
                
            redirect('/carts');
        }
    }