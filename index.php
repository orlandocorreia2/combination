<?php

function dd(...$args) {
    echo '<pre>';
    foreach ($args as $arg) {
        var_dump(print_r($arg));
    }
    echo '</pre>';
    die();
}

//$packageOne = [
//    "package" => "internet",
//    "ids" => [1, 2, 3],
//    "plans" => [
//        [
//            "id" => 1,
//            "name" => "1GB"
//        ]
//    ]
//];

$packageOne = [
    "package" => "internet",
    "ids" => [1, 2, 3]
];

$packageTwo = [
    "package" => "tv",
    "ids" => [21, 22, 23, 24, 25, 26, 27]
];

$packageThree = [
    "package" => "cell",
    "ids" => [31, 32]
];

$packageFour = [
    "package" => "cell",
    "ids" => [41, 42, 43]
];

function combinateBaseColumn($result_combinations_packages, $rest_packages)
{
    //    Índice da coluna base para atribuir as combinações
    $first_column_index = 0;

    //    Faz o calculo da quantidade de repetições da coluna anterior
    $loop_column_before = 1;
    foreach ($rest_packages as $k => $p) {
        $loop_column_before *= count($p['ids']);
    }

    $loop_column_before = $loop_column_before / count($rest_packages[0]['ids']);

    while ($first_column_index < count($result_combinations_packages)) {
        foreach ($rest_packages[0]['ids'] as $package) {
            for ($i = 0; $i < $loop_column_before; $i++) {
                $result_combinations_packages[$first_column_index] .= ' | ' . $rest_packages[0]['package'] . ', ' . $package;

                $first_column_index++;
            }
        }
    }

//    Retira o item corrente do resto dos pacotes
    array_shift($rest_packages);

//    Se tiver pacotes restantes chama esta função recursivamente
    if ($rest_packages) {
        combinateBaseColumn($result_combinations_packages, $rest_packages);
    } else {
//        Término do processo, imprime na tela o resultado das combinações
        dd($result_combinations_packages);
    }
}

function generateCombinations(...$packages)
{
//    Array da primeira coluna
    $first_column_package = [];

//    Faz o calculo da quantidade de repetições da primeira coluna
    $exp = 1;
    foreach ($packages as $k => $p) {
        if ($k > 0) {
            $exp *= count($p['ids']);
        }
    }

//    Realiza o loop nos itens do primeiro pacote que é o base
    foreach ($packages[0]['ids'] as $id) {
        for ($i = 0; $i < $exp; $i++) {
            $first_column_package[] = $packages[0]['package'].' - '.  $id;
        }
    }

//    Exclui a primeira coluna dos packages
    array_shift($packages);

//    Função para atribuir a coluna base as combinações
    combinateBaseColumn($first_column_package, $packages);
}


//Função principal para gerar as combinações
generateCombinations($packageOne, $packageTwo, $packageThree, $packageFour);