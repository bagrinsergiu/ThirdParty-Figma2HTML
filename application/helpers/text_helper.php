<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function textType( $object ) { 
    
    return 'TEXT';
}

function textStyle($object, $meta) {
    
    // Style 
    $style = '';

    // Position
    $style .= position( $object, $meta );
    
    // Width 
    $style .= width( $object );

    // Height
    $style .= 'height: auto;';

    if ( $meta['PARENTLAYER'] == 'FRAMEAUTOLAYOUT' ) 
    {}
    else {
        $style .= 'left: ' . ( $object->x - $meta['x'][$object->parent->id] ) . 'px;';
        $style .= 'top: ' . ( $object->y - $meta['y'][$object->parent->id] ) . 'px;';
    }

    // Text Align
    $style .= textAlign( $object );

    // Font Family
    $style .= fontFamily( $object );

    // Font Size
    $style .= fontSize( $object );

    // Font Weight 
    $style .= fontWeight( $object );

    // Line Height 
    $style .= lineHeight( $object );

    // Letter Spacing 
    $style .= letterSpacing( $object );

    // Blend mode
    $style .= blendMode( $object );
    
    // Color
    $style .= color( $object );

    return $style;   
}


function textStart($object, $meta) {
    
    $slug = slug($object->name);
    $type = textType( $object );

    return '<p class="' . $slug . '" ' . tagData( $object, $meta, $type ) . '>' . $object->characters . '</p>';
}

function textEnd($object) { 

    return '';
}
