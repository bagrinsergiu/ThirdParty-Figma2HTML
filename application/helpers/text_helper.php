<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function textType( $object ) { 
    
    return 'TEXT';
}

function textStart($object, $meta) {
    
    $slug = slug($object->name);
    $type = textType( $object );

    // Style 
    $style = '';

    if ( $meta['FRAME'] == 'FRAMEAUTOLAYOUT' )
        $style .= 'position: relative;';    
    else
        $style .= 'position: absolute;';
    
    $style .= 'width: ' . $object->width . 'px;';
    $style .= 'height: auto;';

    if ( $meta['FRAME'] == 'FRAMEAUTOLAYOUT' ) 
    {}
    else {
        $style .= 'left: ' . ( $object->x - $meta['x'][$object->parent->id] ) . 'px;';
        $style .= 'top: ' . ( $object->y - $meta['y'][$object->parent->id] ) . 'px;';
    }

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
    echo '<p class="' . $slug . '" ' . tagData( $object, $meta, $type ) . '>' . $object->characters . '</p>';
}

function textEnd($object) { 

    echo '';
}
