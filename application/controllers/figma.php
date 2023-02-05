<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Figma extends CI_Controller {

	public function __construct()
	{
		/* Call CodeIgniter's default Constructor */
		parent::__construct();

		// Globals
		$this->load->helper('global');

		// Layers
		$this->load->helper('frame');
		$this->load->helper('group');
		$this->load->helper('rectangle');
		$this->load->helper('component');
		$this->load->helper('vector');
		$this->load->helper('text');
		$this->load->helper('globalToLayer');
		
		// Helpers
		$this->load->helper('figma');
		$this->load->helper('tagData');
		$this->load->helper('str');
		$this->load->helper('color');
		$this->load->helper('layer');
		
		// CSS 
		$this->load->helper('cssFontFamilyImport');
		$this->load->helper('cssFlex');
		$this->load->helper('cssSizes');
		$this->load->helper('cssSpaces');
		$this->load->helper('cssBorder');
		$this->load->helper('cssTypography');
		$this->load->helper('cssColor');
		$this->load->helper('cssOthers');

		// Console
		$this->load->helper('console');
	}

	public function import()
	{
		// Load JSON File
		$json = file_get_contents(APPPATH . '/assets/001.json');

		// JSON Decode
		$array = json_decode($json);

		// Echo Body Style
		echo "<style>html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}</style>";

		// Return 
		$layers = layer($array);

		// Generate CSS Variables 
		echo '<style>' . cssVariables( $layers ) . '</style>';

		// Import Fonts
		echo '<style>' . fontFamilyImportOutput( $layers ) . '</style>';

		// CSS
		echo '<style>' . implode(' ', array_reverse(cssOutput( $layers ))) . '</style>';

		// HTML 
		htmlOutput( $layers );
	}
}
