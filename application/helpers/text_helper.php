<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function textStart($object) {
    
    $slug = slug($object->name);

    $style = '';
    $style .= 'position: absolute;';
    $style .= 'width: ' . $object->width . 'px;';
    $style .= 'height: auto;';
    $style .= 'left: ' . $object->x . 'px;';
    $style .= 'top: ' . $object->y . 'px;';
    $style .= 'text-align: ' . strtolower($object->textAlignHorizontal) . ';';

    // Font Size
    if ( $object->fontSize == 'Mixed' ) 
        $style .= 'font-size: ' . $object->fontSize . 'px;';
    elseif ( is_numeric($object->fontSize) )
        $style .= 'font-size: ' . $object->fontSize . 'px;';

    // Font Weight 
    $style .= 'font-weight: ' . $object->fontWeight . ';';

    // Line Height 
    if ( is_object($object->lineHeight) )
        if ( $object->lineHeight->unit == 'AUTO' ) 
            $style .= 'line-height: normal;';

    // Fills
    if ( is_array($object->fills) ) {
        foreach ( $object->fills as $fill ) {
            if ( $fill->type == 'SOLID' )
                $style .= 'color: ' . rgb2hex($fill->color->r, $fill->color->g, $fill->color->b ) . ';';
        }
    }
  
    // Letter Spacing 
    if ( is_object($object->letterSpacing) )
        if ( $object->letterSpacing->unit == 'PERCENT' && is_numeric($object->fontSize) ) 
            $style .= 'letter-spacing: ' . ( $object->fontSize * $object->letterSpacing->value / 100 ) . 'px;';

    echo '<style>.' . $slug . '{' . $style . '}</style>';
    echo '<p class="' . $slug . '">' . $object->characters . '</p>';
}

function textEnd($object) { 

    echo '';
}
