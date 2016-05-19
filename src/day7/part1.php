<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

class Equation
{
    private $hasValue = FALSE, $value = 0, $operands = NULL, $operator = NULL;

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

    public function setHasValue($v)
    {
        $this->hasValue = $v;
    }

    public function setValue($v)
    {
        $this->value = $v;
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
                $e = new Equation(TRUE, intval($value), [$result], "SET");
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

function value(&$eq) {
    print_r($eq);
    if ($eq->getHasValue()) {
        return $eq->getValue();
    }

    global $equations;
    $v = 0;

    switch ($eq->getOperator()) {
        case 'NOT':
            $v = ~value($equations[$eq->getOperands()[0]]);
            break;

        case 'AND':
            $v = value($equations[$eq->getOperands()[0]]) & value($equations[$eq->getOperands()[1]]);
            break;

        case 'OR':
            $v = value($equations[$eq->getOperands()[0]]) | value($equations[$eq->getOperands()[1]]);
            break;

        case 'LSHIFT':
            $v = value($equations[$eq->getOperands()[0]]) << value($equations[$eq->getOperands()[1]]);
            break;

        case 'RSHIFT':
            $v = value($equations[$eq->getOperands()[0]]) >> value($equations[$eq->getOperands()[1]]);
            break;
        case 'SET':
            $v = value($equations[$eq->getOperands()[0]]);
            break;
    }

    $eq->setValue($v);
    $eq->setHasValue(TRUE);
    return $eq;
}

print_r(value($equations['a']));
