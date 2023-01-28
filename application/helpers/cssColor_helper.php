<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function color( $object ) { 

    // Color
    $style = '';
    if ( is_array($object->fills) ) 
        foreach ( $object->fills as $fill ) 
            if ( $fill->type == 'SOLID' )
                $style .= 'color: ' . rgb2hex($fill->color->r, $fill->color->g, $fill->color->b ) . ';';

    // Default Color 
    if ( $style == '' ) 
        $style .= 'color: #ffffff;'; 
        
    return $style;
}

function backgroundColor( $object ) { 

    // Background Color
    $style = '';
    if ( is_array($object->fills) ) 
        foreach ( $object->fills as $fill ) 
            if ( $fill->type == 'SOLID' )
                $style .= 'background-color: ' . rgb2hex($fill->color->r, $fill->color->g, $fill->color->b ) . ';';

    return $style;
}

function border( $object ) { 

    // Background Color
    $style = '';
    if ( is_array($object->strokes) ) 
        foreach ( $object->strokes as $stroke ) {

            if ( $stroke->type == 'SOLID' )
                $style .= 'border-color: ' . rgb2hex($stroke->color->r, $stroke->color->g, $stroke->color->b ) . ';';
            elseif ( $stroke->type == 'GRADIENT_LINEAR' ) {
                
                $style .= 'border: ' . $object->strokeWeight . 'px solid;'; 
                $style .= 'border-color: transparent;'; 

                $stops = array();
                foreach ( $stroke->gradientStops as $gradientStop ) {
                    $stops[] = rgb2hex($gradientStop->color->r, $gradientStop->color->g, $gradientStop->color->b);
                }

                $style .= 'border-image: linear-gradient(to bottom, ' . implode(', ', $stops) . ') 1;';
            }
        }
                
    return $style;
}