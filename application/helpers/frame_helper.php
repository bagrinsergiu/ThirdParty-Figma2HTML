<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function frameType( $object ) { 
    
    if ( isset($object->layoutMode) && $object->layoutMode == 'NONE' ) 
        return 'FRAMENONELAYOUT';
    else 
        return 'FRAMEAUTOLAYOUT';
}

function frameStart( $object, $parentLayerType, $meta ) { 

    $slug = slug($object->name);
    $type = frameType( $object );

    // Style 
    $style = '';

    // Position
    $style .= position( $object, $parentLayerType );

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

    // Flex
    $style .= flex( $object );

    // Background Color
    $style .= backgroundColor( $object );

    // Border
    $style .= border( $object );

    echo '<style>.' . $slug . '{' . $style . '}</style>';
    echo '<div class="' . $slug . '" ' . tagData( $object, $meta, $type ) . '>';
}

function frameEnd( $object ) { 

    echo '</div>';
}
