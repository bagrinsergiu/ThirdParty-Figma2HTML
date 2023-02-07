<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function position( $object, $meta ) { 

    // Flex 
    $style = '';
    if ( $object->type == 'FRAME' || $object->type == 'TEXT' )
        if ( $meta['PARENTLAYER'] == 'FRAMEAUTOLAYOUT' ) 
            $style .= 'position: relative;';
        else
            $style .= 'position: absolute;';
    
    else
        $style .= 'position: absolute;';

    return $style;
}

function flex( $object ) { 

    // Flex 
    $style = '';
    if ( $object->layoutMode != 'NONE' ) {
        $style .= 'display: flex;';

        if ( $object->layoutMode == 'VERTICAL' ) {

            $style .= 'align-items: flex-start;';
            $style .= 'flex-direction: column;';
        }
        elseif ( $object->layoutMode == 'HORIZONTAL' ) {
         
            if ( $object->counterAxisAlignItems == 'CENTER' ) 
                $style .= 'align-items: center;';

            if ( $object->primaryAxisAlignItems == 'CENTER' ) 
                $style .= 'justify-content: center;';
        }
    }

    return $style;
}
