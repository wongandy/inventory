<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('item_model');
	}
	
	public function index() {
		$data['page'] = 'item/index';
		$this->load->view('main_content', $data);
	}
	
	public function createItem() {
		$data['page'] = 'item/createItem';
		$this->load->view('main_content', $data);
	}
	
	public function editItem() {
		$data['id'] = '';
		$data['page'] = 'item/createItem';
		$this->load->view('main_content', $data);
	}
	
	public function auth() {
		$data = $this->input->post();
		$this->item_model->create_item($data);
		redirect(base_url() . 'item/createItem');
	}
}
