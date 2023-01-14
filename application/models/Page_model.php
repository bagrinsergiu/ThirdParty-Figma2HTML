<?php 

class Page_model extends CI_Model {

	function insert($data) {

		$this->db->insert('page', $data);
	}

	public function get($page) {

		$this->db->from('page');
		$this->db->where("page", $page);
		
		return $this->db->get()->row();
	}

	public function getAll($project) {

		$this->db->from('page');
		$this->db->where("project", $project);
		
		return $this->db->get()->result();
	}
}