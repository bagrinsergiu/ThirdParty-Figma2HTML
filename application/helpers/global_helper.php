<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function globals(array $array) : array {

    // Return
    $return = array(
        'fonts' => array(),
        'fontSizes' => array(),
        'colors' => array()
    );

    // Data
    $fonts = globalFonts($array);
    $fontSizes = globalFontSizes($array);
    $colors = globalColors($array);

    // Global
    $return['fonts'] = $fonts;
    $return['fontSizes'] = $fontSizes;
    $return['colors'] = $colors;

    return $return;
}

function globalFonts(array $array) : array {

    // Return
    $return = array();

    // Fonts
    $fonts = array_values(array_unique(cleanEmpty(denormalizeTree($array, 'fontFamily'))));
    if ( count($fonts) > 0 ) 
        foreach ($fonts as $font) 
            $return['--font-family-' . slug($font)] = $font;

    return $return;
}

function globalFontSizes(array $array) : array {

    // Return
    $return = array();

    // Data
    $sizes = array('xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', '4xl', '5xl', '6xl', '7xl', '8xl', '9xl', '10xl', '11xl', '12xl', '13xl', '14xl', '15xl', '16xl', '17xl', '18xl', '19xl', '20xl', '21xl', '22xl', '23xl', '24xl', '25xl', '26xl', '27xl', '28xl', '29xl', '30xl');

    // Font Sizes
    $fontSizes = array_values(array_unique(cleanEmpty(denormalizeTree($array, 'fontSize'))));
    sort($fontSizes);
    if ( count($fontSizes) > 0 ) 
        foreach ($fontSizes as $key => $fontSize) 
            if ( $key < 30 )
                $return['--font-size-' . $sizes[$key]] = $fontSize;
            else 
                console("EEEE", "kkkkkk");

    return $return;
}

function globalColors(array $array) : array {

    // Convertor
    $instance = new ColorInterpreter();

    // Return
    $return = array();

     // Fonts
     $colors = array_values(array_unique(cleanEmpty(denormalizeTree($array, 'color'))));
     if ( count($colors) > 0 ) 
         foreach ($colors as $color) 
             $return['--' . slug($instance->name($color)['name'])] = $color;
 
     return $return;
}

// Global CSS Variables Output
function globalsVariables(array $globals) : string {

    $css = ':root {';

    // Fonts
    // TODO.. aici e pus Halvetica dar trebuei de vazut de ce asa aici poate sa fie orice 
    $fonts = $globals['fonts'];
    foreach ($fonts as $fey => $font) 
        $css .=  $fey .': "' . $font . '", Helvetica;';

    // Font Sizes
    $fontSizes = $globals['fontSizes'];
    foreach ($fontSizes as $sey => $fontSize) 
        $css .=  $sey .': ' . $fontSize . 'px;';

    // Colors
    $colors = $globals['colors'];
    foreach ($colors as $cey => $color) 
        $css .=  $cey .': ' . $color . ';';

    $css .= '}';

    return $css;
}