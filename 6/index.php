<?php

function findIndex($length, $input_arr) {
    $length -= 1;
    $tmp_arr = array();
    $last_index = 0;

    for ($i = $length; $i < count($input_arr); $i++) {
        for ($j = $length; $j >= 0; $j--) {
            $sum = $i - $j;
            $tmp_arr[] = $input_arr[$sum];
        }
        $duplicates = array_count_values($tmp_arr);

        $dup = false;
        foreach ($duplicates as $key => $value) {
            if ($value > 1) {
                $dup = true;
                break;
            }
        }

        $tmp_arr = array();

        if ($dup === false) {
            $last_index = $i + 1;
            break;
        }
    }

    return $last_index;
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
        <h1 id="intersection">Day 6: Tuning Trouble</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            /* Soubor s inputem */
            $input_file = "walkie_talkie.txt";
            /* Načetní souboru */
            $input_content = file_get_contents($input_file);
            /* Rozparsování souboru po řádcích */
//            $input_content = explode("\n", $input_content);

            /* Vypsání souboru - věc navíc */
//            echo $input_content;
            ?>
        </div>
        <div id="right">
            <h2>Output</h2>
            <?php
            $input_arr = str_split($input_content);

            $last_index = findIndex(4, $input_arr);
            $last_index_sec = findIndex(14, $input_arr);

            echo "Index podle 4 místnýho dělení: " . $last_index . "<br>";
            echo "Index podle 14 místnýho dělení: " . $last_index_sec . "<br>";
            ?>
        </div>
    </body>
</html>