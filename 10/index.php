<?php
include '../autoloader.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="style.css"/>
        <link href="//fonts.googleapis.com/css?family=Source+Code+Pro:300&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1 id="intersection">Day 10: Cathode-Ray Tube</h1>
        <div id="left">
            <h2>Input</h2>
            <?php
            /* Použití třídy ze složky classes */
            $file = new FileParser("test");

            /* Rozparsovaný inputový soubor */
            $parsed_content = $file->getParsedContent();

            /* Vypsání celého souboru */
            echo $file->getStringContent();
            ?>
        </div>
        <div id="right">
            <h2>Output</h2>
            <?php
            /* Proměnná s celkovou velikostí registrů */
            $total_value = 0;
            /* Začátek cyklu pro počítání */
            $count_cycle = 20;
            /* Maximální velikost cyklu pro počítání */
            $max_cycle = 220;

            /* Šířka crt displeje */
            $row_size = 10;
            /* Začátek crt cyklu */
            $crt_cycle = 0;
            /* Maximální velikost crt cyklu */
            $crt_max_cycle = 240;
            /* Proměnná pro výsledné vykreslení */
            $total_string = "";

            /* Procházení jednotlivých řádků inputu */
            for ($i = 0; $i < count($parsed_content); $i++) {
                /* Rozdělení na příkaz a hodnotu */
                $row = explode(" ", $parsed_content[$i]);
                $id = $i + 1;
                
                /* Kontrola příkazu */
                if ($row[0] === "addx") {
                    /* 2. Cyklus slouží pro provedení jednotlivých cyklů podle hodin procesoru */
                    for ($j = 0; $j < 2; $j++) {
                        /* Pokud jsme dosáhli posledního pixelu crt monitoru tak musíme začít vykreslovat na novém řádku - Úkol 2*/
                        if (Cpu::getCycle() === $crt_cycle + 41) {
                            $crt_cycle += 40;
                            $total_string .= "<br>";
                        }
                        /* Konkrétní pixel na řádku - Úkol 2 */
                        $crt_row = Cpu::getCycle() - $crt_cycle - 1;
                        /* Pokud je pixel v rozsahu tří pixelů od spritu tak se vykreslí "#" jinak "." - Úkol 2*/
                        if (($crt_row === Cpu::getRegister() - 1) || ($crt_row === Cpu::getRegister()) || ($crt_row === Cpu::getRegister() + 1)) {
                            $total_string .= "#";
                        } else {
                            $total_string .= ".";
                        }
                        
                        /* Pokud jsme dosáhli cyklu kdy se má počítat, tak se provede vynásobení momentální velikosti registu s velikostí cylku a výsledek je přičten k celkové velikosti - ÚKol 1 */
                        if (Cpu::getCycle() === $count_cycle) {
                            $count = Cpu::getRegister() * $count_cycle;
                            $total_value += $count;
                            /* Pokud je dosaženo maximální velikosti cyklu ukončí se nejvyšší cyklus */
                            if ($count_cycle === $crt_max_cycle) {
                                break 2;
                            }
                            /* Úprava cyklu pro výpočet */
                            $count_cycle += 40;
                        }
                        /* Zvětší cyklus o 1 */
                        Cpu::addCycle();
                    }
                    /* Přičte hodnotu k registru */
                    Cpu::addRegister($row[1]);
                    /* Stejné příkazy jsou provedeny i u druhého příkazu */
                } elseif ($row[0] === "noop") {
                    if (Cpu::getCycle() === $crt_cycle + 41) {
                        $crt_cycle += 40;
                        $total_string .= "<br>";
                    }
                    $crt_row = Cpu::getCycle() - $crt_cycle - 1;
                    if (($crt_row === Cpu::getRegister() - 1) || ($crt_row === Cpu::getRegister()) || ($crt_row === Cpu::getRegister() + 1)) {
                        $total_string .= "#";
                    } else {
                        $total_string .= ".";
                    }
                    if (Cpu::getCycle() === $count_cycle) {
                        $count = Cpu::getRegister() * $count_cycle;
                        $total_value += $count;
                        if ($count_cycle === $max_cycle) {
                            break;
                        }
                        $count_cycle += 40;
                    }
                    Cpu::addCycle();
                }
            }

            echo "Celková hodnota registrů je: {$total_value}<br>";
            echo $total_string;
            ?>
        </div>
    </body>
</html>