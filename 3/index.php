<?php
require_once './ElvesGroup.php';
$letter_low_values = array("a" => 1, "b" => 2, "c" => 3, "d" => 4, "e" => 5, "f" => 6, "g" => 7, "h" => 8, "i" => 9, "j" => 10, "k" => 11, "l" => 12, "m" => 13, "n" => 14, "o" => 15, "p" => 16, "q" => 17, "r" => 18, "s" => 19, "t" => 20, "u" => 21, "v" => 22, "w" => 23, "x" => 24, "y" => 25, "z" => 26);
$letter_upp_values = array();
foreach ($letter_low_values as $key => $value) {
    $upper = strtoupper($key);
    $upper_value = $value + 26;
    $letter_upp_values[$upper] = $upper_value;
}

function getItemValue($item, $letter_low_values, $letter_upp_values) {
    if (isset($letter_low_values[$item])) {
        return $letter_low_values[$item];
    } else {
        return $letter_upp_values[$item];
    }
}

function findSameItem($string1, $string2, $letter_low_values, $letter_upp_values) {
    $tmp = array();

    $array1 = str_split($string1);
    $array2 = str_split($string2);

    for ($i = 0; $i < count($array1); $i++) {
        for ($j = 0; $j < count($array2); $j++) {
            if ($array1[$i] === $array2[$j]) {
                return getItemValue($array1[$i], $letter_low_values, $letter_upp_values);
            }
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="style.css"/>
        <link href="//fonts.googleapis.com/css?family=Source+Code+Pro:300&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1 id="intersection">Day 3: Rucksack Reorganization</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            /* Soubor s inputem */
            $input_file = "rucksacks";
            /* Načetní souboru */
            $input_content = file_get_contents($input_file);
            /* Rozparsování souboru po řádcích */
            $input_content = explode("\n", $input_content);

            /* Vypsání souboru - věc navíc */
            for ($i = 0; $i < count($input_content); $i++) {
                echo $input_content[$i] . "<br>";
            }
            ?>
        </div>
        <div id="right">
            <h2>Output</h2>
            <?php
            $sum_item_values = 0;
            $groups = 0;
            $elf_group = array();
            $elves = array();
            /* Procházení jednotlivých řádků */
            for ($i = 0; $i < count($input_content); $i++) {
                $compartments = str_split($input_content[$i], strlen($input_content[$i]) / 2);
                $same_item = findSameItem($compartments[0], $compartments[1], $letter_low_values, $letter_upp_values);

                $sum_item_values += $same_item;
                $elf_group[] = $input_content[$i];
                if ($groups == 2) {
                    $elves[] = new ElvesGroup($elf_group);
                    $elf_group = array();
                    $groups = 0;
                } else {
                    $groups++;
                }
            }
            $sum3 = 0;
//            var_dump($elves);
            for ($i = 0; $i < count($elves); $i++) {
////                $sum3 += $elves[$i]->getSameItem($letter_low_values, $letter_upp_values);
//                $elves[$i]->getGroup();
                $sum3 += $elves[$i]->getTestItem($letter_low_values, $letter_upp_values);
//                echo "<br>";
            }
//            $elves[0]->getGroup();
//            $elves[0]->getTestItem($letter_low_values, $letter_upp_values);
            echo "Součet hodnot všech stejných předmětů v obou přihrádkách pro všechny ruksaky je: {$sum_item_values}";
            echo "Součet hodnot všech stejných předmětů v obou přihrádkách pro ruksaky skupiny elfů je: {$sum3}";
            ?>
        </div>
    </body>
</html>