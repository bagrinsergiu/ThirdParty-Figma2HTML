<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function rgb2hex($r, $g, $b) {

    return $color = sprintf("#%02x%02x%02x", $r * 255, $g * 255, $b * 255); // #0d00ff
} 
