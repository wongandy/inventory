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
		return $remaining;
	}
	
	public function get_all_item_list() {
		$query = $this->db->select('id, name')->order_by('name', 'ASC')->get('item');
		$items = $query->result();
		
		foreach ($items as $key => $item) {
			$items[$key]->remaining = $this->get_remaining_item_quantity($item->id);
		}
		
		return $items;
	}
	
	public function get_all_item_list_for_print() {
		$query = $this->db->select('id, alias')->get('item');
		$items = $query->result();
		
		foreach ($items as $key => $item) {
			$items[$key]->remaining = $this->get_remaining_item_quantity($item->id);
		}
		
		return $items;
	}
	
	public function get_item_history($id = '') {
		$query = $this->db->select('id, item_id, date, customer, quantity AS out, notes')->where('item_id', $id)->order_by('customer', 'asc')->get('item_out');
		$items_out = $query->result_array();
		
		foreach ($items_out as $key => $item_out) {
			$items_out[$key]['in'] = '';
			$items_out[$key]['balance'] = '';
		}
		
		$query = $this->db->select('id, item_id, date, quantity AS in, notes')->where('item_id', $id)->get('item_in');
		$items_in = $query->result_array();
		
		foreach ($items_in as $key => $item_in) {
			$items_in[$key]['out'] = '';
			$items_in[$key]['customer'] = 'In'; // hardcoded "In" temporarily
			$items_in[$key]['balance'] = '';
		}
		
		foreach ($items_in as $key => $item_in) {
			array_push($items_out, $item_in);
		}
		
		// Comparison function 
		function date_compare($item1, $item2) {
			$date1 = strtotime($item1['date']); 
			$date2 = strtotime($item2['date']);
			return $date1 - $date2; 
		}  
		  
		// Sort the array  
		usort($items_out, 'date_compare'); 
		
		$item_history = $items_out;
		
		$balance = 0;
		
		foreach ($item_history as $key => $item) {
			if ($item['in']) {
				$balance += $item['in'];
				$item_history[$key]['balance'] = $balance;
			}
			elseif ($item['out']) {
				$balance -= $item['out'];
				$item_history[$key]['balance'] = $balance;
			}
		}
		
		return $item_history;
	}
}
