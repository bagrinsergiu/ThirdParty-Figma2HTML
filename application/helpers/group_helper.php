<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function groupType($object) { 
    
    $types = array();
    if ( is_array($object->children) ) {
        foreach ( $object->children as $layer ) {
            if ( isset($layer->fills) ) {
                if ( is_array($layer->fills) ) 
                    foreach ( $layer->fills as $fill ) 
                        $types[] = $fill->type;
                else 
                    console('aaaaa', 'qqqqq');
            }
        }

        if ( in_array('IMAGE', $types) ) 
            return 'GROUPIMAGE';
        else 
            return 'RECTANGLE';
    }
    else 
        console('ccccc', 'eeee');
}

function groupImageStart($object, $meta) {
    
    $slug = slug($object->name);
    $type = groupType( $object );

    // Style
    $style = '';
    $style .= 'position: absolute;';
    $style .= 'width: ' . $object->width . 'px;';
    $style .= 'height: ' . $object->height . 'px;';
    $style .= 'left: ' . $object->x . 'px;';
    $style .= 'top: ' . $object->y . 'px;';

    echo '<style>.' . $slug . '{' . $style . '}</style>';
    echo '<img class="mask-group" ' . tagData( $object, $meta, $type ) . '>';
}

function groupImageEnd($object) { 

    echo '';
}
