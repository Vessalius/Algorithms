<?php
/**
 插入排序
 * @param array $arr 需要排序的数组
 * @param integer $sort 排序方式 1:升序 0:降序 默认升序
 * @return mixed
 */
function insertion_sort($arr, $sort = 1){
    for($i = 1;$i < count($arr);++$i){
        $num = $arr[$i];
        /*把当前元素插入到已排序数组中*/
        $j = $i - 1;
        if($sort){
            //如果前一个元素大于当前元素就把$j+1对应的元素变成$j对应的元素
            while($j >= 0 && $arr[$j] > $num){
                $arr[$j + 1] = $arr[$j];
                --$j;
            }
        }else{
            //如果前一个元素小于当前元素就把$j+1对应的元素变成$j对应的元素
            while($j >= 0 && $arr[$j] < $num){
                $arr[$j + 1] = $arr[$j];
                --$j;
            }
        }
        //找到插入位置赋值
        $arr[$j + 1] = $num;
    }
    return $arr;
}

$arr = [5,2,4,6,1,3];
print_r(insertion_sort($arr));

/**
 * 2个n位二进制整数相加，分别存在2个n元数组A跟B中(低位在前)，相加结果为一个(n+1)元数组C
 * @param array $arrA
 * @param array $arrB
 */
function my_add_binary($arrA, $arrB){
    //$flag 为进位标识
    $flag = 0;
    $arrC = [];
    for($i = 0;$i < count($arrA);++$i){
        $sum = $arrA[$i] + $arrB[$i];
        if($sum > 1){ //需要进位
            $arrC[$i] = $flag?1:0; //因为需要进位所以本位为0，但是如果上次运算后有进位 本次运算需要取反为1
            $flag = 1; //进位
        }else{ //不需要进位
            $arrC[$i] = $flag?!$sum:$sum;
            $flag = 0;
        }
    }
    $arrC[count($arrC)] = $flag;
    return $arrC;
}

function add_binary($arrA, $arrB){
    $flag = 0;
    $arrC = [];
    for($i = 0;$i < count($arrA);++$i){
        $arrC[$i] = ($arrA[$i] + $arrB[$i] + $flag) % 2;
        $flag = intval(($arrA[$i] + $arrB[$i] + $flag) / 2);
    }
    $arrC[count($arrC)] = $flag;
    return $arrC;
}

$arrA = [0,1,0,1];
$arrB = [1,1,0,0];
print_r(add_binary($arrA, $arrB));
print_r(my_add_binary($arrA, $arrB));


/**
 * 选择排序
 * @param array $arr
 * @param array $result
 * @return array
 */
function selection_sort($arr,$result = []){
    //默认下标0为$arr中的最小元素的下标
    $min = 0;
    $temp = [];
    //每次对比之后更新最小下标
    for($i = 1;$i < count($arr);++$i){
        if($arr[$i] < $arr[$min]){
            $min = $i;
        }
    }
    //最小值加到$result数组的最后
    $result[] = $arr[$min];
    //去掉最小值后的新数组
    for($i = 0;$i < count($arr);++$i){
        if($i != $min){
            $temp[] = $arr[$i];
        }
    }
    if(!empty($temp)){
        $result = selection_sort($temp,$result);
    }
    return $result;
}

$arr = [1,2,6,7,1,2,3,2,1];
print_r(selection_sort($arr));

/**
 * 分治法
 * @param array $arr 原始数组
 * @param int $p，$q，$r 满足$p <= $q < $r
 */
function merge(&$arr, $p, $q, $r){
    //定义两个子数组（都已知为升序排列）
    $n1 = $q - $p + 1;
    $n2 = $r - $q;
    $L = [];
    $R = [];
    for($i = 0;$i < $n1;++$i){
        $L[$i] = $arr[$p + $i];
    }
    for($j = 0;$j < $n2;++$j){
        $R[$j] = $arr[$q + $j + 1];
    }
    //比较两个子数组中第一个元素的较小值放入原数组对应位置中
    $i = 0;
    $j = 0;
    for($k = $p;$k <= $r;++$k){
        //考虑有一个子数组取完时的情况
        if($j == $n2 ||($L[$i] <= $R[$j] && $i < $n1)){
            $arr[$k] = $L[$i];
            ++$i;
        }else{
            $arr[$k] = $R[$j];
            ++$j;
        }
    }
    return $arr;
}

//$arr = [1,3,4,3,1,3,8,9,2,4,5,7,1,2,3,6,4,3,7,8,4,2];
//merge($arr, 0, 10, 21);
//print_r($arr);


/**
 * 利用分治法进行归并排序
 * @param array $arr
 * @param int $p,$r
 */
function merge_sort(&$arr, $p, $r){
    if($p < $r){
        //取中间数
        $q = intval(($p + $r) / 2);
        merge_sort($arr, $p, $q);
        merge_sort($arr, $q + 1, $r);
        merge($arr, $p, $q, $r);
    }
}

$arr = [1,3,4,3,1,3,8,9,2,4,5,7,1,2,3,6,4,3,7,8,4,2];
merge_sort($arr, 0, 21);
print_r($arr);
