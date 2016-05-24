<?php

function permute($arr) {
    $n = count($arr);
    $indices = range(0, $n-1);
    $cycles = range($n, 0, -1);
    $yield_arr = [];
    foreach (array_slice($indices, 0, $n) as $i) {
        array_push($yield_arr, $arr[$i]);
    }
    yield $yield_arr;

    while ($n) {
        $return = true;
        foreach (array_reverse(range(0, $n-1)) as $i) {
            $cycles[$i] -= 1;
            // echo "cycle[i]: ", $cycles[$i], "\n";
            if ($cycles[$i] == 0) {
                $indices = array_merge(
                    array_slice($indices, 0, $i),
                    array_slice($indices, $i+1),
                    [$indices[$i]]
                );
                $cycles[$i] = $n - $i;
            } else {
                $j = $cycles[$i];
                $_l = count($indices);
                $index = ($_l + (-$j % $_l)) % $_l;
                $tmp = $indices[$i];
                $indices[$i] = $indices[$index];
                $indices[$index] = $tmp;
                $yield_arr = [];
                foreach (array_slice($indices, 0, $n) as $y) {
                    array_push($yield_arr, $arr[$y]);
                }
                yield $yield_arr;
                $return = false;
                break;
            }
        }
        if ($return) {
            return;
        }
    }
}

$arr = [1,2,3,4,5,6,7,8];
foreach (permute($arr) as $value) {
    echo implode(',', $value) . "\n";
}