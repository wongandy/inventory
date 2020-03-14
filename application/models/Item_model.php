<?php
class Item_model extends CI_Model {
	public function create_item($data = array()) {
		$this->db->insert('item', $data);
	}
}
