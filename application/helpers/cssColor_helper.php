<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function color( $object ) { 

    // Init
    $style = '';

    // Color
    $color = figmaColor($object);
    if ( $color != '' )
        $style .= 'color: var(---globalColor--' . $color . '---);';

    // Default Color TODo.. aici trebuei de vazut cum de dus in global culoarea asta 
    if ( $style == '' ) 
        $style .= 'color: #ffffff;'; 
        
    return $style;
}

function backgroundColor( $object ) { 

    // Init
    $style = '';

    // Background Color
    if ( isset($object->fills) ) 
        foreach ( $object->fills as $fill ) 
            if ( $fill->type == 'SOLID' )
                $style .= 'background-color: ' . rgb2hexa($fill->color->r, $fill->color->g, $fill->color->b, $fill->opacity) . ';';

    return $style;
}

function blendMode( $object ) { 

    // Text Align 
    $style = '';

    if ( $object->blendMode == 'PASS_THROUGH' )
        $style .= 'mix-blend-mode: normal;';

    return $style;
}
