<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

class Equation
{
    public $hasValue = FALSE, $value = 0, $operands = NULL, $operator = NULL;

    function __construct($hasValue, $value, $operands, $operator)
    {
        $this->hasValue = $hasValue;
        $this->value = $value;
        $this->operands = $operands;
        $this->operator = $operator;
    }
}


$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$equations = [];

foreach ($lines as $line)
{
    $split = explode(" ", $line);
    $result = trim(array_pop($split));
    $e = NULL;
    switch (count($split))
    {
        case 2:
            $value = trim(array_shift($split));
            if (is_numeric($value)) {
                $e = new Equation(TRUE, intval($value), [$value], "SET");
            } else {
                $e = new Equation(FALSE, 0, [$value], "SET");
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

function value($eq) {
    if ($eq->hasValue) {
        return $eq->value;
    }

    global $equations;
    $v = 0;

    switch ($eq->operator) {
        case 'NOT':
            $v = ~value($equations[$eq->operands[0]]);
            break;

        case 'AND':
            $op1 = is_numeric($eq->operands[0]) ? intval($eq->operands[0]) : value($equations[$eq->operands[0]]);
            $op2 = is_numeric($eq->operands[1]) ? intval($eq->operands[1]) : value($equations[$eq->operands[1]]);
            $v = $op1 & $op2;
            break;

        case 'OR':
            $op1 = is_numeric($eq->operands[0]) ? intval($eq->operands[0]) : value($equations[$eq->operands[0]]);
            $op2 = is_numeric($eq->operands[1]) ? intval($eq->operands[1]) : value($equations[$eq->operands[1]]);
            $v = $op1 | $op2;
            break;

        case 'LSHIFT':
            $v = value($equations[$eq->operands[0]]) << intval($eq->operands[1]);
            break;

        case 'RSHIFT':
            $v = value($equations[$eq->operands[0]]) >> intval($eq->operands[1]);
            break;
        case 'SET':
            $v = value($equations[$eq->operands[0]]);
            break;
    }

    $eq->value = $v;
    $eq->hasValue = TRUE;
    return $v;
}

print(value($equations['a']) . "\n");
DisplayElapsedTime($time_start);
