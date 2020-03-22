<?php
class Item_model extends CI_Model {
	public function create_item($data = array()) {
		$this->db->insert('item', $data);
	}
	
	public function getItemName($name = '') {
		$query = $this->db->select('id, name')->like('name', $name)->get('item');
		return $query->result();
	}
	
	public function getAllItemNames() {
		$query = $this->db->select('id, name')->order_by('name', 'ASC')->get('item');
		return $query->result();
	}
	
	public function item_in($data = array()) {
		$this->db->insert('item_in', $data);
	}
	
	public function getAllItemIn() {
		$query = $this->db->select('item_in.id, item_in.date, quantity, item.name, item_in.notes')
						->from('item_in')
						->join('item', 'item.id = item_in.item_id')
						->order_by('item_in.id', 'DESC')
						->get();
						
		return $query->result();
	}
}
