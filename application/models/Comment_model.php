<?php

Class Comment_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	/**
	 *  Method to insert comment details into table 'comments'.
	 *  @param : $post_id : id of that particular post.    
	 */
	public function create_comment($post_id){
		$data = array(
			'post_id' => $post_id,
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'comment' => $this->input->post('body'),
		);
		return $this->db->insert('comments',$data);
	}
    
    /**
	 *  Method to fetch comment details to show in the post detail page.
	 *  @param : $post_id : id of that particular post.    
	 */
	public function get_comments($post_id){
		$query = $this->db->get_where('comments',array('post_id'=>$post_id));
		return $query->result_array();
	}

    /**
	 *  Method to count the total number of comments.
	 *  @param : $post_id : id of that particular post to which comments have been posted.    
	 */
	public function get_comments_count($post_id){
		$count = $this->db
   				->where('post_id',$post_id)
  				 ->count_all_results('comments');
  		return $count;

	}
}
?>