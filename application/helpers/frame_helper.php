<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function frameType($object) { 
    
    if ( isset($object->layoutMode) && $object->layoutMode == 'NONE' ) 
        return 'FRAMENONELAYOUT';
    else 
        return 'FRAMEAUTOLAYOUT';
}

function frameStart($object, $meta) { 

    $slug = slug($object->name);
    $type = frameType( $object );

    // Style 
    $style = '';

    if ( $object->layoutMode != 'NONE' ) 
        $style .= 'position: absolute;';
    else
        $style .= 'position: relative;';
    
    $style .= 'width:' . $object->width . 'px;';
    $style .= 'height:' . $object->height . 'px;';
    
    if ( !$meta['FIRSTLAYER'] ) {
        $style .= 'left: ' . ( $object->x - $meta['x'][$object->parent->id] ) . 'px;';
        $style .= 'top: ' . ( $object->y - $meta['y'][$object->parent->id] ) . 'px;';
    }

    if ( $object->layoutMode != 'NONE' ) {
        $style .= 'display: flex;';
        if ( $object->layoutMode == 'VERTICAL' ) {
            $style .= 'align-items: flex-start;';
            $style .= 'flex-direction: column;';
        }
    }

    echo '<style>.' . $slug . '{' . $style . '}</style>';
    echo '<div class="' . $slug . '" ' . tagData( $object, $meta, $type ) . '>';
}

function frameEnd($object) { 

    echo '</div>';
}
