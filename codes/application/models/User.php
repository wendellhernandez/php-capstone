<?php
    class User extends CI_Model{
        public function set_user(){
            $this->validate_user_input();

            $first_name = $this->input->post('first_name' , TRUE);
            $last_name = $this->input->post('last_name' , TRUE);
            $email = $this->input->post('email' , TRUE);
            $password = $this->input->post('password' , TRUE);
            $pass_hash = password_hash($password , PASSWORD_BCRYPT);

            $this->output->enable_profiler(true);

            $query = 'INSERT INTO users(first_name , last_name , email , password) VALUES(? , ? , ? , ?)';

            $values = array($first_name , $last_name , $email , $pass_hash);

            $this->db->query($query , $values);
        }

        public function validate_user_input(){
            $this->form_validation->set_rules('first_name' , 'First Name' , 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('last_name' , 'Last Name' , 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('email' , 'Email' , 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password' , 'Password' , 'trim|required|min_length[8]');
            $this->form_validation->set_rules('confirm_password' , 'Confirm Password' , 'trim|required|matches[password]');

            $this->set_validation_errors();
        }

        public function set_validation_errors(){
            if(!$this->form_validation->run()){
                $errors = array(
                    'first_name' => form_error('first_name' , '' , ''),
                    'last_name' => form_error('last_name' , '' , ''),
                    'email' => form_error('email' , '' , ''),
                    'password' => form_error('password' , '' , ''),
                    'confirm_password' => form_error('confirm_password' , '' , ''),
                    'success' => ''
                );

                echo json_encode($errors);
                die();
            }else{
                $errors = array(
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'success' => 'Signup Successful'
                );

                echo json_encode($errors);
            }
        }
    }