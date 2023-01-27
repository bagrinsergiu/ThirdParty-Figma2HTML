<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function padding( $object ) { 
    
    // Padding 
    $style = '';
    if ( isset($object->paddingTop) && 
       isset($object->paddingBottom) &&
       isset($object->paddingRight) && 
       isset($object->paddingLeft) 
   ) {
       if (  $object->paddingTop == $object->paddingBottom && 
           $object->paddingBottom == $object->paddingLeft && 
           $object->paddingLeft == $object->paddingRight 
       )
           $style .= 'padding:' . $object->paddingTop . 'px;';
       
       elseif (  $object->paddingTop == $object->paddingBottom &&             
           $object->paddingLeft == $object->paddingRight && 
           $object->paddingTop != $object->paddingLeft 
       )
           $style .= 'padding:' . $object->paddingTop . 'px ' . $object->paddingLeft . 'px;';
       
       else 
           $style .= 'padding:' . $object->paddingTop . 'px ' . $object->paddingRight . 'px ' . $object->paddingBottom . 'px ' . $object->paddingLeft . 'px;';
   }

   return $style;
}
