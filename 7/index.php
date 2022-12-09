<?php
require_once './folders.php';

$tmp = 70000000;
$values = array();

function getValue($arr, $tmp) {
    foreach ($arr as $key => $value) {
        if (is_array($value)) {
            getValue($arr[$key], $tmp);
        } else {
            $GLOBALS['values'][] = $value;
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
        <h1 id="intersection">Day 7: No Space Left On Device</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            /* Soubor s inputem */
//            $input_file = "commands";
            $input_file = "test2";
//$input_file = "test";
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
            $file_system = new Folder("/");
            $path = array();
            $index = "";
            $last_index = "";
            for ($i = 0; $i < count($input_content); $i++) {
                $row = explode(" ", $input_content[$i]);
                if ($row[0] === "$") {
                    if ($row[1] === "cd") {
                        if ($row[2] === "..") {
                            array_pop($path);
                        } else {
                            $path[] = $row[2];
                        }
                    } elseif ($row[1] === "ls") {
                        continue;
                    }
                } else {
                    $index = array_reverse($path);
                    if ($row[0] === "dir") {
                        $file_system->addDirPath($row[1], $index);
                    } else {
                        $size = intval($row[0]);
                        $file_system->addFilePath($size, $row[1], $index);
                    }
                }
            }
            $max_size = 70000000;

            $all_sum = $file_system->getSums();
            $diff = $max_size - $all_sum[0];
            $update_space = 30000000;
            $needed_space = $update_space - $diff;
            echo "Celková velikost složky \"/\" " . $all_sum[0] . "<br>";

            echo "Výsledek prvního úkolu: " . $all_sum[1] . "<br>";
            echo "Potřebné místo na update {$needed_space}<br>";
            $best_dir = $file_system->getBestDir($needed_space);

            getValue($best_dir, $tmp);
            echo "Složka s nejnižší velikostí potřebná ke smazání: " . min($GLOBALS['values']);
//var_dump($GLOBALS['values']);
            ?>
        </div>
    </body>
</html>
