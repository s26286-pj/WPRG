<?php
function getCensoredString($input) {
    $returned = $input;
    $dictionary = array("kurka", "piórkuje");
    foreach ( $dictionary as &$word ) {
        $returned = str_replace( $word, str_repeat("*", strlen($word)) , $returned );
    }
    return $returned;
}

$text = $argv[1];

echo getCensoredString($text);