<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Cpu
 *
 * @author lmatejovsky
 */
class Cpu {
    private static int $register_val = 1;
    private static int $cycle = 1;
    
    public static function addRegister($value) : void {
        self::$register_val += $value;
    }
    
    public static function addCycle() : void {
        self::$cycle++;
    }
    
    public static function getRegister() : int {
        return self::$register_val;
    }
    
    public static function getCycle() :int {
        return self::$cycle;
    }
}
