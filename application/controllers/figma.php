<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Figma extends CI_Controller {

	public function __construct()
	{
		/* Call CodeIgniter's default Constructor */
		parent::__construct();

		// Helpers
		$this->load->helper('str');
		$this->load->helper('color');
		$this->load->helper('layer');
		$this->load->helper('frame');
		$this->load->helper('group');
		$this->load->helper('rectangle');
		$this->load->helper('text');
		$this->load->helper('console');
	}

	public function import()
	{
		// Load JSON File
		$json = file_get_contents(APPPATH . '/assets/001.json');

		// JSON Decode
		$array = json_decode($json);

		// Echo Body Style
		//echo '<style>body { background: #0e0e0e; }</style>';

		// Return 
		layer($array);
	}
}
