<?php

function dd(...$args) {
    echo '<pre>';
    foreach ($args as $arg) {
        var_dump(print_r($arg));
    }
    echo '</pre>';
    die();
}

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

//Variavel será utilizada para definir o tamanho da primeira coluna
$base_array_length = 0;

function combinateBaseColumn($result_combinations_packages, $rest_packages, $external_loop, $internal_loop)
{
//    Variável para não permitir que exceda o índice da coluna base
    global $base_array_length;

//    Índice da coluna base para atribuir as combinações
    $index = 0;

//    Loop exponencial externo
    for ($i = 0; $i < $external_loop; $i++) {
        foreach ($rest_packages[0]['ids'] as $rest) {
//            Loop exponencial interno
            for ($j = 0; $j < $internal_loop; $j++) {
                if ($index < $base_array_length) {
                    $result_combinations_packages[$index] .= ' | ' . $rest_packages[0]['package'] . ', ' . $rest;
                }

                $index++;
            }
        }
    }

//    Recalcula os loops exponenciais para ser utilizado caso esta função seja chamada recursivamente
    $external_loop *= 5;
    $internal_loop /= 5;

//    Retira o item corrente do resto dos pacotes
    array_shift($rest_packages);

//    Se tiver pacotes restantes chama esta função recursivamente
    if ($rest_packages) {
        combinateBaseColumn($result_combinations_packages, $rest_packages, $external_loop, $internal_loop);
    } else {
//        Término do processo, imprime na tela o resultado das combinações
        dd($result_combinations_packages);
    }
}



function generateCombinations(...$packages)
{
//    Tamanho base da primeira coluna
    global $base_array_length;

//    Array da primeira coluna
    $first_package = [];

//    Pega a quantidade de pacotes tirando o da primeira coluna
    $count_packages = count($packages) -1;

//    Pega a quantidade de itens de cada pacote no caso 5
    $count_package_id = count($packages[0]['ids']);

//    Faz o calculo da exponenciação para gerar o loop conforme a quantidade de pacotes tirando o da primeira coluna
    $exp = pow($count_package_id, $count_packages);

//    Realiza o loop nos itens do primeiro pacote que é o base
    foreach ($packages[0]['ids'] as $id) {
        for ($i = 0; $i < $exp; $i++) {
            $first_package[] = $packages[0]['package'].' - '.  $id;
        }
    }

//    Exclui a primeira coluna dos packages
    array_shift($packages);

//    Calculo exponencial dos loops para atribuir a coluna base
//    Loop externo do array
    $external_loop = count($packages) > 1 ? pow(5, count($packages) -1) : 5;
//    Loop interno do array
    $internal_loop = pow(5, count($packages) -1);
//    Seta o tamanho da coluna base
    $base_array_length = count($first_package);

//    Função para atribuir a coluna base as combinações
    combinateBaseColumn($first_package, $packages, $external_loop, $internal_loop);
}


//Função principal para gerar as combinações
generateCombinations($packageOne, $packageTwo, $packageThree, $packageFour, $packageOne);