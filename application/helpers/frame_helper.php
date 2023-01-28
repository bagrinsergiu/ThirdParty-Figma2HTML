<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function frameType( $object ) { 
    
    if ( isset($object->layoutMode) && $object->layoutMode == 'NONE' ) 
        return 'FRAMENONELAYOUT';
    else 
        return 'FRAMEAUTOLAYOUT';
}

function frameStyle( $object, $parentLayerType, $meta ) {

    // Slug
    $slug = slug($object->name);

    // Style 
    $style = '';

    // Position
    $style .= position( $object, $parentLayerType );

    // Flex
    $style .= flex( $object );

    // Top
    $style .= top( $object, $meta );

    // Left
    $style .= left( $object, $meta );
    
    // Width
    $style .= width( $object );

    // Height
    $style .= height( $object, $parentLayerType );

    // Padding 
    $style .= padding( $object );

    // Border Radius 
    $style .= borderRadius( $object );

    // Background Color
    $style .= backgroundColor( $object );

    // Border
    $style .= border( $object );

    $css = new stdClass();
    $css->$slug = $style;

    return $css;   
}

function frameStart( $object, $meta ) { 

    $slug = slug($object->name);
    $type = frameType( $object );

    return '<div class="' . $slug . '" ' . tagData( $object, $meta, $type ) . '>';
}

function frameEnd( $object ) { 

    return '</div>';
}
