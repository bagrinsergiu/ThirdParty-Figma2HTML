<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function frameStart($object) { 

    $slug = slug($object->name);

    $style = '';
    $style .= 'position:relative;';
    $style .= 'width:' . $object->width . 'px;';
    $style .= 'height:' . $object->height . 'px;';

    echo '<style>.' . $slug . '{' . $style . '}</style>';
    echo '<div class="' . $slug . '" data-id="' . $object->id . '">';
}

function frameEnd($object) { 

    echo '</div>';
}
