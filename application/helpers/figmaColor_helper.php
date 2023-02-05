<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function figmaColor( object $object ) : string { 

    // Init
    $return = '';

    // Color
    if ( isset($object->fills) && is_array($object->fills) ) 
        foreach ( $object->fills as $fill ) 
            if ( $fill->type == 'SOLID' )
                $return = rgb2hex($fill->color->r, $fill->color->g, $fill->color->b);

    return $return;
}