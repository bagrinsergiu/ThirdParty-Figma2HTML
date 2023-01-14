<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class H2dv1 extends CI_Controller {

	public function __construct()
	{
		/* Call CodeIgniter's default Constructor */
		parent::__construct();
		
		/* Load Model */
		$this->load->model('Layerh2dv1_model');
	}

	public function index()
	{
		// Empty Table 
		$this->Layerh2dv1_model->empty();

		// Load JSON File
		$json = file_get_contents(APPPATH . '/assets/apple.com.json');

		// JSON Decode 		
		$object = json_decode($json);
		$array[] = $object;

		// ...
		$return = $this->recur($array);

		echo 'Finish!';
	}

	function recur( $array, $parent = 0 ) {

		$layerLimit = [
			'type', 	
			'name', 
			'$display', 
			'$position', 
			'x', 
			'y', 
			'width',
			'height', 
			'constraints', 
			'$autoWidth', 
			'cornerRadius',
			'strokeWeight',
			'characters',
			'textAutoResize',
			'textAlignVertical',
			'letterSpacing',
			'lineHeight',
			'fontSize',
			'fontWeight',
			'fontStretch',
			'fontStyle',
			'textAlignHorizontal',
			'strokeTopWeight',
			'strokeRightWeight',
			'strokeBottomWeight',
			'strokeLeftWeight',
			'paragraphIndent',
			'svg',
			'opacity',
			'$heightAuto'
		];

		$layerIgnore = [
			'fills', 
			'children', 
			'clipsContent', 
			'$cssProps', 
			'relativeTransform',
			'strokes',
			'fontFamily',
			'ranges'
		];

		$layer['parent'] = $parent;
		foreach ( $array as $object ) {
			foreach ( $object as $key => $value ) {

				if ( in_array( $key, $layerLimit ) ) {

					if ( is_string( $value ) )
						$layer[$key] = $value;

					elseif ( is_object( $value ) )
						$layer[$key] = serialize($value);

					elseif ( is_integer( $value ) )
						$layer[$key] = $value;

					elseif ( is_bool( $value ) )
						$layer[$key] = $value;

					elseif ( is_double( $value ) )
						$layer[$key] = $value;

					else {
						echo gettype($value);
						echo '<br><br>--------111----';
						echo $key;
						echo '<br><br>--------111----';
						print_r($value);
						die();
					}

				} elseif ( !in_array( $key, $layerIgnore ) ) {
					echo $key;
					echo '<br><br>--------222----';
					print_r($value);
					die();
				}
			}

			// Insert in Layer Table
			$parent = $this->Layer_model->insert($layer);

			if ( isset($object->children) ) 
				$this->recur($object->children, $parent);
		}
	}
}
