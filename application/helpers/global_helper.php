<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function fonts(array $array) : array {

    return array_unique(cleanEmpty(denormalizeTree($array, 'fontFamily')));
}

function fontSizes(array $array) : array {

    return array_unique(cleanEmpty(denormalizeTree($array, 'fontSize')));
}
