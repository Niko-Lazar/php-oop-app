<?php

$placeHolders = '';

$values = [
    'a',
    'b',
    'c',
    'd',
];

$placeHolders = implode(',', array_map(fn() => $temp[] = "?", $values));

/*
for($i=0;$i<sizeof($values); $i++){
    $placeHolders .= '?';

    if($i == sizeof($values)-1){
        break;
    }
    $placeHolders .= ',';
}
*/

var_dump($placeHolders);


#header("Location: views/posts.php");


?>