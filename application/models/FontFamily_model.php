<?php 

class FontFamily_model extends CI_Model {

	function insert($data) {

		$this->db->insert('fontfamily', $data);
	}

	public function get($fontfamily) {

		$this->db->from('fontfamily');
		$this->db->where("fontfamily", $fontfamily);

		return $this->db->get()->row();
	}
}