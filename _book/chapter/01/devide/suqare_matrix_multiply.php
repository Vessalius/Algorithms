<?php
/**
 * 2个n阶矩阵乘法(一般解法)
 * @param array $arrA n阶矩阵A
 * @param array $arrB n阶矩阵B
 * @return array
 */
function square_matrix_multiply($arrA, $arrB){
    $n = count($arrA);
    $arrC = [];
    for($i = 0;$i < $n;++$i){
        for($j = 0;$j < $n;++$j){
            $arrC[$i][$j] = 0;
            for($k = 0;$k < $n;++$k){
                $arrC[$i][$j] += $arrA[$i][$k] * $arrB[$k][$j];
            }
        }
    }
    return $arrC;
}

$arrA = [
    [1,3,4],
    [5,6,5],
    [5,6,5]
];
$arrB = [
    [2,1,2],
    [3,2,4],
    [3,2,4]
];
print_r(square_matrix_multiply($arrA, $arrB));

/**
 * 2个n阶矩阵乘法(递归解法)
 * @param array $arrA n阶矩阵A
 * @param array $arrB n阶矩阵B
 * @return array
 */
function square_matrix_multiply_recursive($arrA, $arrB){
    $n = count($arrA);
    $arrC = [];
    if($n == 1){
        $arrC = [[$arrA[0][0] * $arrB[0][0]]];
    }else{
        //将矩阵arrA分成四块
        $arrA1 = quarter_matrix($arrA,1);
        $arrA2 = quarter_matrix($arrA,2);
        $arrA3 = quarter_matrix($arrA,3);
        $arrA4 = quarter_matrix($arrA,4);
        //将矩阵arrB分成四块
        $arrB1 = quarter_matrix($arrB,1);
        $arrB2 = quarter_matrix($arrB,2);
        $arrB3 = quarter_matrix($arrB,3);
        $arrB4 = quarter_matrix($arrB,4);

        $arrC1 = matrix_add(square_matrix_multiply_recursive($arrA1,$arrB1),square_matrix_multiply_recursive($arrA2,$arrB3));
        $arrC2 = matrix_add(square_matrix_multiply_recursive($arrA1,$arrB2),square_matrix_multiply_recursive($arrA2,$arrB4));
        $arrC3 = matrix_add(square_matrix_multiply_recursive($arrA3,$arrB1),square_matrix_multiply_recursive($arrA4,$arrB3));
        $arrC4 = matrix_add(square_matrix_multiply_recursive($arrA3,$arrB2),square_matrix_multiply_recursive($arrA4,$arrB4));

        $arrC = together_matrix($arrC1, $arrC2, $arrC3, $arrC4, $n);//把分成的四个小矩阵合并成一个大矩阵
    }
    return $arrC;
}

//返回1/4个矩阵，根据type区分哪一块
function quarter_matrix($arr, $type){
    $n = count($arr);
    //判断奇偶，补0
    if($n % 2 != 0){
        ++$n;
    }
    $nArr = [];
    switch($type) {
        case 1: //左上角
            $row = 0;
            $col = 0;
            $rows = $n / 2;
            $cols = $n / 2;
            break;
        case 2: //右上角
            $row = 0;
            $col = $n / 2;
            $rows = $n / 2;
            $cols = $n;
            break;
        case 3: //左下角
            $row = $n / 2;
            $col = 0;
            $rows = $n;
            $cols = $n / 2;
            break;
        case 4: //右下角
            $row = $n / 2;
            $col = $n / 2;
            $rows = $n;
            $cols = $n;
            break;
    }
    for($i = $row;$i < $rows;++$i){
        for($j = $col;$j < $cols;++$j){
            $nArr[$i-$row][] = $arr[$i][$j];
        }
    }
    return $nArr;
}

//两个矩阵相加
function matrix_add($arrA, $arrB){
    $count = count($arrA);
    $arrC = [];
    for($i = 0;$i < $count;++$i){
        for($j = 0;$j < $count;++$j){
            $arrC[$i][$j] = $arrA[$i][$j] + $arrB[$i][$j];
        }
    }
    return $arrC;
}

