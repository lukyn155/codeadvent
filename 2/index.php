<?php
require_once './shape.php';

/* Vyvoření všech tvarů atributy - Jměno, Hodnota tvaru, Nad čím prohraje, Vyhraje, Remizuje, Index tvaru nad kterým prohraje, Vyhraje, Remizuje*/
$rock = new Shape("Rock", 1, "Scissors", "Paper", "Rock", "C", "B", "A");
$paper = new Shape("Paper", 2, "Rock", "Scissors", "Paper", "A", "C", "B");
$scissors = new Shape("Scissors", 3, "Paper", "Rock", "Scissors", "B", "A", "C");

/* Pole označující tvar podle indexu */
$shapes = array("A" => $rock, "B" => $paper, "C" => $scissors, "X" => $rock, "Y" => $paper, "Z" => $scissors);

/* Body za jednotlivé výsledky*/
$win = 6;
$draw = 3;
$lost = 0;

function play($opponent, $me, $shapes) {
    /* Zjištění oponentova objektu v poli shapes*/
    $first = $shapes[$opponent];
    /* Zjištění mého objektu v poli shapes*/
    $second = $shapes[$me];

    $points = 0;
    if ($first->get_win() === $second->get_shape()) {
        /* Moje prohra */
        $points += $second->get_value() + $GLOBALS['lost'];
    } elseif ($first->get_lose() === $second->get_shape()) {
        /* Moje výhra */
        $points += $second->get_value() + $GLOBALS['win'];
    } else {
        /* Moje remíza */
        $points += $second->get_value() + $GLOBALS['draw'];
    }
    return $points;
}

function fullGuide($opponent, $result, $shapes) {
    /* Zjištění oponentova objektu v poli shapes*/
    $first = $shapes[$opponent];

    $points = 0;

    if ($result === "X") {
        /* Moje prohra */
        $object_points = $shapes[$first->get_win_index()]->get_value();
//        echo "Zde mám prohrát: Opponent má " . $first->get_shape() . " já mám " . $shapes[$first->get_win_index()]->get_shape() . "<br>";
        $points += $GLOBALS['lost'] + $object_points;
    } elseif ($result === "Y") {
        /* Moje remíza */
        $object_points = $shapes[$first->get_draw_index()]->get_value();
//        echo "Zde mám remizovat: Opponent má " . $first->get_shape() . " já mám " . $shapes[$first->get_draw_index()]->get_shape() . "<br>";
        $points += $GLOBALS['draw'] + $object_points;
    } else {
        /* Moje výhra */
        $object_points = $shapes[$first->get_lose_index()]->get_value();
//        echo "Zde mám vyhrát: Opponent má " . $first->get_shape() . " já mám " . $shapes[$first->get_lose_index()]->get_shape() . "<br>";
        $points += $GLOBALS['win'] + $object_points;
    }
    return $points;
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
        <h1 id="intersection">Rock Paper Scissors</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            /* Soubor s inputem */
            $guide_file = "strategy_guide";
            /* Načetní souboru */
            $guide_content = file_get_contents($guide_file);
            /* Rozparsování souboru po řádcích */
            $guide_content = explode("\n", $guide_content);

            /* Vypsání souboru - věc navíc */
            for ($i = 0; $i < count($guide_content); $i++) {
                echo $guide_content[$i] . "<br>";
            }
            ?>
        </div>
        <div id="right">
            <h2>Output</h2>
            <?php
            $opponent = array();
            $me = array();

            echo "Celkový počet her " . count($guide_content) . "<br>";
            echo "Maximální počet bodů za jednu hru 9<br>";
            echo "Maximální počet bodů celkově " . count($guide_content) * 9 . "<br>";

            $total_score = 0;
            $total_score2 = 0;
            
            /* Procházení jednotlivých řádků */
            for ($i = 0; $i < count($guide_content); $i++) {
                /* Parsování řádku podle mezery */
                $row = explode(" ", $guide_content[$i]);
                
                /* Hraní s prvním strategy_guide */
                $total_score += play($row[0], $row[1], $shapes);
                /* Hraní s druhým strategy_guidem */
                $total_score2 += fullGuide($row[0], $row[1], $shapes);
            }
            echo "Turnaj jsem dokončil s výsledným skóre {$total_score} bodů<br>";
            echo "Turnaj jsem dokončil s výsledným skóre {$total_score2} bodů";
            ?>
        </div>
    </body>
</html>