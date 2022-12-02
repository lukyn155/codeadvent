<?php
require_once './shape.php';

$rock = new Shape("Rock", 1, "Scissors", "Paper", "Rock", "C", "B", "A");
$paper = new Shape("Paper", 2, "Rock", "Scissors", "Paper", "A", "C", "B");
$scissors = new Shape("Scissors", 3, "Paper", "Rock", "Scissors", "B", "A", "C");
$shapes = array("A" => $rock, "B" => $paper, "C" => $scissors, "X" => $rock, "Y" => $paper, "Z" => $scissors);

$second_part = array("A" => $rock, "B" => $paper, "C" => $scissors, "X" => "lost", "Y" => "draw", "Z" => "win");

$win = 6;
$draw = 3;
$lost = 0;

function play($opponent, $me, $shapes) {
    $first = $shapes[$opponent];
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
        <?php
        $opponent = array();
        $me = array();

        $guide_file = "strategy_guide";
        $guide_content = file_get_contents($guide_file);
        $guide_content = explode("\n", $guide_content);
        echo "Celkový počet her " . count($guide_content) . "<br>";
        echo "Maximální počet bodů za jednu hru 9<br>";
        echo "Maximální počet bodů celkově " . count($guide_content) * 9 . "<br>";

        $total_score = 0;
        $total_score2 = 0;
        for ($i = 0; $i < count($guide_content); $i++) {
            $row = explode(" ", $guide_content[$i]);

            $total_score += play($row[0], $row[1], $shapes);
            $total_score2 += fullGuide($row[0], $row[1], $shapes);
        }
        echo "Turnaj jsem dokončil s výsledným skóre {$total_score} bodů<br>";
        echo "Turnaj jsem dokončil s výsledným skóre {$total_score2} bodů";
        ?>
    </body>
</html>