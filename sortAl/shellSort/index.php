<?php

function shellSort(&$arr) {
    $len = count($arr);
    for ($gap = (int)($len / 2); $gap > 0; $gap = (int)($gap /2)) {
        for ($i = 0; $i < $gap; $i++) {
            for ($j = $i + $gap; $j < $len; $j += $gap) {
                if ($arr[$j] < $arr[$j - $gap]) {
                    $tmp = $arr[$j];
                    for ($k = $j - $gap; $k >= 0 && $arr[$k] > $tmp; $k-= $gap) {
                        $arr[$k + $gap] = $arr[$k];
                    }
                    $arr[$k + $gap] = $tmp;
                }
            }
        }
    }
}

$arr = [9, 8, 7, 6, 5, 4, 3, 2, 1];
$arr2 = [27, 28, 67, 16, 25, 14, 83, 103, 2, 10, 30];

print_r($arr);
shellSort($arr);
print_r($arr);

print_r($arr2);
shellSort($arr2);
print_r($arr2);

