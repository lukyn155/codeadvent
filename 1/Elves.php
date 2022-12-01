<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Elves
 *
 * @author lmatejovsky
 */
class Elves {

    protected $calories;

    public function __construct($calories) {
        $this->calories = $calories;
    }

    public function getCalories() {
        foreach ($this->calories as $key => $value) {
            echo "{$value}<br>";
        }
    }

    public function getSumCalories() {
        $sum = 0;
        foreach ($this->calories as $key => $value) {
            $sum += $value;
        }
        return $sum;
    }

}
