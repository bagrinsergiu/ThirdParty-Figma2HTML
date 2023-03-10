<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function width( $object ) { 

    // Width 
    $style = '';
    if ( $object->type == 'TEXT' ) 
        $style .= 'width: fit-content;';
    
    else
        $style .= 'width:' . $object->width . 'px;';

    return $style;
}

function height( $object ) { 

    // Height 
    $style = '';

    $layerType = layerType( $object );
    if ( $layerType == 'FRAMEAUTOLAYOUT' )
        $style .= 'height: auto;';
    
    else
        $style .= 'height:' . $object->height . 'px;';

    return $style;
}

function top( $object, $meta ) { 

    // Init 
    $style = '';

    // Values
    $top = figmaTop($object);

    // Top
    if ( !$meta['FIRSTLAYER'] && $meta['PARENTLAYER'] != 'FRAMEAUTOLAYOUT' ) 
        $style .= 'top: ' . ( $top - $meta['y'][$object->parent->id] ) . 'px;';

    return $style;
}

function left( $object, $meta ) { 

    // Left
    $style = '';
    if ( !$meta['FIRSTLAYER'] && $meta['PARENTLAYER'] != 'FRAMEAUTOLAYOUT' ) 
        $style .= 'left: ' . ( $object->x - $meta['x'][$object->parent->id] ) . 'px;';

    return $style;
}
