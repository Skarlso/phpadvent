<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

/**
 *
 */
class Equation
{
    private $hasValue, $value, $operator;

    function __construct($hasValue, $value, $operator)
    {
        $this->$hasValue = $hasValue;
        $this->$value = $value;
        $this->$operator = $operator;
    }

    public function getHasValue()
    {
        return $this->$hasValue;
    }

    public function getValue()
    {
        return $this->$value;
    }
}


$lines = file("input.txt");

foreach ($lines as $line)
{
    printf("%s", $line);
}
