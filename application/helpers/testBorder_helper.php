<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function figmaBorder( object $object ) : array { 

    // Init
    $i = 0;
    $return = array();

    // Border Color
    $return['width'] = figmaBorderWidth($object);
    $return['align'] = figmaBorderAlign($object);
    $return['styles'] = array();

    if ( isset($object->strokes) ) 
        foreach ( $object->strokes as $stroke ) 
            if ( $stroke->type == 'SOLID' ) {
                
                $return['styles'][$i]['solid']['visible'] = figmaBorderVisible($stroke);
                $return['styles'][$i]['solid']['opacity'] = figmaBorderOpacity($stroke);
                $return['styles'][$i]['solid']['blendMode'] = figmaBorderBlendMode($stroke);
                $return['styles'][$i]['solid']['color'] = figmaBorderColor($stroke);

                $i++;
            }
                        

    return $return;
}

function figmaBorderVisible( object $object ) : bool { 

    // Init
    $return = array();

    // Border Visible
    if ( isset($object->visible) )
        $return = $object->visible; 

    return $return;
}

function figmaBorderOpacity( object $object ) : int { 

    // Init
    $return = array();

    // Border Opacity
    if ( isset($object->opacity) )
        $return = $object->opacity; 
                
    return $return;
}

function figmaBorderBlendMode( object $object ) : string { 

    // Init
    $return = array();

    // Border BlendMode
    if ( isset($object->blendMode) )
        $return = $object->blendMode; 

    return $return;
}

function figmaBorderColor( object $object ) : string { 

    // Init
    $return = array();

    // Border Color
    if ( isset($object->color) && 
        isset($object->color->r) && 
        isset($object->color->g) && 
        isset($object->color->b) 
    )
        $return = rgb2hex($object->color->r, $object->color->g, $object->color->b); 
                
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