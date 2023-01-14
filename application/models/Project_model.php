<?php 

class Project_model extends CI_Model {

	function insert($data) {

		$this->db->insert('project', $data);
	}

	public function get($project) {

		$this->db->from('project');
		$this->db->where("project", $project);
		
		return $this->db->get()->row();
	}

	public function getAll() {

		$this->db->from('project');
		
		return $this->db->get()->result();
	}
}