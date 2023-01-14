<?php 

class Layerbuilderiov1_model extends CI_Model {

	function insert($data) {

		$this->db->insert('layerbuilderiov1', $data);

		return $this->db->insert_id();
	}

	public function empty() {

        $this->db->empty_table('layerbuilderiov1');
    }

	public function getAll() {

		$this->db->from('layerbuilderiov1');
		return $this->db->get()->result();
	}

	public function getChildrensByParent($parent) {

		$this->db->from('layerbuilderiov1');
		$this->db->where("parent", $parent);
		
		return $this->db->get()->result();
	}
}