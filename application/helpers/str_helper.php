<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function slug($str, $delimiter = '-') {

    return substr(strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//IGNORE', $str))))), $delimiter)), 0, 20);
} 

function strType($key, $value) {

    if ( is_string($value) || is_integer($value) || is_bool($value) || is_double($value) || is_null($value) )
        return $value;

    elseif ( is_object($value) )
        return serialize($value);

    elseif ( is_array($value) ) 
        return arrayToType($key, $value);

    else 
        console($key, $value);
}

function arrayToType($key, $value) {

    $backgroundLimit = backgroundLimit();

    foreach ( $value as $kkey => $vvalue ) {
        foreach ( $vvalue as $kkkey => $vvvalue ) {
            if ( $key == 'backgrounds' && in_array( $kkkey, $backgroundLimit ) ) 
                return strType($vvvalue);
            
            else 
                console($key, $vvvalue);
        }
    }

}






/*

    // Salvam Type pentru mai tirziu
                if ( $kkkey == 'type' )	
                    $tttype = $vvvalue;

                if ( $tttype == 'SOLID' && $kkkey == 'color' ) 
                    $style .= 'background-color:' . rgb2hex($vvvalue->r * 100, $vvvalue->g * 100, $vvvalue->b * 100) . ';';

                if ( $tttype == 'SOLID' && $kkkey == 'blendMode' ) 
                    $style .= 'mix-blend-mode:' . strtolower($vvvalue) . ';';  


                    */