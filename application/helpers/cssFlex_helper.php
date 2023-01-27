<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function position( $object, $parentLayerType ) { 

    // Flex 
    $style = '';
    if ( $object->type == 'FRAME' )
        if ( $object->layoutMode != 'NONE' ) 
            $style .= 'position: absolute;';
        else
            $style .= 'position: relative;';
    
    elseif ( $object->type == 'TEXT' )
        if ( $parentLayerType == 'FRAMEAUTOLAYOUT' ) 
            $style .= 'position: relative;';
        else
            $style .= 'position: absolute;';

    return $style;
}

function flex( $object ) { 

    // Flex 
    $style = '';
    if ( $object->layoutMode != 'NONE' ) {
        $style .= 'display: flex;';
        $style .= 'align-items: flex-start;';

        if ( $object->layoutMode == 'VERTICAL' ) 
            $style .= 'flex-direction: column;';
        
        elseif ( $object->layoutMode == 'HORIZONTAL' ) 
            if ( $object->primaryAxisAlignItems == 'CENTER' ) 
                $style .= 'justify-content: center;';
         
    }

    return $style;
}
