<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of shape
 *
 * @author lmatejovsky
 */
class Shape {

    private $name;
    private $value;
    private $wins;
    private $wins_index;
    private $loses;
    private $loses_index;
    private $draw;
    private $draw_index;

    public function __construct($name, $value, $wins, $loses, $draw, $wins_index, $loses_index, $draw_index) {
        $this->name = $name;
        $this->value = $value;
        $this->wins = $wins;
        $this->loses = $loses;
        $this->draw = $draw;
        $this->wins_index = $wins_index;
        $this->loses_index = $loses_index;
        $this->draw_index = $draw_index;
    }

    function get_shape() {
        return $this->name;
    }

    function get_win() {
        return $this->wins;
    }

    function get_lose() {
        return $this->loses;
    }

    function get_draw() {
        return $this->draw;
    }

    function get_win_index() {
        return $this->wins_index;
    }

    function get_lose_index() {
        return $this->loses_index;
    }

    function get_draw_index() {
        return $this->draw_index;
    }

    function get_value() {
        return $this->value;
    }

}
