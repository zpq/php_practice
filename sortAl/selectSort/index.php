<?php

function selectSort(&$arr) {
    $len = count($arr);
    for ($i = 0; $i < $len; $i++) {
        $minIndex = $i;
        for ($j = $i + 1; $j < $len; $j++) {
            if ($arr[$minIndex] > $arr[$j])
                $minIndex = $j;
        }
        if ($arr[$i] !== $arr[$minIndex]) {
            $arr[$i] = $arr[$i] + $arr[$minIndex];
            $arr[$minIndex] = $arr[$i] - $arr[$minIndex];
            $arr[$i] = $arr[$i] - $arr[$minIndex];
        }
    }
}

$arr = [9, 8, 7, 6, 5, 4, 3, 2, 1];
$arr2 = [27, 28, 67, 16, 25, 14, 83, 103, 2, 10, 30];

print_r($arr);
selectSort($arr);
print_r($arr);

print_r($arr2);
selectSort($arr2);
print_r($arr2);

