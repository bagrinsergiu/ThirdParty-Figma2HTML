<?php 

class Layerh2dv1_model extends CI_Model {

	function insert($data) {

		$this->db->insert('layer', $data);

		return $this->db->insert_id();
	}

	public function empty() {

        $this->db->empty_table('layer');
    }
}