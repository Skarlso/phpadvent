<?php

function permute($arr) {
    $n = count($arr);
    $indices = range(0, $n-1);
    $cycles = range($n, 1, -1);
    $yield_arr = [];
    foreach (array_slice($indices, 0, $n) as $i) {
        array_push($yield_arr, $arr[$i]);
    }
    yield $yield_arr;

    while ($n) {
        $return = TRUE;
        foreach (array_reverse(range(0, $n-1)) as $i) {
            $cycles[$i] -= 1;
            if ($cycles[$i] == 0) {
                // print("before\n");
                // print_r($indices);
                $head = array_slice($indices, 0, $i-1);
                $front = array_slice($indices, $i+1);
                $back = array_slice($indices, $i, $i + 1);
                $tail = array_merge($front, $back);
                // $indices[$i:] = $indices[$i+1:] + $indices[$i:$i+1];
                $indices = array_merge($head, $tail);
                // print_r($indices);
                // print("after\n");
                $cycles[$i] = $n - $i;
                // print_r($indices);
            } else {
                $j = $cycles[$i];
                // printf("-j: %d\n", $j);
                $index = truemod(-$j, count($indices));
                // printf("%d\n", $index);
                // print_r($indices);
                $tmp = $indices[$i];
                $indices[$i] = $indices[$index];
                $indices[$index] = $tmp;
                $yield_arr = [];
                foreach (array_slice($indices, 0, $n) as $i) {
                    array_push($yield_arr, $arr[$i]);
                }
                yield $yield_arr;
                $return = FALSE;
                break;
            }
        }
        if ($return == TRUE) {
            return;
        }
    }
}

function truemod($num, $mod) {
    return ($mod + ($num % $mod)) % $mod;
}

$arr = [1,2,3];
foreach (permute($arr) as $value) {
    print_r($value);
}
