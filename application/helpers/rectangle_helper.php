<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function rectangleType( $object ) { 
    
    return 'RECTANGLE';
}

function rectangleStart( $object, $meta ) {

    $slug = slug( $object->name );
    $type = rectangleType( $object );

    // Style
    $style = '';
    $style .= 'position: absolute;';
    $style .= 'width:' . $object->width . 'px;';
    $style .= 'height:' . $object->height . 'px;';

    $style .= 'left: ' . ( $object->x - $meta['x'][$object->parent->id] ) . 'px;';
    $style .= 'top: ' . ( $object->y - $meta['y'][$object->parent->id] ) . 'px;';

    echo '<style>.' . $slug . '{' . $style . '}</style>';
    echo '<div class="' . $slug . '" ' . tagData( $object, $meta, $type ) . '>';
}

function rectangleEnd($object) {

    echo '</div>';
}
