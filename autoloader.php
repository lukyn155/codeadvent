<?php
spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {
    $path = "../classes/";
    $extenstion = ".class.php";
    $fullPath = $path . $className . $extenstion;
    
    if (!file_exists($fullPath)) {
        return false;
    }
    
    include_once $fullPath;
}