//两个矩阵相减
function matrix_reduce($arrA, $arrB){
    $count = count($arrA);
    $arrC = [];
    for($i = 0;$i < $count;++$i){
        for($j = 0;$j < $count;++$j){
            $arrC[$i][$j] = $arrA[$i][$j] - $arrB[$i][$j];
        }
    }
    return $arrC;
}

//合并四块矩阵
function together_matrix($arr1, $arr2, $arr3, $arr4, $count){
//    $count = count($arr1);
    $n = ceil($count / 2);
    $arr = [];
    for($i = 0;$i < $count;++$i){
        for($j = 0;$j < $count;++$j){
            if($i < $n){
                if($j < $n){
                    $arr[$i][$j] = $arr1[$i][$j];
                }else{
                    $arr[$i][$j] = $arr2[$i][$j - $n];
                }
            }else{
                if($j < $n){
                    $arr[$i][$j] = $arr3[$i - $n][$j];
                }else{
                    $arr[$i][$j] = $arr4[$i - $n][$j - $n];
                }
            }
        }
    }
    return $arr;
}

print_r(square_matrix_multiply_recursive($arrA, $arrB));


/**
 * 2个n阶矩阵乘法(Strassen解法)
 * @param array $arrA n阶矩阵A
 * @param array $arrB n阶矩阵B
 * @return array
 */
function square_matrix_multiply_strassen($arrA, $arrB){
    $n = count($arrA);
    $arrC = [];
    if($n == 1){
        $arrC = [[$arrA[0][0] * $arrB[0][0]]];
    }else{
        //将矩阵arrA分成四块
        $arrA1 = quarter_matrix($arrA,1);
        $arrA2 = quarter_matrix($arrA,2);
        $arrA3 = quarter_matrix($arrA,3);
        $arrA4 = quarter_matrix($arrA,4);
        //将矩阵arrB分成四块
        $arrB1 = quarter_matrix($arrB,1);
        $arrB2 = quarter_matrix($arrB,2);
        $arrB3 = quarter_matrix($arrB,3);
        $arrB4 = quarter_matrix($arrB,4);

        //strassen算法7步
//        $S1 = matrix_reduce($arrB2, $arrB4);
//        $S2 = matrix_add($arrA1, $arrA2);
//        $S3 = matrix_add($arrA3, $arrA4);
//        $S4 = matrix_reduce($arrB3, $arrB1);
//        $S5 = matrix_add($arrA1, $arrA4);
//        $S6 = matrix_add($arrB1, $arrB4);
//        $S7 = matrix_reduce($arrA2, $arrA4);
//        $S8 = matrix_add($arrB3, $arrB4);
//        $S9 = matrix_reduce($arrA1, $arrA3);
//        $S10 = matrix_add($arrB1, $arrB2);

        $P1 = square_matrix_multiply_strassen($arrA1, matrix_reduce($arrB2, $arrB4));
        $P2 = square_matrix_multiply_strassen(matrix_add($arrA1, $arrA2), $arrB4);
        $P3 = square_matrix_multiply_strassen(matrix_add($arrA3, $arrA4), $arrB1);
        $P4 = square_matrix_multiply_strassen($arrA4, matrix_reduce($arrB3, $arrB1));
        $P5 = square_matrix_multiply_strassen(matrix_add($arrA1, $arrA4), matrix_add($arrB1, $arrB4));
        $P6 = square_matrix_multiply_strassen(matrix_reduce($arrA2, $arrA4), matrix_add($arrB3, $arrB4));
        $P7 = square_matrix_multiply_strassen(matrix_reduce($arrA1, $arrA3), matrix_add($arrB1, $arrB2));

        $arrC1 = matrix_add(matrix_add($P4, $P5), matrix_reduce($P6, $P2));
        $arrC2 = matrix_add($P1, $P2);
        $arrC3 = matrix_add($P3, $P4);
        $arrC4 = matrix_reduce(matrix_add($P1, $P5), matrix_add($P3, $P7));


        $arrC = together_matrix($arrC1, $arrC2, $arrC3, $arrC4, $n);//把分成的四个小矩阵合并成一个大矩阵
    }
    return $arrC;
}

print_r(square_matrix_multiply_strassen($arrA, $arrB));