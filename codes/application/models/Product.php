<?php
    class Product extends CI_Model{
        public function get_products(){
            $query = 'SELECT 
                products.name AS product_name,
                products.price AS product_price,
                products.id AS product_id,
                categories.name AS category_name,
                products.stocks AS inventory,
                products.sold AS products_sold,
                products.product_image_json AS product_image_json
                FROM products
                INNER JOIN categories
                ON products.category_id = categories.id
                WHERE products.name LIKE ? 
                AND categories.name LIKE ?
                ORDER BY products.id DESC
                ';

            $search = $this->input->post('search' , TRUE);
            $category = $this->input->post('category' , TRUE);
            $data = array("%$search%" , "%$category%");

            return $this->db->query($query , $data)->result_array();
        }

        public function get_product_by_id($product_id){
            $query = 'SELECT * FROM products WHERE id = ?';

            return $this->db->query($query , array($product_id))->row_array();
        }

        public function get_similar_products($product_id){
            $query = 'SELECT * FROM products WHERE id = ?';
            $result = $this->db->query($query , array($product_id))->row_array();
            $category_id = $result['category_id'];

            $query = 'SELECT * FROM products 
                WHERE category_id = ? AND
                id != ?
                LIMIT 5
                ';
            return $this->db->query($query , array($category_id , $product_id))->result_array();
        }

        public function set_product_sold(){
            $cart_products = $this->Cart->get_cart_products();

            foreach($cart_products as $cart_product){
                $product_id = $cart_product['product_id'];
                $product = $this->get_product_by_id($product_id);
                $sold_past = $product['sold'];
                $sold = $sold_past + $cart_product['carts_quantity'];
                $stocks_past = $product['stocks'];
                $stocks = $stocks_past - $cart_product['carts_quantity'];

                $query = 'UPDATE products SET sold = ? , stocks = ? WHERE id = ?';

                $data = array($sold , $stocks , $product_id);

                $this->db->query($query , $data);
            }
        }

        public function get_categories(){
            $query = 'SELECT 
                categories.name AS category_name ,
                categories.id AS category_id,
                count(*) as product_count
                FROM products
                INNER JOIN categories
                ON products.category_id = categories.id
                GROUP BY categories.name;
            ';

            return $this->db->query($query)->result_array();
        }

        public function get_categories_table(){
            $query = 'SELECT * FROM categories;';

            return $this->db->query($query)->result_array();
        }

        public function count_all_products(){
            $categories = $this->Product->get_categories();
            $sum = 0;

            foreach($categories as $category){
                $sum += $category['product_count'];
            }

            return $sum;
        }

        public function set_sold_count(){
            $query = 'UPDATE products 
                SET sold = ?
                WHERE ;
            ';
        }

        public function set_product(){
            $this->validate_set_product_input();

            $user_id = $this->session->userdata('user_id');
            $product_name = $this->input->post('product_name' , TRUE);
            $description = $this->input->post('description' , TRUE);
            $category = $this->input->post('category' , TRUE);
            $price = $this->input->post('price' , TRUE);
            $inventory = $this->input->post('inventory' , TRUE);
            $product_image_json = array();

            

            for($i=1; $i<=5; $i++){
                $file = $_FILES["image_$i"];
                $file_name = $file['name'];
                if(!empty($file_name)){
                    $file_ext_explode = explode('.' , $file_name);
                    $file_ext = strtolower(end($file_ext_explode));
                    $file_tmp_name = $file["tmp_name"];
                    $error = $file["error"];
                    $allowed = array('jpg' , 'jpeg' , 'png' , 'gif');
                    $file_destination = 'assets/images/products/' . $product_name . $i . '.' . $file_ext;

                    if($error == 0 && in_array($file_ext , $allowed) && !empty($file_name)){
                        $product_image_json["image_$i"] = $product_name . $i . '.' . $file_ext;

                        move_uploaded_file($file_tmp_name , $file_destination);
                    }else{
                        $product_image_json["image_$i"] = 'blank.png';
                    }
                }
            }

            $product_image_json = json_encode($product_image_json);

            $query = 'INSERT INTO products 
                (user_id , name , description , category_id , price , stocks , product_image_json)
                VALUES
                (? , ? , ? , ? , ? , ? , ?);
            ';

            $data = array($user_id , $product_name , $description , $category , $price , $inventory , $product_image_json);

            $this->db->query($query , $data);
        }

        public function validate_set_product_input(){
            $this->form_validation->set_rules('product_name' , 'Product Name' , 'trim|required|min_length[2]');
            $this->form_validation->set_rules('description' , 'Description' , 'trim|required|min_length[2]');
            $this->form_validation->set_rules('price' , 'Price' , 'trim|required|numeric');
            $this->form_validation->set_rules('inventory' , 'Inventory' , 'trim|required|is_natural_no_zero');

            $this->set_product_errors();
        }

        public function set_product_errors(){
            if(!$this->form_validation->run()){
                $json_data = array(
                    'product_name_error' => form_error('product_name'),
                    'description_error' => form_error('description'),
                    'price_error' => form_error('price'),
                    'inventory_error' => form_error('inventory'),
                    'success' => false
                );

                echo json_encode($json_data);
                die();
            }else{
                $json_data = array(
                    'product_name_error' => '',
                    'description_error' => '',
                    'price_error' => '',
                    'inventory_error' => '',
                    'success' => true
                );

                echo json_encode($json_data);
            }
        }

        public function remove_product($product_id){
            $query = 'DELETE FROM products WHERE id = ?';

            $this->db->query($query , array($product_id));
        }
    }