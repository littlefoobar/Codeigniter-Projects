<?php

defined('BASEPATH') OR exit('No direct script access allowed');	

Class Users extends CI_Controller{

	/**
	 *  User registration.
	 * 
	 */
	public function register(){

		$data['title'] = 'Sign Up';
		
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('username','Username','required|is_unique[users.username]');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('password-confirm','Confirm Password','matches[password]');

		if($this->form_validation->run() === FALSE){
			$this->load->template('users/register',$data);
		}else{
             $enc_password = md5($this->input->post('password'));  
			 $this->user_model->register($enc_password);
			 $this->session->set_flashdata('user_registered', 'Congrats !!, Please LOGIN to manage your posts  !!');
			 redirect('posts');
		}
	}

    /**
	 *  User Login.
	 * 
	 */
	public function login(){

		$data['title'] = 'Sign In';
		
	
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		

		if($this->form_validation->run() === FALSE){

			$this->load->template('users/login',$data);

		}else{
               
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $user_id = $this->user_model->login($username,$password);

            if($user_id){

            	$user_data = array(
            		'user_id' => $user_id,
            		'username'=> $username,
            		'logged_in' =>true
            	);
            	$this->session->set_userdata($user_data);
             	$this->session->set_flashdata('login_success', 'You are successfully loggedIn');
				redirect('posts');

            }else{
             	$this->session->set_flashdata('login_failed', 'Invalid login');
				redirect('users/login');

             }	 
			 
		}
	}

	/**
	 *  User logout.
	 * 
	 */
	public function logout(){

		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');

		$this->session->set_flashdata('user_logout', 'You are successfully logged out');
		redirect('users/login');
	}

}

?>