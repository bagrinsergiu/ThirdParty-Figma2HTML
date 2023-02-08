<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function border( object $object ) : string { 

    // Init
    $style = '';

    // Value
    $borders = figmaBorder($object); 

    if ( $object->id == '2:11' ) {

        print_r($borders);
        die();
    }

    // Border Color
    if ( isset($object->strokes) ) 
        foreach ( $object->strokes as $stroke ) {

            if ( $stroke->type == 'SOLID' ) 
                $style .= 'border: ' . $object->strokeWeight . 'px solid ' . rgb2hex($stroke->color->r, $stroke->color->g, $stroke->color->b) . ';';
                    
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

/*
function border( object $object ) : string { 

    // Init
    $style = '';

    // Border Color
    if ( isset($object->strokes) ) 
        foreach ( $object->strokes as $stroke ) {

            if ( $stroke->type == 'SOLID' ) 
                $style .= 'border: ' . $object->strokeWeight . 'px solid ' . rgb2hex($stroke->color->r, $stroke->color->g, $stroke->color->b) . ';';
                    
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
*/

function borderRadius( object $object ) : string { 
    
    // Border Radius 
    $style = '';
    if ( isset($object->topLeftRadius) && 
       isset($object->topRightRadius) &&
       isset($object->bottomLeftRadius) && 
       isset($object->bottomRightRadius)
    ) {
        if ( $object->topLeftRadius == $object->topRightRadius && 
            $object->topRightRadius == $object->bottomLeftRadius && 
            $object->bottomLeftRadius == $object->bottomRightRadius && 
            $object->topLeftRadius == 0
        )
            $style .= '';

        elseif ( $object->topLeftRadius == $object->topRightRadius && 
            $object->topRightRadius == $object->bottomLeftRadius && 
            $object->bottomLeftRadius == $object->bottomRightRadius
        )
            $style .= 'border-radius:' . $object->topLeftRadius . 'px;';

        else 
            $style .= 'border-radius:' . $object->topLeftRadius . 'px ' . $object->topRightRadius . 'px ' . $object->bottomLeftRadius . 'px ' . $object->bottomRightRadius . 'px;';
   }

   return $style;
}
