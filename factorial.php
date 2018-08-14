<?php
$packageOne = [
    "package" => "internet",
    "ids" => [1, 2, 3, 4, 5]
];

$packageTwo = [
    "package" => "tv",
    "ids" => [21, 22, 23, 24, 25]
];

$packageThree = [
    "package" => "cell",
    "ids" => [31, 32, 33, 34, 35]
];

$packageFour = [
    "package" => "cell",
    "ids" => [41, 42, 43, 44, 45]
];

function dd(...$args) {
    echo '<pre>';
    foreach ($args as $arg) {
        var_dump(print_r($arg));
    }
    echo '</pre>';
    die();
}


function combination(&$object, $package, $total)
{
    for ($i = 0; $i < $total; $i++) {
        foreach ($package['ids'] as $k => $id) {
            for ($j = 0; $j < count($package['ids']); $j++) {
                echo "$id<br/>";
                $aux = [$package['package'] => $id];
                if (!isset($object[$i])) {
                    $object[$i] = $aux;
                } else {
                    $object[$i] = array_merge($aux, $object[$i]);
                }
                $i++;
            }
        }
    }

}

function factorial(...$packages)
{
    $object = [];
    foreach ($packages as $package) {
        $total = count($package['ids']) *  count($package['ids']);
        combination($object, $package, $total);
    }
    dd($object);
    exit;






    if (count($packages) > 0 ) {
        $object = [];
        for($i = 0; $i < count($packages); $i++) {
            if (count($packages[$i]["ids"]) > 0) {
                foreach ($packages[$i]["ids"] as $k => $id) {
                    if (isset($packages[$i + 1])) {
                        $nextPackage = $packages[$i + 1];
                        foreach ($nextPackage["ids"] as $y => $nextId) {
                            if (isset($object[$k])) {
                                $object[$k] = array_merge($object[$k], [$nextPackage["package"] => $nextId]);
                            } else {
                                $object[$k] = [$packages[$i]["package"] => $id];
                            }
                            //$object[$y] = [$packages[$i]["package"] => $nextId];
                        }
                    }


//                    if (isset($packages[$i + 1])) {
//                        foreach ($packages[$i + 1] as $y => $package) {
//                            dd($packages[$i], $packages[$i + 1]);
//                            if (isset($object[$k])) {
//                                $object[$k] = array_merge($object[$k], [$packages[$i]["package"] => $id]);
//                            } else {
//                                $object[$k] = [$packages[$i]["package"] => $id];
//                            }
//                        }
//                    }
                }
            }
        }
        dd($object);
    }
}

var_dump(factorial($packageOne, $packageThree), factorial($packageOne, $packageTwo, $packageThree), factorial($packageOne, $packageTwo, $packageThree, $packageFour));
