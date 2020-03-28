<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('item_model');
	}
	
	public function index() {
		$data['title'] = 'Item List';
		$data['jquery_script'] = 'item/index.js';
		$data['links'] = array('datatables.net-bs/css/dataTables.bootstrap.min.css');
								
		$data['scripts'] = array('datatables.net/js/jquery.dataTables.min.js', 
								'datatables.net-bs/js/dataTables.bootstrap.min.js');
								
		$data['page'] = 'item/index';
		$data['print_items'] = $this->item_model->get_all_item_list_for_print();
		$data['items'] = $this->item_model->get_all_item_list();
		$data['test'] = $this->item_model->get_item_history(1);
		$this->load->view('main_content', $data);
	}
	
	public function createItem() {
		$data['title'] = 'Create Item';
		$data['jquery_script'] = 'item/create_item.js';
		$data['links'] = array('toastr/build/toastr.css', 
								'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 
								'datatables.net-bs/css/dataTables.bootstrap.min.css');
								
		$data['scripts'] = array('toastr/build/toastr.min.js',
								'datatables.net/js/jquery.dataTables.min.js', 
								'datatables.net-bs/js/dataTables.bootstrap.min.js');
								
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
	}
	
	public function getAllCreatedItem() {
		$data = array('data'=>$this->item_model->getAllCreatedItem());
		echo json_encode($data);
	}
	
	public function itemIn() {
		$data['title'] = 'Item In';
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
		
	public function getAllItemIn() {
		$data = array('data'=>$this->item_model->getAllItemIn());
		echo json_encode($data);
	}
	
	public function getCustomerName() {
		$name = $this->input->get('term');
		
		if ($name) {
			$items = $this->item_model->getCustomerName($name);
			
			foreach ($items as $item) {
				$result[] = array(
					"label" => $item->customer
				);
			}
			
			echo json_encode($result);
		}
	}
	
	public function itemOut() {
		$data['title'] = 'Item Out';
		$data['jquery_script'] = 'item/item_out.js';
		$data['links'] = array('toastr/build/toastr.css', 
								'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 
								'select2/dist/css/select2.min.css', 
								'datatables.net-bs/css/dataTables.bootstrap.min.css');
								
		$data['scripts'] = array('toastr/build/toastr.min.js', 
								'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 
								'select2/dist/js/select2.full.min.js', 
								'datatables.net/js/jquery.dataTables.min.js', 
								'datatables.net-bs/js/dataTables.bootstrap.min.js');
								
		$data['page'] = 'item/item_out';
		$all_item_names = $this->item_model->getAllItemNames();
		
		foreach ($all_item_names as $item) {
			$item_names[$item->id] = $item->name;
		}
		
		$data['item_names'] = $item_names;
		$this->load->view('main_content', $data);
	}
	
	public function create_edit_item_out_auth() {
		$data = $this->input->post();
		$this->item_model->item_out($data);
	}
	
	public function getAllItemOut() {
		$data = array('data'=>$this->item_model->getAllItemOut());
		echo json_encode($data);
	}
	
	public function get_remaining_item_quantity() {
		$item_id = $this->input->post('item_id');
		echo $this->item_model->get_remaining_item_quantity($item_id);
	}
	
	public function item_list_print() {
		$data['title'] = 'Print Item List';
		$data['items'] = $this->item_model->get_all_item_list_for_print();
		$this->load->view('item/item_list_print', $data);
	}
	
	public function get_item_history($id = '') {
		$data = array('data'=>$this->item_model->get_item_history($id));
		echo json_encode($data);
	}
	
	// public function test() {
		// $data = array('data'=>array(array('id'=>1, 'a'=>'andy', 'date'=>"2020-03-26", "customer"=>"Anastasi", "in"=>1000, "balance"=>'100', "notes"=>''),
									// array('date'=>"2020-03-26", "customer"=>"Store", "in"=>'', "out"=>'30', "balance"=>'70', "notes"=>''),
									// array('date'=>"2020-03-26", "customer"=>"John & Mae", "in"=>'', "out"=>'50', "balance"=>'20', "notes"=>'')));
		// pr($data);	
		// echo json_encode($data);
	// }
}
