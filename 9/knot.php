<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of knot
 *
 * @author lmatejovsky
 */
class Knot {

    private $row = 0;
    private $column = 0;
    private $max_row = 0;
    private $min_row = 0;
    private $max_column = 0;
    private $min_column = 0;
    private $positions = array();

    public function modifyRow($array) {
        /* Posune se o řádek výš nebo níž tím že se přidá nebo odebere 1*/
        if ($array[0] === "D") {
            $this->row -= $array[1];
        } elseif ($array[0] === "U") {
            $this->row += $array[1];
        }
        
        /* Aktualizují se maxima v rámci řádků - pro tento úkol nepodstatné! */
        if ($this->max_row < $this->row) {
            $this->max_row = $this->row;
        } elseif ($this->min_row > $this->row) {
            $this->min_row = $this->row;
        }
    }
    
    /* Posune se o sloupec dál nebo zpět tím že se přidá nebo odebere 1 */
    public function modifyColumn($array) {
        if ($array[0] === "L") {
            $this->column -= $array[1];
        } elseif ($array[0] === "R") {
            $this->column += $array[1];
        }
        /* Aktualizují se maxima v rámci sloupců - pro tento úkol nepodstatné! */
        if ($this->max_column < $this->column) {
            $this->max_column = $this->column;
        } elseif ($this->min_column > $this->column) {
            $this->min_column = $this->column;
        }
    }
    
    /* Uloží předané souřednice do pole pozic */
    public function savePosition($array) {
        /* Kontrola zda už existuje pole pro X souřadnici. Pokud ne tak ho vytvoří. */
        if (!array_key_exists($array[0], $this->positions)) {
            $this->positions[$array[0]] = array();
        }
        /* Kontrola zda se Y souřadnice už vyskytuje v poli s klíčem X souřadnice. Pokud ne tak ji uloží. */
        if (!in_array($array[1], $this->positions[$array[0]])) {
            $this->positions[$array[0]][] = $array[1];
        }
    }

    /* Vrací pole souřadnic řádků a sloupců */
    public function getPosition() {
        return array($this->row, $this->column);
    }

    /* Vrátí pole všech pozic */
    public function getPositions() {
        return $this->positions;
    }

    /* Vrátí pole všech atributů týkajících se maxim souřadnic */
    public function getMaxes() {
        return array($this->min_row, $this->max_row, $this->min_column, $this->max_column);
    }

    /* Vrátí počet všech pozic, kterých uzel nabyl */
    public function getCountPositions() {
        $count = 0;
        /* 
          Prochází pole pozic a pro každou instanci souřadnice X 
          spočítá počet souřadnic Y a přičte toto číslo k celkovému součtu.  
         */
        foreach ($this->positions as $key => $value) {
            $count += count($value);
        }
        return $count;
    }

}
