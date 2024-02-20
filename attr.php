<?php
#[ExampleAttribute('Hello world', 42)]
class Foo {}



$reflector = new \ReflectionClass(Foo::class);
$attrs = $reflector->getAttributes();
//var_dump($attriubute->getName()).PHP_EOL; // "My\Attributes\ExampleAttribute"
//var_dump($attriubute->getArguments()).PHP_EOL; // ["Hello world", 42]
$attr=$attrs[0]->newInstance();
        // object(ExampleAttribute)#1 (2) {
        //  ["message":"Foo":private]=> string(11) "Hello World"        
        //  ["answer":"Foo":private]=> int(42) 
        // }
var_dump($attr->getMessage());
