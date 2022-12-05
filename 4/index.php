<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="style.css"/>
        <link href="//fonts.googleapis.com/css?family=Source+Code+Pro:300&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1 id="intersection">Day 4: Camp Cleanup</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            /* Soubor s inputem */
            $input_file = "ids";
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
            $count_ranges = 0;
            $count_overlaps = 0;
            for ($i = 0; $i < count($input_content); $i++) {
                /* Parsování podle čárky na jednotlivé páry */
                $pairs = explode(",", $input_content[$i]);

                /* První pár rozparsován podle pomlčky */
                $first = explode("-", $pairs[0]);

                /* Druhý pár rozparsován podle pomlčky */
                $second = explode("-", $pairs[1]);

                /* Podmínka pro určení zda se nachází jeden celý interval v druhým a obráceně */
                if (($first[0] >= $second[0] && $first[1] <= $second[1]) || ($second[0] >= $first[0] && $second[1] <= $first[1])) {
                    $count_ranges++;
                }

                /* Podmínka zde se intervaly navzájem prolínají */
                if (($first[1] < $second[0]) || ($first[0] > $second[1])) {
                    continue;
                } else {
                    $count_overlaps++;
                }
            }
            echo $count_ranges . "<br>";
            echo $count_overlaps . "<br>";
            ?>
        </div>
    </body>
</html>