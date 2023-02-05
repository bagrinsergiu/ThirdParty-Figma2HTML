<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function figmaFontFamily( object $object ) : string { 

    // Init
    $return = '';

    // Font Family
    if ( isset($object->fontName) && is_object($object->fontName) ) 
        $return = $object->fontName->family;

    return $return;
}

function figmaFontSize( object $object ) : int { 

    // Init
    $return = 0;

    // Font Size
    if ( isset($object->fontSize) && is_numeric($object->fontSize) )
        $return = $object->fontSize;

    return $return;
}
