<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function textAlign( $object ) { 

    // Text Align 
    $style = '';
    $style .= 'text-align: ' . strtolower($object->textAlignHorizontal) . ';';

    return $style;
}

function fontFamily( $object ) { 

    // Font Family
    $style = '';
    if ( isset($object->fontName) && is_object($object->fontName) ) {
        echo '@import url("https://fonts.googleapis.com/css?family=Inter:400,700,600");';

        $style .= 'font-family: "' . $object->fontName->family . '", Helvetica;';
    }

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

function fontSize( $object ) { 

    // Line Height 
    $style = '';
    if ( $object->fontSize == 'Mixed' ) 
        $style .= 'font-size: ' . $object->fontSize . 'px;';
    elseif ( is_numeric($object->fontSize) )
        $style .= 'font-size: ' . $object->fontSize . 'px;';

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
