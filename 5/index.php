<?php
/* Nadefinování polí skladů */
$stacks = array();
$stacks[1] = array("L", "N", "W", "T", "D");
$stacks[2] = array("C", "P", "H");
$stacks[3] = array("W", "P", "H", "N", "D", "G", "M", "J");
$stacks[4] = array("C", "W", "S", "N", "T", "Q", "L");
$stacks[5] = array("P", "H", "C", "N");
$stacks[6] = array("T", "H", "N", "D", "M", "W", "Q", "B");
$stacks[7] = array("M", "B", "R", "J", "G", "S", "L");
$stacks[8] = array("Z", "N", "W", "G", "V", "B", "R", "T");
$stacks[9] = array("W", "G", "D", "N", "P", "L");

/* Vytvoření kopie skladů pro druhý úkol */
$stacks_copy = $stacks;

//var_dump($stacks);
//echo "<br><br>";
//var_dump($stacks_copy);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="style.css"/>
        <link href="//fonts.googleapis.com/css?family=Source+Code+Pro:300&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Day 5: Supply Stacks</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            /* Soubor s inputem */
            $input_file = "stacks";
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
            for ($i = 0; $i < count($input_content); $i++) {
                $exploded = explode(" ", $input_content[$i]);

                /* Počet krabic pro přesun */
                $count = intval($exploded[1]);
                /* Sklad ze kterého přesouvám */
                $from = intval($exploded[3]);
                /* Sklad do kterého přesouvám */
                $to = intval($exploded[5]);

                /* První úkol */
                for ($j = 0; $j < $count; $j++) {
                    /* Maximální index v poli sklad */
                    $length = count($stacks[$from]) - 1;

                    /* Poslední krabice ve skladu */
                    $from_value = $stacks[$from][$length];

                    /* Odstraň poslední krabici ze skladu */
                    array_pop($stacks[$from]);

                    /* Přidej ji na konec pole konečného skladu  */
                    $stacks[$to][] = $from_value;
                }

                /* Druhý úkol */
                $tmp = array();

                $length = count($stacks_copy[$from]);

                /* Index ze kterého se začnou brát krabice */
                /* => celková délka pole skladu "Z" - počet krabic které je nutné přesunout */
                $position = $length - $count;

                /* Do dočasného pole se předají krabice z počátečního indexu $position až do konce pole skladu */
                for ($j = $position; $j < count($stacks_copy[$from]); $j++) {
                    $tmp[] = $stacks_copy[$from][$j];
                }

                /* Přidání dočasného pole za poslední indexi v poli konečného skladu */
                $stacks_copy[$to] = array_merge($stacks_copy[$to], $tmp);
                for ($j = 0; $j < $count; $j++) {
                    /* Odstranění hodnot z počátečního skladu */
                    array_pop($stacks_copy[$from]);
                }
            }

            $concatenation = "";
            $sec_concatenation = "";
            /* Zřetězení posledních písmen z každého skladu */
            for ($h = 1; $h <= count($stacks); $h++) {
                $length = count($stacks[$h]);
                $length -= 1;
                $concatenation .= $stacks[$h][$length];
                $sec_concatenation .= $stacks_copy[$h][$length];
            }
            echo "Poslední krabice v zásobnících {$concatenation}<br>";
            echo "Poslední krabice v zásobnících po změně {$sec_concatenation}<br>";
            ?>
        </div>
    </body>
</html>