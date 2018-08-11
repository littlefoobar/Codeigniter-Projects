<?php

defined('BASEPATH') OR exit('No direct script access allowed');		

Class Pages extends CI_Controller{

	/**
	 *  Load individual pages.
	 *  @param : $page
	 */

	Public function show($page = 'home'){

		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}

		$data['title'] = ucfirst($page);

		$this->load->template('pages/'.$page.'.php', $data);

	}
}
?>