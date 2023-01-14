<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function builderioParcer($url, $width) {

    $json = file_get_contents(APPPATH . '/assets/' . urlencode($url) . '.json');
    if ( !$json ) {
        // Load JSON File
        $json = file_get_contents("https://builder.io/api/v1/url-to-figma?url=${url}&width=${width}px");

        file_put_contents(APPPATH . '/assets/' . urlencode($url) . '.json', $json);
    }

    return $json;
}

function builderioLayerBuild($layerObject, $parent, $xx, $yy) {

    $layerLimit = [
        'type',
        'width',
        'height',
        'x',
        'y',
        'topLeftRadius',
        'topRightRadius',
        'bottomRightRadius',
        'bottomLeftRadius',
        'name',
        'strokeWeight',
        'svg',
        'characters',
        'lineHeight',
        'fontSize',
        'fontFamily',
        'textAlignHorizontal',
        'letterSpacing',
        'textCase'
    ];

    $layerIgnore = [
        'children',
        'data',
        'constraints',
        'fills',
        'effects',
        'strokes',
        'clipsContent',
        'backgrounds',
        'fontStyle',
        'backgroundColor',
        'padding',
        'fontWeight',
        'color',
        'nodeName'
    ];

    $layer['parent'] = $parent;
    $layer['xx'] = $xx + $layerObject->x;
    $layer['yy'] = $yy + $layerObject->y;
    foreach ( $layerObject as $key => $value ) {
	
        if ( in_array( $key, $layerLimit ) ) {

            if ( is_string( $value ) )
                $layer[$key] = $value;
    
            elseif ( is_object( $value ) )
                $layer[$key] = serialize($value);
    
            elseif ( is_integer( $value ) )
                $layer[$key] = $value;
    
            elseif ( is_bool( $value ) )
                $layer[$key] = $value;
    
            elseif ( is_double( $value ) )
                $layer[$key] = $value;
    
            else {
                echo gettype($value);
                echo '<br><br>--------111----';
                echo $key;
                echo '<br><br>--------111----';
                print_r($value);
                die();
            }
    
        } elseif ( !in_array( $key, $layerIgnore ) ) {
            echo $key;
            echo '<br><br>--------222----';
            print_r($value);
            die();
        }
    }

    return $layer;
}