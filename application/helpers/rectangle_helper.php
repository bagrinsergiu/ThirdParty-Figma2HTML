<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function rectangleType( $object ) { 
    
    return 'RECTANGLE';
}

function rectangleStyle( $object, $meta ) {

    // Style
    $style = '';

    // Position
    $style .= position( $object, $meta );

    // Top
    $style .= top( $object, $meta );

    // Left
    $style .= left( $object, $meta );
    
    // Width
    $style .= width( $object );

    // Height
    $style .= height( $object, $meta );

    // Border Radius 
    $style .= borderRadius( $object );

    // Background Color
    $style .= backgroundColor( $object );

    return $style;   
}

function rectangleStart( $object, $meta ) {

    $type = rectangleType( $object );

    return '<div class="' . $meta['LAYERSLUG'] . '" ' . tagData( $object, $meta, $type ) . '>';
}

function rectangleEnd( $object ) {

    return '</div>';
}
