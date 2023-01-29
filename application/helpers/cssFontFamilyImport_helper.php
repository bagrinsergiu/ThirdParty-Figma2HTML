<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function fontFamilyImport( object $object ): string {

    if ( isset($object->fontName) && is_object($object->fontName) )
        return $object->fontName->family;
    
    else
        return '';
}

function fontFamilyStyleImport( object $object ): string {

    if ( isset($object->fontName) && is_object($object->fontName) )
        return $object->fontName->style;
    
    else    
        return '';
}

function fontFamilyImportOutput( array $array, array $denormalizeTree = array()) {
    foreach ( $array as $object ) {

        if ( isset($object->child) ) 
            $denormalizeTree += cssOutput($object->child, $denormalizeTree);
        
        $denormalizeTree[] = $object->css;
    }

    return $denormalizeTree;
}

function fontFamilyOutput( object $object, string $fontFamily, array $fontFamilyWeight ): string { 

    // Font Family
    $import = '';
    if ( isset($object->fontName) && is_object($object->fontName) ) 
        $import .= '@import url("https://fonts.googleapis.com/css?family=Inter:400,700,600");';

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
