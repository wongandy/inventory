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
		$data['page'] = 'item/create_item';
		$this->load->view('main_content', $data);
	}
	
	public function editItem() {
		$data['id'] = '';
		$data['page'] = 'item/create_item';
		$this->load->view('main_content', $data);
	}
	
	public function create_edit_item_auth() {
		$data = $this->input->post();
		$this->item_model->create_item($data);
		redirect(base_url() . 'item/createItem');
	}
	
	public function itemIn() {
		$data['jquery_script'] = 'item/item_in.js';
		$data['links'] = array('toastr/build/toastr.css', 
								'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 
								'select2/dist/css/select2.min.css', 
								'datatables.net-bs/css/dataTables.bootstrap.min.css');
								
		$data['scripts'] = array('toastr/build/toastr.min.js', 
								'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 
								'select2/dist/js/select2.full.min.js', 
								'datatables.net/js/jquery.dataTables.min.js', 
								'datatables.net-bs/js/dataTables.bootstrap.min.js');
								
		$data['page'] = 'item/item_in';
		$all_item_names = $this->item_model->getAllItemNames();
		
		foreach ($all_item_names as $item) {
			$item_names[$item->id] = $item->name;
		}
		
		$data['item_names'] = $item_names;
		$this->load->view('main_content', $data);
	}
	
	public function create_edit_item_in_auth() {
		$data = $this->input->post();
		$this->item_model->item_in($data);
	}
		
	public function getAllitemIn() {
		$data = array('data'=>$this->item_model->getAllitemIn());
		// pr($data);
		echo json_encode($data);
	}
	
	// public function getItemName() {
		// $name = $this->input->get('term');
		
		// if ($name) {
			// $items = $this->item_model->getItemName($name);
			
			// foreach ($items as $item) {
				// $result[] = array(
					// "label" => $item->name,
					// "value" => $item->id
				// );
			// }
			
			// echo json_encode($result);
		// }
	// }

}
