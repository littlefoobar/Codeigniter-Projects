<?php

defined('BASEPATH') OR exit('No direct script access allowed');	

Class Posts extends CI_Controller{

	/**
	 *  List all the blog posts.
	 *. @return : Index page of blog application with post details and number of comments.
	 */
	Public function index($offset = 0){

		$config['base_url'] = base_url().'posts/index/'; //url to set pagination
		$config['total_rows'] = $this->db->count_all_results('posts');
		$config['per_page'] = 3;
		$config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'page-links');

		$this->pagination->initialize($config);

    	$data['title'] = 'Latest Posts';
 		$data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);
 		foreach ($data['posts'] as $key => $values){
 			$data['posts'][$key]['comment_count'] =  
 			$this->comment_model->get_comments_count($values['id']);
 			$data['posts'][$key]['username'] = 
 			$this->user_model->get_username($values['user_id']);
 		}

		$this->load->template('posts/index', $data);

	}

	/**
	 *  Show individual blog posts based on slug.
	 *. @param: $slug : string, (keyword to choose post)
	 *  @return : A descriptive view of corresponding blog post.
	 */
	Public function show($slug = NULL){

		$data['post'] = $this->post_model->get_posts($slug);
		$post_id = $data['post']['id'];
		$data['comment_count'] =  $this->comment_model->get_comments_count($post_id);
 		$data['username'] = $this->user_model->get_username($data['post']['user_id']);
		$data['comments'] = $this->comment_model->get_comments($post_id);
		$this->load->template('posts/show', $data);

	}

	/**
	 *  Creating new blog post.
	 *  @return : Upon successful validation a new post is getting created.
	 */
	Public function create(){

        if(!$this->session->userdata('logged_in')){  //If already logged in
        	redirect('users/login');
        }

		$data['title'] = "Create Post";
		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('body','Body','required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->template('posts/create', $data);
		}else{

			$config['upload_path'] = './assets/images';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '1024'; //in px
            $config['max_height'] = '768'; //in px

			$this->load->library('upload',$config);

			if(!$this->upload->do_upload()){
				$errors = array('error' => $this->upload->display_errors());
				$post_image = 'no_image.jpg';
			}else{
				$data = array('upload_data' => $this->upload->data());
				$post_image = $_FILES['userfile']['name'];
			}
			$this->post_model->add_post($post_image);
			$this->session->set_flashdata('post_created', 'Post created successfully');
			redirect('posts');
		}
	}

	/**
	 *  Edit a particular blog post.
	 *  @param : $slug string
	 *  @return : open up an editor view.
	 */
    Public function edit($slug){
            
    	if(!$this->session->userdata('logged_in')){ //If not logged in redirect to login.
        	redirect('users/login');
        }
 
		$data['post'] = $this->post_model->get_posts($slug);

		/*if($this->session->userdata('user_id') == $this->post_model->get_posts($slug)['user_id'])
		{
			return ('posts');
		}*/

  		$data['title'] = "Edit Post";
		$this->load->template('posts/edit', $data);
	}

  	/**
	 *  update a particular blog post.
	 */
	public function update(){

        if(!$this->session->userdata('logged_in')){ //If not logged in redirect to login.
        	redirect('users/login');
        }
        
		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('body','Body','required');

		$this->post_model->update_post();	
		$this->session->set_flashdata('post_updated', 'Post updated successfully');
		redirect('posts');
		
	}

	/**
	 *  Delete a particular blog post.
	 *  @param : id of that post.
	 */
	public function delete($id){
		if(!$this->session->userdata('logged_in')){  //If not logged in redirect to login.
        	redirect('users/login');
        }
		$this->post_model->delete_post($id);
		$this->session->set_flashdata('post_deleted', 'Post deleted successfully');
		redirect('posts');
		
	}

	/**
	 *  Method to do a fulltext search. 
	 *  
	 */
	public function search(){

        $search_text = $this->input->post('searchtext');
        $data['title'] = 'Search Results';
        $data['posts'] = $this->post_model->search_post($search_text);
       	foreach( $data['posts'] as $key=> $values){
        	$data['posts'][$key]['comment_count'] =  
 			$this->comment_model->get_comments_count($values['id']);
        	$data['posts'][$key]['body'] = $this->highlight($search_text,$values['body']);
			$data['posts'][$key]['username'] = 
 			$this->user_model->get_username($values['user_id']);
        }
         
		$this->load->template('posts/index', $data);
	}

    /**
	 *  Method to highlight search text. 
	 *  @param : $text_highlight - Text to be highlighted.
	 		   : $text_search - The full body/title content of that perticular post.  
	 */
	function highlight($text_highlight, $text_search) {
		$str = preg_replace('#'. preg_quote($text_highlight) .'#i', '<span style="background-color:#FFFF66; color:#FF0000;">\\0</span>', $text_search);
		return $str;
	}

}
?>