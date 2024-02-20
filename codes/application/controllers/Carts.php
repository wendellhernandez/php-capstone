<?php
    class Carts extends CI_Controller{
        public function index(){
            if(!$this->is_logged_in()){
                redirect('/login');
            }

            if(!empty($this->Shipping_information->get_user_shipping_info())){
                $shipping_information = $this->Shipping_information->get_user_shipping_info();
            }else{
                $shipping_information = array(
                    'first_name' => '',
                    'last_name' => '',
                    'address_1' => '',
                    'address_2' => '',
                    'city' => '',
                    'state' => '',
                    'zip' => ''
                );
            }

            $total_price = $this->Cart->get_cart_total_price();
            $shipping_fee = count($this->Cart->get_cart_products()) * 1.7;
            $total_plus_shipping = $total_price + $shipping_fee;

            $data = array(
				'is_logged_in' => $this->is_logged_in(),
                'first_name' => $this->session->userdata('first_name'),
                'cart_products' => $this->Cart->get_cart_products(),
                'shipping_information' => $shipping_information,
                'total_plus_shipping' => $total_plus_shipping
			);

            $this->load->view('carts/carts' , $data);
        }

        public function add_to_cart($product_id){
            $this->Cart->set_to_cart($product_id);

            $data = array(
                'cart_products' => $this->Cart->get_cart_products()
			);

            $this->load->view('partials/add_to_cart_partial' , $data);
        }

        public function edit_cart($product_id){
            $this->Cart->update_cart($product_id);

            $data = array(
                'cart_products' => $this->Cart->get_cart_products()
			);

            $this->load->view('partials/edit_cart_partial' , $data);
        }

        public function edit_cart_partial(){
            $data = array(
                'cart_products' => $this->Cart->get_cart_products()
			);

            $this->load->view('partials/edit_cart_partial' , $data);
        }

        public function delete_cart($product_id){
            $this->Cart->remove_cart($product_id);

            $data = array(
                'cart_products' => $this->Cart->get_cart_products()
			);

            $this->load->view('partials/edit_cart_partial' , $data);
        }

        public function add_to_cart_partial(){
            $data = array(
                'cart_products' => $this->Cart->get_cart_products()
			);

            $this->load->view('partials/add_to_cart_partial' , $data);
        }

        public function is_logged_in(){
			if(empty($this->session->userdata('user_id'))){
				return false;
			}else{
				return true;
			}
		}

        public function cart_total_price_partial(){
            $total_price = $this->Cart->get_cart_total_price();
            $shipping_fee = count($this->Cart->get_cart_products()) * 1.7;
            $total_plus_shipping = $total_price + $shipping_fee;

            $data = array(
                'total_cart_amount' => '$ ' . $total_price,
                'shipping_fee' => '$ ' . $shipping_fee,
                'total_plus_shipping' => '$ ' . $total_plus_shipping
            );

            echo json_encode($data);
        }
    }