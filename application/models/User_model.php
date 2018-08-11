<?php

Class User_model extends CI_Model{

	public function __construct(){

		$this->load->database();
	}

    /**
     *  User registration.
     *  @param : encrypted password
     */
    public function register($enc_password){
    	
    	$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					'password' => $enc_password
				);

       	return $this->db->insert('users', $data);
    }

    /**
     *  User login.
     *  @param : $username,$password 
     */
    public function login($username,$password){

    	$this->db->where('username',$username);
    	$this->db->where('password',$password);

    	$result = $this->db->get('users');
    	if($result->num_rows()==1){
    		return $result->row(0)->id;
    	}else{
    		return false;
    	}
    }
    
    /**
     *  User name existence checking.
     *  @param : $username
     *  @return: true if exists, false otherwise
     */
    function check_username_exists($username){
    	$query = $this->db->get_where('users',array('username'=>$username));
    	if(empty($query->row_array())){
    		return true;
    	}else{
    		return false;
    	}
    }

     /**
     *  Email existence checking.
     *  @param : $email
     *  @return: true if exists, false otherwise
     */
    function check_email_exists($email){
    	$query = $this->db->get_where('users',array('email'=>$email));
    	if(empty($query->row_array())){
    		return true;
    	}else{
    		return false;
    	}
    }   
    
    /**
     *  Fetch username based on user id.
     *  @param : $userId
     *  @return: username of the user.
     */
    function get_username($user_id){
        
        $query = $this->db->get_where('users',array('id'=>$user_id));
        return $query->row_array()['name'];
    }  
    
}
?>