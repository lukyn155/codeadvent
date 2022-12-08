<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of system
 *
 * @author lmatejovsky
 */
class System {

    private $file_system = array("/" => array());
    private $input;
    private $active_dir = "/";
    private $folder_content;
    private $path = array();

    public function __construct($input) {
        $this->input = $input;
    }

    public function getArray($index) {
        $key = $this->path[$index];
        return $this->file_system[$key];
    }

    public function makeFileSystem() {
        for ($i = 0; $i < count($this->input); $i++) {
            $row = explode(" ", $this->input[$i]);
            if ($row[0] === "$") {
                if ($row[1] === "cd") {
                    if ($row[2] === "..") {
                        array_pop($this->path);
                        $max_index = count($this->path);
                        $this->active_dir = $max_index;
                    } else {
                        $this->path[] = $row[2];
                        $this->active_dir = $row[2];
                    }
                } elseif ($row[1] === "ls") {
                    continue;
                }
            } else {
                if ($row[0] === "dir") {
                    $this->file_system[$this->active_dir] = array($row[1] => array());
//                    $this->folder_content[$this->active_dir] = array($row[1] => array());
                } else {
                    $this->file_system[$this->active_dir] = array("size" => $row[0], "file" => $row[1]);
//                    $this->folder_content[$this->active_dir] = array("size" => $row[0], "file" => $row[1]);
                }
            }
        }
        return $this->file_system;
    }

}
