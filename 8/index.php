<?php
$trees = array();

$count_trees = 0;

function isVisible($position, $trees, $height) {
    $left = fromLeft($position, $trees, $height);
    if (!$left) {
        $right = fromRight($position, $trees, $height);
        if (!$right) {
            $top = fromTop($position, $trees, $height);
            if (!$top) {
                $bottom = fromBottom($position, $trees, $height);
                if (!$bottom) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        } else {
            return true;
        }
    } else {
        return true;
    }
}

function fromLeft($position, $trees, $height) {
    $x = $position[0];
    $y = $position[1];

//    echo "Z leva: Souřadnice x {$x} y {$y}<br>";
    for ($i = 0; $i < $y; $i++) {
//        echo "Číslo {$height} hodnota {$trees[$x][$i]}<br>";
        if ($trees[$x][$i] >= $height) {
            return false;
        }
    }
    return true;
}

function fromRight($position, $trees, $height) {
    $x = $position[0];
    $y = $position[1];

//    echo "Z prava: Souřadnice x {$x} y {$y}<br>";
    for ($i = count($trees[$x]) - 1; $i > $y; $i--) {
//        echo "Číslo {$height} hodnota {$trees[$x][$i]}<br>";
        if ($trees[$x][$i] >= $height) {
            return false;
        }
    }
    return true;
}

function fromTop($position, $trees, $height) {
    $x = $position[0];
    $y = $position[1];

//    echo "Ze shora: Souřadnice x {$x} y {$y}<br>";
    for ($i = 0; $i < $x; $i++) {
//        echo "Číslo {$height} hodnota {$trees[$i][$y]}<br>";
        if ($trees[$i][$y] >= $height) {
            return false;
        }
    }
    return true;
}

function fromBottom($position, $trees, $height) {
    $x = $position[0];
    $y = $position[1];

//    echo "Ze spodu: Souřadnice x {$x} y {$y}<br>";
    for ($i = count($trees) - 1; $i > $x; $i--) {
//        echo "Číslo {$height} hodnota {$trees[$i][$y]}<br>";
        if ($trees[$i][$y] >= $height) {
            return false;
        }
    }
    return true;
}

function getScenicScore($position, $trees, $height) {
    $left = leftScene($position, $trees, $height);
    $right = rightScene($position, $trees, $height);
    $top = topScene($position, $trees, $height);
    $bottom = bottomScene($position, $trees, $height);
    $score = $left * $right * $top * $bottom;
    return $score;
}

function leftScene($position, $trees, $height) {
    $x = $position[0];
    $y = $position[1];

    $score = 0;
    for ($i = $y - 1; $i >= 0; $i--) {
        $score++;
        if ($trees[$x][$i] >= $height) {
            return $score;
        }
    }
    return $score;
}

function rightScene($position, $trees, $height) {
    $x = $position[0];
    $y = $position[1];

    $score = 0;
    for ($i = $y + 1; $i <= count($trees[$x]) - 1; $i++) {
        $score++;
        if ($trees[$x][$i] >= $height) {
            return $score;
        }
    }
    return $score;
}

function topScene($position, $trees, $height) {
    $x = $position[0];
    $y = $position[1];

    $score = 0;
    for ($i = $x - 1; $i >= 0; $i--) {
        $score++;
        if ($trees[$i][$y] >= $height) {
            return $score;
        }
    }
    return $score;
}

function bottomScene($position, $trees, $height) {
    $x = $position[0];
    $y = $position[1];

    $score = 0;
    for ($i = $x + 1; $i <= count($trees) - 1; $i++) {
        $score++;
        if ($trees[$i][$y] >= $height) {
            return $score;
        }
    }
    return $score;
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
        <h1 id="intersection">Day 8: Treetop Tree House</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            /* Soubor s inputem */
            $input_file = "trees";
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
                $row = str_split($input_content[$i]);
                for ($j = 0; $j < count($row); $j++) {
                    $trees[$i][$j] = $row[$j];
                }
            }

            $scenic_score = 0;
            for ($i = 1; $i < count($trees) - 1; $i++) {
                for ($j = 1; $j < count($trees[$i]) - 1; $j++) {
                    $position = array($i, $j);
                    if (isVisible($position, $trees, $trees[$i][$j])) {
                        $count_trees++;
                    }
                    $tmp = getScenicScore($position, $trees, $trees[$i][$j]);
                    if ($tmp > $scenic_score) {
                        $scenic_score = $tmp;
                    }
                }
            }
            $count_first_row = count($trees[0]);
            $count_first_row *= 2;

            $count_columns = count($trees) - 2;
            $count_columns *= 2;

            $count_trees += $count_first_row + $count_columns;

            echo "Počet viditelných stromů: " . $count_trees . "<br>";
            echo "Nejvyšší scénické skóre je: " . $scenic_score . "<br>";
            ?>
        </div>
    </body>
</html>