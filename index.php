<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<?php

function makeBasicFiles() {
    for ($i = 0; $i < 24; $i++) {
        $directory_number = $i + 1;
        $path = __DIR__ . "/24/";
        /* Vytvoření složek */
//                mkdir(__DIR__ . "/{$directory_number}", 0777);
        $txt = "<html>
<head>
    <meta charset=\"UTF-8\">
    <title></title>
    <link rel=\"stylesheet\" href=\"style.css\"/>
    <link href=\"//fonts.googleapis.com/css?family=Source+Code+Pro:300&amp;subset=latin,latin-ext\" rel=\"stylesheet\" type=\"text/css\">
</head>
<body>
    <h1 id=\"intersection\">Rozcestník</h1>
    <div class=\"container\">
        <a href=\"url\"></a>
        <?php
        
        ?>
    </div>
</body>
</html>";
        $html_file = file_put_contents($path . "index.php", $txt);
        $css_file = file_put_contents($path . "style.css", "");
        $javascript_file = file_put_contents($path . "functions.js", "");
        $jquery_file = copy("jquery-3.2.1.min.js", $path . "jquery-3.2.1.min.js");
//            fwrite($html_file, $txt);
//            fclose($html_file);
//                printf("<h1>Advent of Code</h1>");
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
        <header>
            <h1 id="intersection">Adventní kalendář 2022</h1>
        </header>
        <nav></nav>
        <main>
            <div class="container">
                <?php
                $dir = __DIR__;
                $scan = scandir($dir);
                $dir_filter = array(".", "..");
//                foreach ($scan as $file) {
                for ($i = 1; $i < count($scan) + 1; $i++) {
                    if (is_dir($dir . "/" . $i) && !in_array($i, $dir_filter)) {
                        $text = '<a href="' . $i . '/index.php">
                                    <div class="advent_days">
                                        ' . $i . '
                                    </div>
                                </a>';
                        printf($text);
                    }
//                }
                }
                ?>
                <!--                                <a href="url">
                                                    <div class="advent_days">
                                
                                                    </div>
                                                </a>-->
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>
