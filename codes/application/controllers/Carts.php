<?php
    class Carts extends CI_Controller{
        public function index(){
            if(!$this->is_logged_in()){
                redirect('/login');
            }

            $data = array(
				'is_logged_in' => $this->is_logged_in(),
                'first_name' => $this->session->userdata('first_name'),
                'cart_products' => $this->Cart->get_cart_products()
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
    }