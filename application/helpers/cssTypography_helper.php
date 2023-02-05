<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function textAlign( $object ) { 

    // Text Align 
    $style = '';
    $style .= 'text-align: ' . strtolower($object->textAlignHorizontal) . ';';

    return $style;
}

function fontFamily( object $object ) : string { 

    // Init
    $style = '';

    // Font Family
    if ( figmaFontFamily($object) != '' ) 
        $style .= 'font-family: var(---globalFontFamily--' . slug($object->fontName->family) . '---);';

    return $style;
}

function lineHeight( $object ) { 

    // Line Height 
    $style = '';
    if ( is_object($object->lineHeight) )
        if ( $object->lineHeight->unit == 'AUTO' ) 
            $style .= 'line-height: normal;';

    return $style;
}

function fontWeight( $object ) { 

    // Line Height 
    $style = '';
    $style .= 'font-weight: ' . $object->fontWeight . ';';

    return $style;
}

function fontSize( object $object ) : string { 

    // Init
    $style = '';

    // Line Height 
    // TOdo.. trebuei sa scriu o verficare aici daca exista asa props in figma ca poate nu exista 
    $style .= 'font-size: var(---globalFontSize--' . figmaFontSize($object) . '---);';

    return $style;
}

function letterSpacing( $object ) { 

    // Line Height 
    $style = '';
    if ( is_object($object->letterSpacing) )
        if ( $object->letterSpacing->unit == 'PERCENT' && is_numeric($object->fontSize) ) 
            $style .= 'letter-spacing: ' . ( $object->fontSize * $object->letterSpacing->value / 100 ) . 'px;';

    return $style;
}
