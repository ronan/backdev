<?php

$db = new PDO('mysql:host=db', 'root', 'root');
$db->exec('DROP DATABASE IF EXISTS backdrop');
$db->exec('CREATE DATABASE backdrop');
   
foreach(glob("/workspace/data/config/active/*") as $file) {
    unlink($file); 
}

echo <<<'EOD'


    🔄 Reset Complete 🔄
    
    http://localhost/core/install.php


EOD;
