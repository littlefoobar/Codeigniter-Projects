<?php

Class Comments extends CI_Controller {

	/**
	 *  Comment creation method.
	 *  @param : id of the post, to which user added comment.
	 */
	public function create($post_id){

		$slug = $this->input->post('slug');
		$data['post'] = $this->post_model->get_posts($slug);
        $post_id = $data['post']['id'];
		$data['comment_count'] =  $this->comment_model->get_comments_count($post_id);
 		$data['username'] = $this->user_model->get_username($data['post']['user_id']);
		$data['comments'] = $this->comment_model->get_comments($post_id);
		
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('body','Body','required');
		
		if($this->form_validation->run() === FALSE){
			$this->load->template('posts/show',$data);
		}else{
			$this->comment_model->create_comment($post_id);
			redirect('posts/'.$slug);
		}

	}

} 