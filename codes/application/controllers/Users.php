<?php
	class Users extends CI_Controller{
		public function signup(){
			$this->load->view('users/signup');
		}

		public function add_user(){
			$this->User->set_user();
		}
	}