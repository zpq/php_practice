<?php

function mergeSort($l, $r, &$arr) {
    if ($l < $r) {
        $m = (int) (($l + $r) / 2);
//        echo "$l $m $r\n";
        mergeSort($l, $m, $arr);
        mergeSort($m + 1, $r, $arr);
        core($l, $m, $r, $arr);
    }
}

function core($l, $m, $r, &$arr) {
    $tmp = [];
    $a = array_slice($arr, $l, $m - $l + 1);
    $b = array_slice($arr, $m + 1, $r - $m + 1);
    $al = count($a);
    $bl = count($b);
    $i = 0;
    $j = 0;
    while ($i < $al || $j < $bl) {
        if ($i == $al) {
            while ($j < $bl)
                $tmp[] = $b[$j++];
            break;
        }
        if ($j == $bl) {
            while ($i < $al)
                $tmp[] = $a[$i++];
            break;
        }
        if ($a[$i] <= $b[$j]) {
            $tmp[] = $a[$i++];
        } else {
            $tmp[] = $b[$j++];
        }
    }
    for ($i = 0; $i < count($tmp); $i++) {
        $arr[$l + $i] = $tmp[$i];
    }
}

$arr = [9, 8, 7, 6, 5, 4, 3, 2, 1, 0];
$arr2 = [27, 28, 67, 16, 25, 14, 83, 103, 2, 10, 30];

print_r($arr);
mergeSort(0, count($arr)-1, $arr);
print_r($arr);

print_r($arr2);
mergeSort(0, count($arr2) - 1, $arr2);
print_r($arr2);