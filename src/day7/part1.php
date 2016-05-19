<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

/**
 *
 */
class Equation
{
    private $hasValue, $value, $operands, $operator;

    function __construct($hasValue, $value, $operands, $operator)
    {
        $this->hasValue = $hasValue;
        $this->value = $value;
        $this->operands = $operands;
        $this->operator = $operator;
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
$equations = [];


// Pop the last element from the array, and that will be the dictionary's key.
foreach ($lines as $line)
{
    $split = explode(" ", $line);
    $result = array_pop($split);
    $e = NULL;
    switch (count($split))
    {
        case 2:
            $value = array_shift($split);
            if (is_numeric($value)) {
                $e = new Equation(TRUE, intval($value), NULL, NULL);
            } else {
                $e = new Equation(FALSE, 0, [$value], NULL);
            }
            break;

        case 3:
            $operator = array_shift($split);
            $operands = [array_shift($split)];
            $e = new Equation(FALSE, 0, $operands, $operator);
            break;

        case 4:
            $operator = $split[1];
            $operands = [$split[0], $split[2]];
            $e = new Equation(FALSE, 0, $operands, $operator);
            break;
    }
    $equations[$result] = $e;
}

print_r($equations);
