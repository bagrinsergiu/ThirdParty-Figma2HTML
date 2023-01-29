<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function frameType( $object ) { 
    
    if ( isset($object->layoutMode) && $object->layoutMode == 'NONE' ) 
        return 'FRAMENONELAYOUT';
        
    else 
        return 'FRAMEAUTOLAYOUT';
}

function frameStyle( $object, $meta ) {

    // Style 
    $style = '';

    // Position
    $style .= position( $object, $meta );

    // Flex
    $style .= flex( $object );

    // Top
    $style .= top( $object, $meta );

    // Left
    $style .= left( $object, $meta );
    
    // Width
    $style .= width( $object );

    // Height
    $style .= height( $object, $meta );

    // Padding 
    $style .= padding( $object );

    // Border Radius 
    $style .= borderRadius( $object );

    // Background Color
    $style .= backgroundColor( $object );

    // Border
    $style .= border( $object );

    return $style;   
}

function frameStart( $object, $meta ) { 

    $slug = slug($object->name);
    $type = frameType( $object );

    return '<div class="' . $slug . '" ' . tagData( $object, $meta, $type ) . '>';
}

function frameEnd( $object ) { 

    return '</div>';
}
