<?php

function bubbleSort($arr) {
    $len = count($arr);
    for ($i = 0; $i < $len; $i++) {
        for ($j = $i + 1; $j < $len; $j++) {
            if ($arr[$i] > $arr[$j]) {
                $arr[$i] = $arr[$i] + $arr[$j];
                $arr[$j] = $arr[$i] - $arr[$j];
                $arr[$i] = $arr[$i] - $arr[$j];
            }
        }
    }
    return $arr;
}

$arr = [9, 8, 7, 6, 5, 4, 3, 2, 1];
$arr2 = [27, 28, 67, 16, 25, 14, 83, 103, 2, 10, 30];

print_r($arr);
print_r(bubbleSort($arr));
print_r($arr2);
print_r(bubbleSort($arr2));

