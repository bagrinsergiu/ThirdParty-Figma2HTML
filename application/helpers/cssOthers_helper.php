<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function cssInline( $slug, $css ) {

    return '.' . $slug . '{' . $css . '}';
}

function cssOutput(array $array) : array {
    
    return denormalizeTree($array, 'css');
}

function cssVariables(array $array) : string {

    $css = ':root {';

    // Fonts
    // TODO.. aici e pus Halvetica dar trebuei de vazut de ce asa aici poate sa fie orice 
    $fonts = fonts($array);
    foreach ($fonts as $font) 
        $css .= '--font-family-' . slug($font) . ': "' . $font . '", Helvetica;';

    // Font Sizes
    $sizes = array('xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl');
    $fontSizes = fontSizes($array);
    foreach ($fontSizes as $key => $size) {

        if ( $key < 6 )
            $css .= '--font-size-' . $sizes[$key] . ': ' . $size . 'px;';
        
        else 
            echo '????????????';
    }

    $css .= '}';

    return $css;
}

function htmlOutput( $array ) {

    foreach ( $array as $object ) {

        if ( is_object($object) ) 
            echo $object->htmlStart;
            
        if ( isset($object->child) ) 
            htmlOutput($object->child);

        if ( is_object($object) ) 
            echo $object->htmlEnd;
    }
}
