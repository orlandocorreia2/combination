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
        print_r($arg);
    }
    echo '</pre>';
    die();
}


function combination(&$object, $packages, $index = 0, $next = true)
{
    //$total = count($package['ids']) * count($package['ids']);

    foreach ($packages as $index => $package) {
        $next = true;
        if(!isset($packages[$index + 1])) {
            $next = false;
        }
        foreach ($package['ids'] as $id) {
            $aux = [$package['package'] => $id];
            $object[] = $aux;
            if ($next && isset($package[$index + 1])) {
                combination($object, $package[$index + 1], $next);
            }
        }
    }
    dd($object);

}

function factorial(...$packages)
{
    $object = [];
    combination($object, $packages);


    exit;

}

var_dump(factorial($packageOne, $packageThree), factorial($packageOne, $packageTwo, $packageThree), factorial($packageOne, $packageTwo, $packageThree, $packageFour));
