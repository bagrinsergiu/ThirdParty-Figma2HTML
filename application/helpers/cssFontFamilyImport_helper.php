<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function fontFamilyStyleImport( object $object ): string {

    if ( isset($object->fontName) && is_object($object->fontName) )
        return $object->fontName->style;
    
    else    
        return '';
}

function fontFamilyStyleImportOutput( array $array ) {

    // IMportram in pagina fonturile de pe google unice 
    $import = '';
    foreach ( $fonts as $font ) 
        $import .= '@import url("https://fonts.googleapis.com/css?family=' . $font . ':400,700,600");';

    return $import;
}

function fontFamilyImport( array $globals ) : string {

    // IMportram in pagina fonturile de pe google unice 
    $import = '';
    foreach ( $globals['fonts'] as $font ) 
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
