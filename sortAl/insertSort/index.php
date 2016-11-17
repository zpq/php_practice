<?php

function insertSort(&$arr) {
    $len = count($arr);
    for ($i = 1; $i < $len; $i++) {
        if ($arr[$i] < $arr[$i - 1]) {
            $tmp = $arr[$i];
            for ($j = $i - 1; $j >= 0 && $arr[$j] > $tmp; $j--) {
                $arr[$j+1] = $arr[$j];
            }
            $arr[$j+1] = $tmp;
        }
    }
}

$arr = [9, 8, 7, 6, 5, 4, 3, 2, 1];
$arr2 = [27, 28, 67, 16, 25, 14, 83, 103, 2, 10, 30];

print_r($arr);
insertSort($arr);
print_r($arr);

print_r($arr2);
insertSort($arr2);
print_r($arr2);