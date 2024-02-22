<?php
    class Shipping_information extends CI_Model{
        public function set_shipping_info(){
            $this->validate_shipping_info_input();

            /*
                SHIPPING INFORMATIONS
            */
            $user_id = $this->session->userdata('user_id');
            $first_name = $this->input->post('first_name' , TRUE);
            $last_name = $this->input->post('last_name' , TRUE);
            $address_1 = $this->input->post('address_1' , TRUE);
            $address_2 = $this->input->post('address_2' , TRUE);
            $city = $this->input->post('city' , TRUE);
            $state = $this->input->post('state' , TRUE);
            $zip = $this->input->post('zip' , TRUE);

            $query = 'DELETE FROM shipping_informations
                WHERE user_id = ?;
            ';
            $this->db->query($query , array($user_id));

            $query = 'INSERT INTO shipping_informations
                (user_id , first_name , last_name , address_1 , address_2 , city , state , zip)
                VALUES
                (? , ? , ? , ? , ? , ? ,  ? , ?);
            ';

            $data = array($user_id , $first_name , $last_name , $address_1 , $address_2 , $city , $state , $zip);

            $this->db->query($query , $data);

            /*
                BILLING INFORMATIONS
            */
            $first_name = $this->input->post('first_name_billing' , TRUE);
            $last_name = $this->input->post('last_name_billing' , TRUE);
            $address_1 = $this->input->post('address_1_billing' , TRUE);
            $address_2 = $this->input->post('address_2_billing' , TRUE);
            $city = $this->input->post('city_billing' , TRUE);
            $state = $this->input->post('state_billing' , TRUE);
            $zip = $this->input->post('zip_billing' , TRUE);

            $query = 'DELETE FROM billing_informations
                WHERE user_id = ?;
            ';
            $this->db->query($query , array($user_id));

            $query = 'INSERT INTO billing_informations
                (user_id , first_name , last_name , address_1 , address_2 , city , state , zip)
                VALUES
                (? , ? , ? , ? , ? , ? ,  ? , ?);
            ';

            $data = array($user_id , $first_name , $last_name , $address_1 , $address_2 , $city , $state , $zip);

            $this->db->query($query , $data);
        }

        public function validate_shipping_info_input(){
            $this->form_validation->set_rules('first_name' , 'First Name' , 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('last_name' , 'Last Name' , 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('address_1' , 'Address 1' , 'trim|required|min_length[2]|alpha_numeric_spaces');
            $this->form_validation->set_rules('address_2' , 'Address 2' , 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('city' , 'City' , 'trim|required|min_length[2]|alpha_numeric_spaces');
            $this->form_validation->set_rules('state' , 'State' , 'trim|required|min_length[2]|alpha_numeric_spaces');
            $this->form_validation->set_rules('zip' , 'Zip Code' , 'trim|required|min_length[2]|integer');

            $this->form_validation->set_rules('first_name_billing' , 'First Name' , 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('last_name_billing' , 'Last Name' , 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('address_1_billing' , 'Address 1' , 'trim|required|min_length[2]|alpha_numeric_spaces');
            $this->form_validation->set_rules('address_2_billing' , 'Address 2' , 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('city_billing' , 'City' , 'trim|required|min_length[2]|alpha_numeric_spaces');
            $this->form_validation->set_rules('state_billing' , 'State' , 'trim|required|min_length[2]|alpha_numeric_spaces');
            $this->form_validation->set_rules('zip_billing' , 'Zip Code' , 'trim|required|min_length[2]|integer');

            $this->set_shipping_info_errors();
        }

        public function set_shipping_info_errors(){
            if(!$this->form_validation->run()){
                $json_data = array(
                    'first_name' => form_error('first_name'),
                    'last_name' => form_error('last_name'),
                    'address_1' => form_error('address_1'),
                    'address_2' => form_error('address_2'),
                    'city' => form_error('city'),
                    'state' => form_error('state'),
                    'zip' => form_error('zip'),
                    'first_name_billing' => form_error('first_name_billing'),
                    'last_name_billing' => form_error('last_name_billing'),
                    'address_1_billing' => form_error('address_1_billing'),
                    'address_2_billing' => form_error('address_2_billing'),
                    'city_billing' => form_error('city_billing'),
                    'state_billing' => form_error('state_billing'),
                    'zip_billing' => form_error('zip_billing'),
                    'no_error' => false
                );

                echo json_encode($json_data);
                die();
            }else{
                $json_data = array(
                    'first_name' => '',
                    'last_name' => '',
                    'address_1' => '',
                    'address_2' => '',
                    'city' => '',
                    'state' => '',
                    'zip' => '',
                    'first_name_billing' => '',
                    'last_name_billing' => '',
                    'address_1_billing' => '',
                    'address_2_billing' => '',
                    'city_billing' => '',
                    'state_billing' => '',
                    'zip_billing' => '',
                    'no_error' => true
                );

                echo json_encode($json_data);
            }
        }

        public function get_user_shipping_info(){
            $user_id = $this->session->userdata('user_id');

            $query = 'SELECT * FROM shipping_informations 
                WHERE user_id = ?;
            ';

            return $this->db->query($query , array($user_id))->row_array();
        }
    }