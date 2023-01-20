<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function console($str1, $str2 = '') {

    echo gettype($str2);
    echo '<br><br>----111----';
    echo $str1;
    echo '<br><br>----111----';
    print_r($str2);
    die();
} 
