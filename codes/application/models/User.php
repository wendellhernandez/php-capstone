<?php
    class User extends CI_Model{
        public function set_user(){
            $this->validate_set_user_input();

            $first_name = $this->input->post('first_name' , TRUE);
            $last_name = $this->input->post('last_name' , TRUE);
            $email = $this->input->post('email' , TRUE);
            $password = $this->input->post('password' , TRUE);
            $pass_hash = password_hash($password , PASSWORD_BCRYPT);

            $query = 'INSERT INTO users(first_name , last_name , email , password) VALUES(? , ? , ? , ?)';

            $values = array($first_name , $last_name , $email , $pass_hash);

            $this->db->query($query , $values);
        }

        public function validate_set_user_input(){
            $this->form_validation->set_rules('first_name' , 'First Name' , 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('last_name' , 'Last Name' , 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('email' , 'Email' , 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password' , 'Password' , 'trim|required|min_length[8]');
            $this->form_validation->set_rules('confirm_password' , 'Confirm Password' , 'trim|required|matches[password]');

            $this->set_user_errors();
        }

        public function set_user_errors(){
            if(!$this->form_validation->run()){
                $json_data = array(
                    'first_name' => form_error('first_name'),
                    'last_name' => form_error('last_name'),
                    'email' => form_error('email'),
                    'password' => form_error('password'),
                    'confirm_password' => form_error('confirm_password'),
                    'success' => ''
                );

                echo json_encode($json_data);
                die();
            }else{
                $json_data = array(
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'success' => 'Signup Successful'
                );

                echo json_encode($json_data);
            }
        }

        public function get_user(){
            $this->validate_get_user_input();

            $email = $this->input->post('email' , TRUE);
            $user = $this->get_user_by_email($email);

            $this->session->set_userdata('user_id' , $user['id']);
            $this->session->set_userdata('is_admin' , $user['is_admin']);
            $this->session->set_userdata('first_name' , $user['first_name']);
            $this->session->set_userdata('last_name' , $user['last_name']);
            $this->session->set_userdata('email' , $user['email']);
            $this->session->set_userdata('created_at' , $user['created_at']);
        }

        public function validate_get_user_input(){
            $this->form_validation->set_rules('email' , 'Email' , 'required');
            $this->form_validation->set_rules('password' , 'Password' , 'required');

            $this->get_user_errors();
        }

        public function get_user_errors(){
            if(!$this->form_validation->run()){
                $json_data = array(
                    'email' => form_error('email'),
                    'password' => form_error('password'),
                    'credentials' => '',
                    'success' => ''
                );

                echo json_encode($json_data);
                die();
            }else{
                $email = $this->input->post('email' , TRUE);
                $user = $this->get_user_by_email($email);
                $password = $this->input->post('password' , TRUE);

                if(empty($user)){
                    $json_data = array(
                        'email' => '',
                        'password' => '',
                        'credentials' => 'Invalid Credentials',
                        'success' => ''
                    );
    
                    echo json_encode($json_data);
                    die();
                }else if(!password_verify($password , $user['password'])){
                    $json_data = array(
                        'email' => '',
                        'password' => '',
                        'credentials' => 'Invalid Credentials',
                        'success' => ''
                    );
    
                    echo json_encode($json_data);
                    die();
                }

                $json_data = array(
                    'email' => '',
                    'password' => '',
                    'credentials' => '',
                    'success' => 'success'
                );

                echo json_encode($json_data);
            }
        }

        public function get_user_by_email($email){
            $query = 'SELECT * FROM users WHERE email = ?';

            return $this->db->query($query , array($email))->row_array();
        }
    }