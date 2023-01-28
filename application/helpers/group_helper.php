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

function groupImageStyle( $object, $parentLayerType, $meta ) {
    
    // Slug
    $slug = slug($object->name);

    // Style
    $style = '';

    // Position
    $style .= position( $object, $parentLayerType );

    /* ?????
    $style .= 'width: ' . $object->width . 'px;';
    $style .= 'height: ' . $object->height . 'px;';
    $style .= 'left: ' . $object->x . 'px;';
    $style .= 'top: ' . $object->y . 'px;';
    */

    // Top
    $style .= top( $object, $meta );

    // Left
    $style .= left( $object, $meta );
    
    // Width
    $style .= width( $object );

    // Height
    $style .= height( $object, $parentLayerType );

    $css = new stdClass();
    $css->$slug = $style;

    return $css;   
}

function groupImageStart($object, $meta) {
    
    $slug = slug($object->name);
    $type = groupType( $object );

    return '<img class="mask-group" ' . tagData( $object, $meta, $type ) . '>';
}

function groupImageEnd($object) { 

    return '';
}
