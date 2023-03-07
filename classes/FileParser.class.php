<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of FileParser
 *
 * @author lmatejovsky
 */
class FileParser {

    private $input_content;

    function __construct(string $input_file) {
        $this->input_content = file_get_contents($input_file);
        /* Rozparsování souboru po řádcích */
        $this->input_content = explode("\n", $this->input_content);
    }

    public function getParsedContent() {
        return $this->input_content;
    }
    
    public function getStringContent() {
        $string = "";
        /* Vypsání souboru - věc navíc */
        for ($i = 0; $i < count($this->input_content); $i++) {
            $row = $i + 1;
             $string .= "Řádek {$row}| " . $this->input_content[$i] . "<br>";
        }
        return $string;
    }

}
