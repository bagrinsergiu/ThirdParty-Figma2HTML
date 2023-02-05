<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function fontFamilyStyleImport( object $object ): string {

    if ( isset($object->fontName) && is_object($object->fontName) )
        return $object->fontName->style;
    
    else    
        return '';
}

function fontFamilyStyleImportOutput( array $array ) {

    $arr = denormalizeTree($array, 'fontFamilyStyle');

    // Colectam toate Font Family Style unice si le eliminam pe cele duplicate
    $fonts = array();
    foreach ( $arr as $string ) 
        if ( $string != '' && !in_array($string, $fonts) )
            $fonts[] = $string;

    // IMportram in pagina fonturile de pe google unice 
    $import = '';
    foreach ( $fonts as $font ) 
        $import .= '@import url("https://fonts.googleapis.com/css?family=' . $font . ':400,700,600");';

    return $import;
}

function fontFamilyImportOutput( array $array ) {

    $arr = denormalizeTree($array, 'fontFamily');

    // Colectam toate Font Family unice si le eliminam pe cele duplicate
    $fonts = array();
    foreach ( $arr as $string ) 
        if ( $string != '' && !in_array($string, $fonts) )
            $fonts[] = $string;

    // IMportram in pagina fonturile de pe google unice 
    $import = '';
    foreach ( $fonts as $font ) 
        $import .= '@import url("https://fonts.googleapis.com/css?family=' . $font . ':400,700,600");';

    return $import;
}

// ToDo.. TRebuie de importat toate fonturile aici 
function googleFonts( string $key ): string {

    $array = [
        'Inter' => [
            400,
            600,
            700
        ],
    ];

    if ( !in_array($key, $array) ) 
        console($key, 'googleFonts');
}
