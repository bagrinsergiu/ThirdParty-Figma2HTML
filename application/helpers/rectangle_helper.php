<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function rectangleType( $object ) { 
    
    return 'RECTANGLE';
}

function rectangleStyle( $object, $parentLayerType, $meta ) {

    // Slug
    $slug = slug( $object->name );

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

    $css = new stdClass();
    $css->$slug = $style;

    return $css;   
}

function rectangleStart( $object, $meta ) {

    $slug = slug( $object->name );
    $type = rectangleType( $object );

    return '<div class="' . $slug . '" ' . tagData( $object, $meta, $type ) . '>';
}

function rectangleEnd( $object ) {

    return '</div>';
}
