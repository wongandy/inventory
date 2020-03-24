<?php
class Item_model extends CI_Model {
	public function create_item($data = array()) {
		$this->db->insert('item', $data);
	}
	
	public function getItemName($name = '') {
		$query = $this->db->select('id, name')->like('name', $name)->get('item');
		return $query->result();
	}
	
	public function getCustomerName($name = '') {
		$query = $this->db->select('customer')->like('customer', $name)->distinct()->get('item_out');
		return $query->result();
	}
	
	public function getAllItemNames() {
		$query = $this->db->select('id, name')->order_by('name', 'ASC')->get('item');
		return $query->result();
	}
	
	public function item_in($data = array()) {
		$this->db->insert('item_in', $data);
	}
	
	public function item_out($data = array()) {
		$this->db->insert('item_out', $data);
	}
	
	public function getAllCreatedItem() {
		$query = $this->db->select('id, name, alias, notes')
						->from('item')
						->order_by('id', 'DESC')
						->get();
						
		return $query->result();
	}
	
	public function getAllItemIn() {
		$query = $this->db->select('item_in.id, item_in.date, quantity, item.name, item_in.notes')
						->from('item_in')
						->join('item', 'item.id = item_in.item_id')
						->order_by('item_in.id', 'DESC')
						->get();
						
		return $query->result();
	}
	
	public function getAllItemOut() {
		$query = $this->db->select('item_out.id, item_out.date, item_out.customer, quantity, item.name, item_out.notes')
						->from('item_out')
						->join('item', 'item.id = item_out.item_id')
						->order_by('item_out.id', 'DESC')
						->get();
						
		return $query->result();
	}
	
	public function get_remaining_item_quantity($item_id = '') {
		// get all item in of an item
		$query = $this->db->select_sum('quantity', 'item_in')->where('item_id', $item_id)->get('item_in');
		$total_item_in = $query->row()->item_in;
		
		// get all item out of an item
		$query = $this->db->select_sum('quantity', 'item_out')->where('item_id', $item_id)->get('item_out');
		$total_item_out = $query->row()->item_out;
		
		// get total remaining of an item
		$remaining = $total_item_in - $total_item_out;
		echo $remaining;
	}
}
