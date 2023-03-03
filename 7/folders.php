<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of folders
 *
 * @author lmatejovsky
 */
class Folder {

    private $files = array();
    private $dirs = array();
    private $key;
    private $file_system;
    private $folder_sum = 0;
    private $rule_sum = 0;
    private $values = array();

    public function __construct($key) {
        $this->key = $key;
    }

    public function addFilePath($size, $name, $path) {
        $length = count($path) - 1;
        $last_folder = $path[$length];
        $count = count($path);
        if (count($path) == 1 && $last_folder == $this->key) {
            $this->files[$name] = $size;
        } else {
            array_pop($path);
            $last_folder = end($path);
            $this->dirs[$last_folder]->addFilePath($size, $name, $path);
        }
    }

    public function addDirPath($name, $path) {
        $length = count($path) - 1;
        $last_folder = $path[$length];
        $count = count($path);
        if (count($path) == 1 && $last_folder == $this->key) {
            $this->dirs[$name] = new Folder($name);
        } else {
            array_pop($path);
            $last_folder = end($path);
            $this->dirs[$last_folder]->addDirPath($name, $path);
        }
    }

    public function getFiles() {
        return $this->files;
    }

    public function getDirs() {
        $tmp = array();
        foreach ($this->dirs as $key => $value) {
            $tmp[] = $key;
        }
        return $tmp;
    }

    public function getContent() {
        $this->file_system = $this->files;
        foreach ($this->dirs as $key => $value) {
            $this->file_system[$key] = $this->dirs[$key]->getContent();
        }
        return $this->file_system;
    }

    public function getContentSize() {
//        $this->file_system = $this->files;
        foreach ($this->dirs as $key => $value) {
            $this->file_system[$key] = array($this->dirs[$key]->getContentSize(), $this->dirs[$key]->getFolderSum());
        }
        return $this->file_system;
    }

    public function getSums() {
        $sums = array();
        foreach ($this->files as $key => $value) {
            $this->folder_sum += $value;
        }
        if (count($this->dirs) > 0) {
            foreach ($this->dirs as $key => $value) {
                $sums = $this->dirs[$key]->getSums();
                $this->folder_sum += $sums[0];
                $this->rule_sum += $sums[1];
            }
            if ($this->folder_sum <= 100000) {
//                echo "Název složky: {$this->key} Velikost {$this->folder_sum}<br>";
                $this->rule_sum += $this->folder_sum;
            }
        } else {
            if ($this->folder_sum <= 100000) {
//                echo "Název složky: {$this->key} Velikost {$this->folder_sum}<br>";
                $this->rule_sum += $this->folder_sum;
            }
        }
        $sums = array($this->folder_sum, $this->rule_sum);
        return $sums;
    }

    public function getFolderSum() {
        return $this->folder_sum;
    }

    public function getBestDir($size) {
        if ($this->folder_sum >= $size) {
            $this->values[] = $this->folder_sum;
        }
        foreach ($this->dirs as $key => $value) {
            $this->values[] = $this->dirs[$key]->getBestDir($size);
        }
        return $this->values;
    }

}
