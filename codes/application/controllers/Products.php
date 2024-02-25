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

        public function category_partial(){
            if(!empty($this->input->post('page' , TRUE))){
                $page = $this->input->post('page' , TRUE);
            }else{
                $page = 1;
            }

            $data = array(
                'page' => $page,
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

        public function admin_products(){
            $this->User->if_not_logged_in_redirect();

            $data = array(
                'aside_header_title' => 'Products',
                'first_name' => $this->session->userdata('first_name'),
                'categories' => $this->Product->get_categories(),
                'categories_table' => $this->Product->get_categories_table()
			);

            $this->load->view('products/admin_products' , $data);
        }

        public function admin_products_partial(){
            if(!empty($this->input->post('page' , TRUE))){
                $page = $this->input->post('page' , TRUE);
            }else{
                $page = 1;
            }

            $data = array(
                'page' => $page,
                'products' => $this->Product->get_products(),
                'categories' => $this->Product->get_categories(),
                'categories_table' => $this->Product->get_categories_table(),
                'total_count' => $this->Product->count_all_products(),
                'search' => $this->input->post('search' , TRUE),
                'current_category' => $this->input->post('category' , TRUE),
                'cart_products' => $this->Cart->get_cart_products()
			);

            $this->load->view('partials/admin_products_partial' , $data);
        }

        public function add_product(){
            $this->Product->set_product();
        }

        public function delete_product($product_id){
            $this->Product->remove_product($product_id);

            if(!empty($this->input->post('page' , TRUE))){
                $page = $this->input->post('page' , TRUE);
            }else{
                $page = 1;
            }

            $data = array(
                'page' => $page,
                'products' => $this->Product->get_products(),
                'categories' => $this->Product->get_categories(),
                'categories_table' => $this->Product->get_categories_table(),
                'total_count' => $this->Product->count_all_products(),
                'search' => $this->input->post('search' , TRUE),
                'current_category' => $this->input->post('category' , TRUE),
                'cart_products' => $this->Cart->get_cart_products()
			);

            $this->load->view('partials/admin_products_partial' , $data);
        }

        public function update_edit_form($product_id){
            $product = $this->Product->get_product_by_id($product_id);
            $image_string = $product['product_image_json'];
            $product_images = json_decode($image_string , true);

            $data = array(
                'categories_table' => $this->Product->get_categories_table(),
                'product' => $product,
                'product_images' => $product_images
			);

            $this->load->view('partials/admin_products_edit_form_partial' , $data);
        }

        public function edit_product($product_id){
            $this->Product->update_product($product_id);
        }

        public function add_category(){
            $this->Product->set_category();
        }

        public function delete_category($category_id){
            $this->Product->remove_category($category_id);
        }

        public function is_logged_in(){
			if(empty($this->session->userdata('user_id'))){
				return false;
			}else{
				return true;
			}
		}
    }