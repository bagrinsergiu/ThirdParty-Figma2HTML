<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Builderiov1 extends CI_Controller {

	public function __construct()
	{
		/* Call CodeIgniter's default Constructor */
		parent::__construct();
		
		/* Load Model */
		$this->load->model('Project_model');
		$this->load->model('Page_model');
		$this->load->model('Layerbuilderiov1_model');
		$this->load->model('FontFamily_model');

		/* Load Helper */
		$this->load->helper('parcer');
	}

	public function parse()
	{
		// Empty Table 
		$this->Layerbuilderiov1_model->empty();

		// Get Projects
		$projects = $this->Project_model->getAll();
		foreach ( $projects as $project ) {

			$pages = $this->Page_model->getAll($project->id);
			foreach ( $pages as $page ) {

				// ...
				$json = builderioParcer($page->url, 1200);
				
				// JSON Decode 		
				$array = json_decode($json)->layers;

				// ...
				$return = $this->recur($array);
			}
		}

		echo 'Final!';
	}

	public function font()
	{
		$layers = $this->Layerbuilderiov1_model->get();
		foreach ( $layers as $layer ) {
			if ( $layer->fontFamily != '' ) {
				$fontsArr = explode(',', $layer->fontFamily);
				foreach ( $fontsArr as $key=>$font ) {

					$fontExist = $this->FontFamily_model->get($font);
					if ( !$fontExist ) {
						$data['fontFamily'] = $font; 
						$this->FontFamily_model->insert($data);
					}
				}
			}
		}
	}
	
	public function designSystem()
	{
		$layers = $this->Layerbuilderiov1_model->getAll();
		foreach ( $layers as $layer ) {
			if ( $layer->fontFamily != '' ) {
				$fontsArr = explode(',', $layer->fontFamily);
				foreach ( $fontsArr as $key=>$font ) {

					// Se verifica daca fontul a fost adaugat in lista de fonturi anterior
					$fontExist = $this->FontFamily_model->get($font);
					if ( count($fontExist) == 0 ) {
						$data['fontFamily'] = $font; 
						$id = $this->FontFamily_model->insert($data);
					}
				}
			}
		}
	}
	
	public function view($l)
	{
		$layers = $this->Layerbuilderiov1_model->getChildrensByParent(0);
		$this->recur2( $l, $layers );
	}
		
	function recur2( $l, $layers, $parent = 0, $i = 0 ) {

		$i++;
		if ( $l == $i) die();

		foreach ( $layers as $layer ) {

			if ( $layer->name == 'IMAGE' )
				$bg = 'transparent';
			elseif ( $layer->type == 'TEXT' )
				$bg = 'transparent';
			elseif ( $layer->type == 'SVG' )
				$bg = 'transparent';
			else
				$bg = 'transparent';

			echo "<div data='$layer->type' style='width: $layer->width; height: $layer->height; position: " . ( $layer->type == 'FRAME' ? 'relative' : 'absolute' ) . "; top: $layer->y; left: $layer->x; background-color: $bg; border: 1px solid #ccc'>";

			$layers = $this->Layerbuilderiov1_model->getChildrensByParent($layer->id);
			if ( count($layers) > 0 ) {
				$this->recur2( $l, $layers, $layer->id, $i );
			}

			echo "</div>";

		}
	}

	function recur( $array, $parent = 0, $xx = 0, $yy = 0 ) {

		$layer = array();
		foreach ( $array as $object ) {

			// Insert in Layer Table
			$layer = builderioLayerBuild($object, $parent, $xx, $yy );

			$a = $this->Layerbuilderiov1_model->insert( $layer );

			// Check if t0his object contain childrens
			if ( isset($object->children) && count($object->children) > 0 ) {

				$parent = $a;
				$xx = $layer['xx'];
				$yy = $layer['yy'];

				$this->recur($object->children, $parent, $xx, $yy);
			}
		}
	}
}
