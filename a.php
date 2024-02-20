<?php

//declare(strict_types = 1);
session_start();

#[Attribute(Attribute::TARGET_ALL)]
class Pter {
    function __construct(
        private string $parameter
    ){
        echo "Running PTER" . __METHOD__ ,
            " arg: " . $this->parameter . PHP_EOL;
            if ($_SESSION['logged'] && $this->parameter=="logged") {
                echo "loging OK";
            }
            else {
                echo "loggin false";
            }
        
    }
}

#[Pter("logged")]                             // 5
class Qux
{
}

// Getting class attribute with ReflectionClass
$_SESSION['logged']=true;
$ref    =   new ReflectionClass(Qux::class);
$attrs  =   $ref->getAttributes(); // Array of attributes

$attrs[0]->newInstance(); 
