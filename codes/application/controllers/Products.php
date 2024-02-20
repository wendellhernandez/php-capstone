<?php
    class Products extends CI_Controller{
        public function index(){
            $data = array(
				'is_logged_in' => $this->is_logged_in(),
                'first_name' => $this->session->userdata('first_name'),
                'search' => $this->input->post('search' , TRUE)
			);

            $this->load->view('products/category' , $data);
        }

        public function is_logged_in(){
			if(empty($this->session->userdata('user_id'))){
				return false;
			}else{
				return true;
			}
		}

        public function category_partial(){
            $data = array(
				'is_logged_in' => $this->is_logged_in(),
                'products' => $this->Product->get_products(),
                'categories' => $this->Product->get_categories(),
                'total_count' => $this->Product->count_all_products(),
                'search' => $this->input->post('search' , TRUE),
                'current_category' => $this->input->post('category' , TRUE),
                'cart_products' => $this->Cart->get_cart_products()
			);

            $this->load->view('partials/category_partial' , $data);
        }

        public function show($product_id){
            $data = array(
				'is_logged_in' => $this->is_logged_in(),
                'first_name' => $this->session->userdata('first_name'),
                'product' => $this->Product->get_product_by_id($product_id),
                'similar_products' => $this->Product->get_similar_products($product_id),
                'cart_products' => $this->Cart->get_cart_products()
			);

            $this->load->view('products/show' , $data);
        }
    }