<?php
require_once './knot.php';

function calculatePosition($head_array, $tail_array) {
    $row_diff = $head_array[0] - $tail_array[0];
    $colum_diff = $head_array[1] - $tail_array[1];
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
        <h1 id="intersection">Day 9: Rope Bridge</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            /* Soubor s inputem */
            $input_file = "commands";
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
            $rope = array(
                $start = new Knot(),
                $one = new Knot(),
                $two = new Knot(),
                $three = new Knot(),
                $four = new Knot(),
                $five = new Knot(),
                $six = new Knot(),
                $seven = new Knot(),
                $eight = new Knot(),
                $nine = new Knot()
            );
            /* První cyklus projede celý input řádek po řádku */
            for ($i = 0; $i < count($input_content); $i++) {
                /* Rozdělení řádku podle mezer */
                $row = explode(" ", $input_content[$i]);
                
                /* 
                  Druhý cyklus je nastavení pro jednotlivé posuny.
                  Jinak by se posun provedl najednou a nezapočítaly by se pozice mezitím.
                */
                for ($x = 0; $x < $row[1]; $x++) {
                    /* Rozdělení zda se má posunout Hlavička v rámci řádků nebo sloupců */
                    if ($row[0] === "D" || $row[0] === "U") {
                        $rope[0]->modifyRow(array($row[0], 1));
                    } elseif ($row[0] === "L" || $row[0] === "R") {
                        $rope[0]->modifyColumn(array($row[0], 1));
                    }
                    
                    /*
                      Třetí cyklus který porovnává pozice vždy druhého uzlu vůči prvnímu v rámci celého pole "rope".
                      Procházení začíná od druhého prvku, protože první nemá vůči komu svoji pozici porovnat.
                     */
                    for ($j = 1; $j < count($rope); $j++) {
                        /* 
                          Id předchozího uzlu. 
                          Na žačátku je to id hlavičky, která dostává pokynu pro posun.
                        */
                        $head_id = $j - 1;
                        
                        /* Získání souřadnic jednotlivých uzlů */
                        $head_position = $rope[$head_id]->getPosition();
                        $tail_position = $rope[$j]->getPosition();

                        /* Rozdíl pozic nejprve v rámci řádku, dále v rámci sloupců */
                        $row_diff = $head_position[0] - $tail_position[0];
                        $column_diff = $head_position[1] - $tail_position[1];

                        /* Získání zatím maximálních dosažených souřadnic - V tomto úkolu nepodstatné! */
                        $maxes = $rope[0]->getMaxes();
                        
                        /*
                          Pro řádek:
                          Provádí se kontrola zda je rozdíl větší než 2 nebo menší něž 2, 
                          protože pouze v tomto případě už není první uzel v okolí druhého uzlu.
                         
                        */
                        if ($row_diff >= 2) {
                            /* Provede se posun o takový počet řádků o kolik je rozdíl bez jedné (jinak by došlo k překrytí)
                             *  za účelem přiblížení opět k prvnímu uzlu. */
                            $rope[$j]->modifyRow(array("U", $row_diff - 1));
                            /* Kontrola zda byl rozdíl sloupců roven jedné. Pokud ano musíme provést pohyb diagonálně do kladného směru. 
                               Pokud je rozdíl roven nule. Stačí posunout uzel pouze v rámci řádku.
                            */
                            if ($column_diff === 1) {
                                /* Provede se pohyb do kladného směru v rámci sloupce k dosažení diagonálního posunu. */
                                $rope[$j]->modifyColumn(array("R", $column_diff));
                            /* Kontrola zda byl rozdíl sloupců roven mínus jedné. Pokud ano musíme provést pohyb diagonálně do záporného směru. */
                            } elseif ($column_diff === -1) {
                                $rope[$j]->modifyColumn(array("L", abs($column_diff)));
                            }
                        } elseif ($row_diff <= -2) {
                            $rope[$j]->modifyRow(array("D", abs($row_diff) - 1));
                            if ($column_diff === 1) {
                                $rope[$j]->modifyColumn(array("R", $column_diff));
                            } elseif ($column_diff === -1) {
                                $rope[$j]->modifyColumn(array("L", abs($column_diff)));
                            }
                        }

                        /* Provádí se stejný proces jako výše pouze s rozdílem v rámci sloupců. */
                        if ($column_diff >= 2) {
                            $rope[$j]->modifyColumn(array("R", $column_diff - 1));
                            if ($row_diff === 1) {
                                $rope[$j]->modifyRow(array("U", $row_diff));
                            } elseif ($row_diff === -1) {
                                $rope[$j]->modifyRow(array("D", abs($row_diff)));
                            }
                        } elseif ($column_diff <= -2) {
                            $rope[$j]->modifyColumn(array("L", abs($column_diff) - 1));
                            if ($row_diff === 1) {
                                $rope[$j]->modifyRow(array("U", $row_diff));
                            } elseif ($row_diff === -1) {
                                $rope[$j]->modifyRow(array("D", abs($row_diff)));
                            }
                        }

                        /* Získání aktuálních souřadnic jednotlivých uzlů */
                        $head_position = $rope[$head_id]->getPosition();
                        $tail_position = $rope[$j]->getPosition();

                        $rows = $maxes[0] + $maxes[1];
                        $columns = $maxes[2] + $maxes[3];
                        
                        /* Uložení aktuálních pozic do historie pohybu */
                        $rope[$head_id]->savePosition($rope[$head_id]->getPosition());
                        $rope[$j]->savePosition($rope[$j]->getPosition());
                    }
                }
            }
            echo "Výsledek prvního úkolu: {$rope[1]->getCountPositions()}<br>";
            echo "Výsledek druhého úkolu: {$rope[9]->getCountPositions()}<br>";
            ?>
        </div>
    </body>
</html>