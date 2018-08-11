<?php

Class Post_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	/**
	 *  Fetch posts from post table.
	 *  @param : $slug : a keyword created from title to find post.
	             $limit: no of posts to be shown in a page.
	 * 			 $offset : variable for calculating remaining posts for pagination. 
	 */
	public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE){

			$this->db->order_by("id", "desc");

 		if($limit){
 			$this->db->limit($limit, $offset);
 		}
		if($slug === FALSE){
			$query = $this->db->get('posts');
			return $query->result_array();
		}

		$query = $this->db->get_where('posts',array('slug'=>$slug));
		return $query->row_array();
	}
    
    /**
	 *  Create post method
	 *  @param : $post_image : Image name passed from the posts controller.    
	 */
	public function add_post($post_image){

		$slug = url_title($this->input->post('title'));
		
		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'body' => $this->input->post('body'),
			'user_id'=> $this->session->userdata('user_id'),
			'post_image' => $post_image
		);

		return $this->db->insert('posts', $data);
	}

	/**
	 *  Delete post based on id.
	 *  @param : id of the post to be deleted
	 */
	public function delete_post($id){

	    $this->db->where('id', $id);
		return $this->db->delete('posts');
	}

   /**
	 *  Update post method.
	 */
	public function update_post(){

		$slug = url_title($this->input->post('title'));
        $data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'body' => $this->input->post('body')
		);

		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('posts',$data);
	}	
    
    /**
	 *  Method to search certain posts.
	 *  @param : $keyword - Word to be searched for.
	 */
	public function search_post($keyword){
        
		$data = $this->db
			    ->select('*')
			    ->from('posts')                    
			    ->where('MATCH (title) AGAINST ("'. $keyword .'")', NULL, FALSE)
			    ->or_where('MATCH (body) AGAINST ("'. $keyword .'")', NULL, FALSE)
			    ->order_by("id","DESC")
			    ->get();

		return $data->result_array();
		
	}

             
}
?>