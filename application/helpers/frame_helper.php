<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function frameType($object) { 
    
    if ( isset($object->layoutMode) && $object->layoutMode == 'NONE' ) 
        return 'FRAMENONELAYOUT';
    else 
        return 'FRAMEAUTOLAYOUT';
}

function frameStart($object, $meta) { 

    $slug = slug($object->name);

    $style = '';

    if ( $object->layoutMode != 'NONE' ) 
        $style .= 'position: absolute;';
    else
        $style .= 'position: relative;';
    
    $style .= 'width:' . $object->width . 'px;';
    $style .= 'height:' . $object->height . 'px;';
    
    if ( !$meta['FIRSTFRAME'] ) {
        $style .= 'left: ' . ( $object->x - $meta['x'] ) . 'px;';
        $style .= 'top: ' . ( $object->y - $meta['y'] ) . 'px;';
    }

    if ( $object->layoutMode != 'NONE' ) {
        $style .= 'display: flex;';
        if ( $object->layoutMode == 'VERTICAL' ) {
            $style .= 'align-items: flex-start;';
            $style .= 'flex-direction: column;';
        }
    }

    echo '<style>.' . $slug . '{' . $style . '}</style>';
    echo '<div class="' . $slug . '" data-id="' . $object->id . '">';
}

function frameEnd($object) { 

    echo '</div>';
}
