<?php
/**
 * 根据当前节点获取父节点的下标
 * @param $i
 * @return int
 */
function parent($i){
    return ceil($i / 2) - 1;
}

/**
 * 根据当前节点获取左孩子的下标
 * @param $i
 * @return int
 */
function left($i){
    return 2 * $i + 1;
}

/**
 * 根据当前节点获取右孩子的下标
 * @param $i
 * @return int
 */
function right($i){
    return 2 * $i + 2;
}

/**
 * 维持最大堆的性质（递归）
 * @param array $arr 堆
 * @param int $i 节点下标
 * @param int $count 数组长度
 * @return mixed
 */
function max_heapify_recursive($arr, $i, $count){
    $l = left($i); //获取左孩子下标
    $r = right($i); //获取右孩子下标
    $largest = $i;
    if($l < $count && $arr[$largest] < $arr[$l]){ //左孩子比当前节点大，记录下标
        $largest = $l;
    }

    if($r < $count && $arr[$largest] < $arr[$r]){ //右孩子比当前节点大，记录下标
        $largest = $r;
    }

    if($i != $largest){ //交换元素后递归
        $temp = $arr[$largest];
        $arr[$largest] = $arr[$i];
        $arr[$i] = $temp;
        $arr = max_heapify_recursive($arr, $largest, $count);
    }
    return $arr;
}

//$arr = [16,4,10,14,7,9,3,2,8,1];
//print_r(max_heapify_recursive($arr, 1, 10));

/**
 * 维持最大堆的性质（循环）
 * @param array $arr 堆
 * @param int $i 节点下标
 * @param int $count 数组长度
 * @return mixed
 */
function max_heapify_circle($arr, $i, $count){
    $l = left($i); //获取左孩子下标
    $r = right($i); //获取右孩子下标
    $largest = $i;
    do{
        if ($l < $count && $arr[$largest] < $arr[$l]) { //左孩子比当前节点大，记录下标
            $largest = $l;
        }
        if ($r < $count && $arr[$largest] < $arr[$r]) { //右孩子比当前节点大，记录下标
            $largest = $r;
        }
        if ($i != $largest) { //交换元素后递归
            $temp = $arr[$largest];
            $arr[$largest] = $arr[$i];
            $arr[$i] = $temp;
            $l = left($largest); //获取新的左孩子下标
            $r = right($largest); //获取新的右孩子下标
        }
    }while($i != $largest);
    return $arr;
}

//$arr = [16,4,10,14,7,9,3,2,8,1];
//print_r(max_heapify_circle($arr, 1, $count));

/**
 * 建堆，自底向上的方式将数组转成最大堆
 * @param $arr
 * @return mixed
 */
function build_max_heap($arr){
    $count = count($arr);
    for($i = intval(($count - 1) / 2);$i >= 0;--$i){
        $arr = max_heapify_recursive($arr, $i, $count);
    }
    return $arr;
}

//$arr = [4,1,3,2,16,9,10,14,8,7];
//print_r(build_max_heap($arr));

/**
 * 堆排序
 * @param $arr
 * @return mixed
 */
function heap_sort($arr){
    //先建堆将数组转成最大堆
    $arr = build_max_heap($arr);
    $count = count($arr);
    //交换第一个和最后一个元素后，通过减少下标的方式缩短数组，直到全部交换完成
    for($i = $count;$i > 0; --$i){
        $temp = $arr[$i - 1];
        $arr[$i- 1] = $arr[0];
        $arr[0] = $temp;
        //维持第1到$count-1的数组最大堆性质
        $arr = max_heapify_recursive($arr, 0, $i - 1);
    }
    return $arr;
}

//$arr = [4,1,3,2,16,9,10,14,8,7];
//print_r(heap_sort($arr));


/**
 * 返回最大堆中最大键值的元素
 * @param array $arr 最大堆
 * @return mixed
 */
function heap_maximum(&$arr){
    return $arr[0];
}

/**
 * 去掉并返回最大堆中具有最大键值的元素
 * @param array $arr 最大堆
 * @return mixed
 */
function heap_extract_max(&$arr){
    $max = $arr[0];
    $arr[0] = $arr[count($arr) - 1];
    unset($arr[count($arr) - 1]);
    $arr = max_heapify_recursive($arr, 0, count($arr));
    return $max;
}
//$arr = [16,14,10,8,7,9,3,2,4,1];
//print_r(heap_extract_max($arr));
//print_r($arr);

/**
 * 将元素$i的值增加到$key, 且$arr[$i] <= $key
 * @param array $arr 最大堆
 * @param int $i 数组下标
 * @param int $key 替换的值
 * @return mixed
 */
function heap_increase_key($arr, $i, $key){
    $arr[$i] = $key;
    while($i > 0 && $arr[parent($i)] < $arr[$i]){
        $temp = $arr[parent($i)];
        $arr[parent($i)] = $arr[$i];
        $arr[$i] = $temp;
        $i = parent($i);
    }
    return $arr;
}
//$arr = [16,14,10,8,7,9,3,2,4,1];
//print_r(heap_increase_key($arr, 3, 20));

/**
 * 插入$key到$arr中，并保持最大堆性质
 * @param array $arr 最大堆
 * @param int $key 插入的值
 * @return mixed
 */
function max_heap_insert($arr, $key){
    return heap_increase_key($arr, count($arr), $key);
}
//$arr = [16,14,10,8,7,9,3,2,4,1];
//print_r(max_heap_insert($arr, 20));
