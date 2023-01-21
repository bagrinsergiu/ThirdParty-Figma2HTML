<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function tagData( $object, $meta, $type ) {

    $data = array(
        'data-type="' . $type . '"',
        'data-parent="' . $object->parent->id . '"',
        'data-parent-x="' . ( $meta['FIRSTLAYER'] ? 0 : $meta['x'][$object->parent->id] ) . '"',
        'data-parent-y="' . ( $meta['FIRSTLAYER'] ? 0 :  $meta['y'][$object->parent->id] ) . '"',
        'data-id="' . $object->id . '"',
        'data-x="' . ( $meta['FIRSTLAYER'] ? 0 : $object->x ) . '"',
        'data-y="' . ( $meta['FIRSTLAYER'] ? 0 : $object->y ) . '"'
        );

    return implode(' ', $data);
} 