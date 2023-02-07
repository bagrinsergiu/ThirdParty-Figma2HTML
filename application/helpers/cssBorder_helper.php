<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function borderRadius( $object ) { 
    
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
