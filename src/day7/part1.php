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
        return $this->hasValue;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function getOperands()
    {
        return $this->operands;
    }
}


$lines = file("input.txt");
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

function value($v) {
    global $equations;
    if (is_numeric($v)) {
        return $v;
    }

    if ($equations[$v]->getHasValue()) {
        $v = $equations[$v]->getValue();
        return $v;
    }

    switch ($equations[$v]->getOperator()) {
        case 'NOT':
            $v = 1 ^ value($equations[$v]->getOperands()[0]);
            break;

        case 'AND':
            $v = value($equations[$v]->getOperands()[0]) & value($equations[$v]->getOperands()[1]);
            break;

        case 'OR':
            $v = value($equations[$v]->getOperands()[0]) | value($equations[$v]->getOperands()[1]);
            break;

        case 'LSHIFT':
            $v = value($equations[$v]->getOperands()[0]) << value($equations[$v]->getOperands()[1]);
            break;

        case 'RSHIFT':
            $v = value($equations[$v]->getOperands()[0]) >> value($equations[$v]->getOperands()[1]);
            break;
        case NULL:
            $v = value($equations[$v]->getOperands()[0]);
    }

    // return $v;
}

print(value('a'));
