<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// TODO.. Aici trebuei de adaug return type la tipizare
function htmlOutput( array $array ) {

    foreach ( $array as $object ) {

        if ( is_object($object) ) 
            echo $object->htmlStart;
            
        if ( isset($object->child) ) 
            htmlOutput($object->child);

        if ( is_object($object) ) 
            echo $object->htmlEnd;
    }
}
