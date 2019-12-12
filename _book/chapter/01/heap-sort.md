# 堆排序
######
用到的一些函数
```php
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
```

#### 维护最大堆性质(递归)
###### 所有子节点 ≤ 父节点
```php
/**
 * 维持最大堆的性质（递归）
 * @param array $arr 堆
 * @param int $i 节点下标
 * @return mixed
 */
function max_heapify_recursive($arr, $i){
    $l = left($i); //获取左孩子下标
    $r = right($i); //获取右孩子下标
    $count = count($arr); //获取数组总元素数量
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
        $arr = max_heapify_recursive($arr, $largest);
    }
    return $arr;
}
```
#### 维护最大堆性质(循环)
###### 所有子节点 ≤ 父节点
```php
/**
 * 维持最大堆的性质（循环）
 * @param array $arr 堆
 * @param int $i 节点下标
 * @return mixed
 */
$arr = [16,4,10,14,7,9,3,2,8,1];
print_r(max_heapify_recursive($arr, 1));

function max_heapify_circle($arr, $i){
    $count = count($arr); //获取数组总元素数量
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

print_r(max_heapify_circle($arr, 1));
```
