<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function rectangleStart($object) {

    $slug = slug($object->name);

    $style = '';
    $style .= 'position: absolute;';
    $style .= 'width:' . $object->width . 'px;';
    $style .= 'height:' . $object->height . 'px;';
    $style .= 'left:' . $object->x . 'px;';
    $style .= 'top:' . $object->y . 'px;';

    echo '<style>.' . $slug . '{' . $style . '}</style>';
    echo '<div class="' . $slug . '" data-id="' . $object->id . '">';
}

function rectangleEnd($object) {

    echo '</div>';
}
