<?php
class Login_model extends CI_Model {
	public function auth($username, $password) {
		$this->db->select(array('username', 'role_id', 'role'));
		$this->db->from('users');
		$this->db->where(array('username' => $username, 'password' => $password));		
		$this->db->join('role', 'role.id = users.role_id');		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$username = $query->row()->username;
			$role_id = $query->row()->role_id;
			$this->session->set_userdata('username', $username);
			$this->session->set_userdata('role_id', $role_id);
			$this->session->set_userdata('logged_in', true);
			return true;
		}
		else {
			return false;
		}
	}
}
