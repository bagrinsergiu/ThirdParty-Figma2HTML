<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function blendMode( $object ) { 

    // Text Align 
    $style = '';

    if ( $object->blendMode == 'PASS_THROUGH' )
        $style .= 'mix-blend-mode: normal;';

    return $style;
}
