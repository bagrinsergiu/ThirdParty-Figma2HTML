<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function globalToLayerFontFamily( object $object ): string {

    if ( isset($object->fontName) && is_object($object->fontName) )
        return $object->fontName->family;
    
    else
        return '';
}

function globalToLayerFontSize( object $object ): string {

    if ( isset($object->fontSize) && is_numeric($object->fontSize) )
        return $object->fontSize;
    
    else
        return '';
}