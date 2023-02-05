<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function cssInline( string $slug, string $css ) : string {

    return '.' . $slug . '{' . $css . '}';
}

function cssOutput( array $array, array $globals ) : string {
    
    $css = '';
    $css .= implode(' ', array_reverse(denormalizeTree($array, 'css')));

    // Replace Global Values in Returned CSS 
    $fonts = array_map(function($value) {
        return "---globalFontFamily--" . slug($value) . '---';
    }, array_values($globals['fonts']));

    $fontSizes = array_map(function($value) {
        return "---globalFontSize--" . $value . '---';
    }, array_values($globals['fontSizes']));

    $colors = array_map(function($value) {
        return "---globalColor--" . $value . '---';
    }, array_values($globals['colors']));

    // Array containing search string
    $search = array_merge($fonts, $fontSizes, $colors);

    // Array containing replace string from  search string
    $replace = array_merge(array_keys($globals['fonts']), array_keys($globals['fontSizes']), array_keys($globals['colors']));

    // Function to replace string
    $result = str_replace($search, $replace, $css);

    return $result;
}
