<?php

function core($l, $r, &$arr) {
    $i = $l;
    $j = $r;
    $base = $arr[$i];
    
    while($i < $j) {
        while($base < $arr[$j] && $i < $j) $j--;
        if ($i < $j) {
            $arr[$i] = $arr[$j];
            $i++;
        }
        
        while ($base >= $arr[$i] && $i < $j) $i++;
        if ($i < $j) {
            $arr[$j] = $arr[$i];
            $j--;
        }
    }
    $arr[$i] = $base;
    return $i;
}

function quickSort($l, $r, &$arr) {
    if ($l < $r) {
        $m = core($l, $r, $arr);
        quickSort($l, $m, $arr);
        quickSort($m+1, $r, $arr);
    }
}

$arr = [9, 8, 7, 6, 5, 4, 3, 2, 1];
$arr2 = [27, 28, 67, 16, 25, 14, 83, 103, 2, 10, 30];

print_r($arr);
quickSort(0, count($arr) - 1, $arr);
print_r($arr);
print_r($arr2);
quickSort(0, count($arr2) - 1, $arr2);
print_r($arr2);


