<?php

function dd(...$args) {
    foreach ($args as $arg) {
        var_dump($arg);
    }

    die();
}






function show($i, $array) {
    if ($i != $array[0]) {
        echo $i.$array[0].' ';
    }

    array_shift($array);

    if ($array) {
        show($i, $array);
    }
}

function combinations(...$combinations) {
    echo 'Qtd: '.count($combinations[0]).'<br/><br/><br/>';

    foreach ($combinations[0] as $combination) {
        show($combination, $combinations[0]);
    }
}


$combination = [1, 2, 3, 5, 6, 7];
combinations($combination);




