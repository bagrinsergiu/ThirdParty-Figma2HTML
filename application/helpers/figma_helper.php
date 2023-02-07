<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function figmaFile() {

    // Load JSON File
    return file_get_contents(APPPATH . '/assets/002.json');
}

function figmaFile2Array( $json ) {

   // JSON Decode
   return  json_decode($json);
}
