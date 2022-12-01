<?php
require_once './Elves.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calorie Counting</title>
        <link rel="stylesheet" href="style.css"/>
        <link href="//fonts.googleapis.com/css?family=Source+Code+Pro:300&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Day 1: Calorie Counting</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            $elves_file = "elves";
            $elves_content = file_get_contents($elves_file);
            $elves_content = explode("\n", $elves_content);
            $count = count($elves_content);

            for ($i = 0; $i < count($elves_content); $i++) {
//                array_push($sums, $elves[$i]->getSumCalories());
                echo "{$elves_content[$i]}<br>";
            }
            ?>
        </div>
        <div id="right">
            <h2>Output</h2>
            <?php
            $temp = array();
            $elves = array();
            foreach ($elves_content as $key => $value) {
                if ($value === "") {
                    $elf = new Elves($temp);
                    array_push($elves, $elf);
                    $temp = array();
                } else {
                    $number = intval($value);
                    array_push($temp, $number);
                }
            }
            $sums = array();
            for ($i = 0; $i < count($elves); $i++) {
                array_push($sums, $elves[$i]->getSumCalories());
            }
            $max = max($sums);
            $max_elf = array_search($max, $sums);
            echo "Největší počet kalorií má elf číslo {$max_elf} kalorie {$max}<br>";

            $top3_elves = array();
            $sum_top3 = 0;
            for ($i = 0; $i < 3; $i++) {
                $max = max($sums);
                $max_elf = array_search($max, $sums);
                $sum_top3 += $max;
                array_push($top3_elves, $max_elf);
                unset($sums[$max_elf]);
            }

            echo "Součet kalorií 3 elfů s největším počtem kalorií je {$sum_top3}";
            ?>
        </div>
    </body>
</html>