<?php

class Person {
    
    const MAX_LENGTH_NAME = 50;

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->getName();
    }

    public static function generateName()
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($chars);

        $name = '';
        for ($i = 0; $i < self::MAX_LENGTH_NAME; $i++) { 
            $name .= $chars[rand(0, $charLength - 1)];
        }
        
        return $name;
    }

}