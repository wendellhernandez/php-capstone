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
            $query = 'SELECT 
                *, 
                products.name AS product_name,
                products.id AS product_id,
                products.category_id AS category_id
                FROM products
                LEFT JOIN categories
                ON products.category_id = categories.id
                WHERE products.id = ?';

            return $this->db->query($query , array($product_id))->row_array();
        }

        public function get_product_by_category_id($category_id){
            $query = 'SELECT * FROM products WHERE category_id = ?';

            return $this->db->query($query , array($category_id))->result_array();
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
                categories.image_link AS category_image,
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

        public function get_category_by_id($category_id){
            $query = 'SELECT * FROM categories
                WHERE id = ?
            ;';

            return $this->db->query($query , array($category_id))->row_array();
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
                if(!empty($_FILES['add_image']['name'][$i-1])){
                    $_FILES['userfile']['name'] = $_FILES['add_image']['name'][$i-1];
                    $_FILES['userfile']['type'] = $_FILES['add_image']['type'][$i-1];
                    $_FILES['userfile']['tmp_name'] = $_FILES['add_image']['tmp_name'][$i-1];
                    $_FILES['userfile']['error'] = $_FILES['add_image']['error'][$i-1];
                    $_FILES['userfile']['size'] = $_FILES['add_image']['size'][$i-1];
    
                    $config = array(
                        'file_name'     => $product_name . $i,
                        'allowed_types' => 'jpg|jpeg|png|gif|webp|avif',
                        'max_size'      => 6000,
                        'overwrite'     => true,
                        'upload_path'   => './assets/images/products',
                        'remove_spaces' => false
                    );
    
                    $this->upload->initialize($config);
    
                    if($this->upload->do_upload()){
                        $filename = $this->upload->data();
    
                        $product_image_json["image_$i"] = $filename['file_name'];
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

            redirect('/dashboard/products');
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
            $product = $this->get_product_by_id($product_id);
            $image_string = $product['product_image_json'];
            $image_json = json_decode($image_string , true);
            
            foreach($image_json as $image){
                unlink("assets/images/products/" . $image);
            }

            $query = 'DELETE FROM products WHERE id = ?';

            $this->db->query($query , array($product_id));
        }

        public function remove_product_by_category($category_id){
            $products = $this->get_product_by_category_id($category_id);

            foreach($products as $product){
                $image_string = $product['product_image_json'];
                $image_json = json_decode($image_string , true);
                
                foreach($image_json as $image){
                    unlink("assets/images/products/" . $image);
                }
            }

            $query = 'DELETE FROM products WHERE category_id = ?';

            $this->db->query($query , array($category_id));
        }

        public function update_product($product_id){
            $this->validate_set_product_input();

            $product = $this->get_product_by_id($product_id);
            $image_string = $product['product_image_json'];
            $image_json = json_decode($image_string , true);
            
            foreach($image_json as $image){
                unlink("assets/images/products/" . $image);
            }

            $product_name = $this->input->post('product_name' , TRUE);
            $description = $this->input->post('description' , TRUE);
            $category = $this->input->post('category' , TRUE);
            $price = $this->input->post('price' , TRUE);
            $inventory = $this->input->post('inventory' , TRUE);
            $product_image_json = array();

            for($i=1; $i<=5; $i++){
                if(!empty($_FILES['add_image']['name'][$i-1])){
                    $_FILES['userfile']['name'] = $_FILES['add_image']['name'][$i-1];
                    $_FILES['userfile']['type'] = $_FILES['add_image']['type'][$i-1];
                    $_FILES['userfile']['tmp_name'] = $_FILES['add_image']['tmp_name'][$i-1];
                    $_FILES['userfile']['error'] = $_FILES['add_image']['error'][$i-1];
                    $_FILES['userfile']['size'] = $_FILES['add_image']['size'][$i-1];
    
                    $config = array(
                        'file_name'     => $product_name . $i,
                        'allowed_types' => 'jpg|jpeg|png|gif|webp|avif',
                        'max_size'      => 6000,
                        'overwrite'     => true,
                        'upload_path'   => './assets/images/products',
                        'remove_spaces' => false
                    );
    
                    $this->upload->initialize($config);
    
                    if($this->upload->do_upload()){
                        $filename = $this->upload->data();
    
                        $product_image_json["image_$i"] = $filename['file_name'];
                    }
                }
            }

            $product_image_json = json_encode($product_image_json);

            $query = 'UPDATE products SET 
                name = ? , description = ? , category_id = ? , price = ? , stocks = ? , product_image_json = ?
                WHERE id = ?;
            ';

            $data = array($product_name , $description , $category , $price , $inventory , $product_image_json , $product_id);

            $this->db->query($query , $data);

            redirect('/dashboard/products');
        }

        public function set_category(){
            $this->validate_set_category_input();

            $category_name = $this->input->post('category_name' , TRUE);
            $image_name = '';

            $config = array(
                'file_name'     => $category_name,
                'allowed_types' => 'jpg|jpeg|png|gif|webp|avif',
                'max_size'      => 6000,
                'overwrite'     => true,
                'upload_path'   => './assets/images/categories',
                'remove_spaces' => false
            );

            $this->upload->initialize($config);

            if($this->upload->do_upload('add_category_image')){
                $filename = $this->upload->data();
                $image_name = $filename['file_name'];
            }else{
                die();
                redirect('/dashboard/products');
            }

            $query = 'INSERT INTO categories 
                (name , image_link)
                VALUES (? , ?);
            ';

            $data = array($category_name , $image_name);

            $this->db->query($query , $data);

            redirect('/dashboard/products');
        }

        public function validate_set_category_input(){
            $this->form_validation->set_rules('category_name' , 'Category Name' , 'trim|required|min_length[2]');

            $this->set_category_errors();
        }

        public function set_category_errors(){
            if(!$this->form_validation->run()){
                $json_data = array(
                    'category_name_error' => form_error('category_name'),
                    'success' => false
                );

                echo json_encode($json_data);
                die();
            }else{
                $json_data = array(
                    'category_name_error' => '',
                    'success' => true
                );

                echo json_encode($json_data);
            }
        }

        public function remove_category($category_id){
            $this->remove_product_by_category($category_id);

            $category = $this->get_category_by_id($category_id);
            
            unlink("assets/images/categories/" . $category['image_link']);

            $query = 'DELETE FROM categories WHERE id = ?';

            $this->db->query($query , array($category_id));

            redirect('/dashboard/products');
        }
    }