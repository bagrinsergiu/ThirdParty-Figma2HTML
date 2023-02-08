<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function figmaBorder( object $object ) : array { 

    // Init
    $return = array();

    // Border Color
    $return['width'] = figmaBorderWidth($object);
    $return['align'] = figmaBorderAlign($object);
    $return['styles'] = array();

    if ( isset($object->strokes) ) 
        foreach ( $object->strokes as $stroke ) 
            if ( $stroke->type == 'SOLID' ) 
                $return['styles'][][strtolower($stroke->type)] = figmaBorderSolid($stroke);

    return $return;
}

function figmaBorderSolid( object $object ) : array { 

    // Init
    $return = array();

    // Border Visible
    if ( isset($object->visible) )
        $return['visible'] = $object->visible; 

    // Border Opacity
    if ( isset($object->opacity) )
        $return['opacity'] = $object->opacity; 

    // Border BlendMode
    if ( isset($object->blendMode) )
        $return['blendMode'] = $object->blendMode; 

    // Border Color
    if ( isset($object->color) && 
        isset($object->color->r) && 
        isset($object->color->g) && 
        isset($object->color->b) 
    )
        $return['color'] = rgb2hex($object->color->r, $object->color->g, $object->color->b); 
                
    return $return;
}

function figmaBorderWidth( object $object ) : array { 

    // Init
    $return = array();

    // Border Color
    if ( isset($object->strokeWeight) && 
        isset($object->strokeTopWeight) && 
        isset($object->strokeBottomWeight) &&
        isset($object->strokeLeftWeight) && 
        isset($object->strokeRightWeight)
    ) {
        if ( $object->strokeWeight == 'Mixed' ) {

            $return['type'] = 'custom';
            $return['top'] = $object->strokeTopWeight;
            $return['bottom'] = $object->strokeBottomWeight;
            $return['left'] = $object->strokeLeftWeight;
            $return['right'] = $object->strokeRightWeight;
        }
        else {

            $return['type'] = 'all';
            $return['width'] = $object->topLeftRadius;
        }
    }
    
    return $return;
}

function figmaBorderAlign( object $object ) : string { 

    // Init
    $return = '';

    // Border Color
    if ( isset($object->strokeAlign) )
        $return = $object->strokeAlign; 
    
    return $return;
}