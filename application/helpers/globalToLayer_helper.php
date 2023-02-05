<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function globalToLayerFontFamily( object $object ): string {

    return figmaFontFamily($object);
}

function globalToLayerFontSize( object $object ): string {

    return figmaFontSize($object);
}

function globalToLayerColor( object $object ): string {

    return figmaColor($object);
}