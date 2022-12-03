<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ElvesGroup
 *
 * @author lmatejovsky
 */
class ElvesGroup {

    private $elves;

    public function __construct($elves) {
        $this->elves = $elves;
    }

    public function getSameItem($letter_low_values, $letter_upp_values) {
        $array1 = str_split($this->elves[0]);
        $array2 = str_split($this->elves[1]);
        $array3 = str_split($this->elves[2]);

        $first_pair;
        $second_pair;
        for ($x = 0; $x < count($array1); $x++) {
            for ($y = 0; $y < count($array2); $y++) {
                if ($array1[$x] === $array2[$y]) {
//                    return getItemValue($array1[$x], $letter_low_values, $letter_upp_values);
                    $first_pair = $array1[$x];
                    for ($z = 0; $z < count($array3); $z++) {
                        if ($array1[$x] === $array2[$z]) {
//                    return getItemValue($array1[$x], $letter_low_values, $letter_upp_values);
                            $second_pair = $array1[$x];
                            if ($first_pair === $second_pair) {
                                return getItemValue($first_pair, $letter_low_values, $letter_upp_values);
                            }
                        }
                    }
                }
            }
        }
    }

    public function getTestItem($letter_low_values, $letter_upp_values) {
        $array1 = str_split($this->elves[0]);
        $array2 = str_split($this->elves[1]);
        $array3 = str_split($this->elves[2]);

        $first_pair;
        $second_pair;
        for ($x = 0; $x < count($array1); $x++) {
            for ($y = 0; $y < count($array2); $y++) {
                if ($array1[$x] === $array2[$y]) {
                    for ($z = 0; $z < count($array3); $z++) {
//                        echo $array1[$x] . " === " . $array2[$y];
                        if ($array1[$x] === $array3[$z]) {
//                            echo " === " . $array3[$z] . "<br>";
                            return getItemValue($array3[$z], $letter_low_values, $letter_upp_values);
//                            return "Společný item pro všechny: " . $array3[$z] . "<br>";
//                            exit();
//                                return getItemValue($first_pair, $letter_low_values, $letter_upp_values);
                        } else {
                            continue;
//                            echo " !== " . $array3[$z] . "<br>";
                        }
                    }
                } else {
                    continue;
//                    echo $array1[$x] . " != " . $array2[$y] . "<br>";
                }
            }
        }
    }

    public function getGroup() {
        echo $this->elves[0] . "<br>";
        echo $this->elves[1] . "<br>";
        echo $this->elves[2] . "<br>";
        echo "<br>";
    }

}
