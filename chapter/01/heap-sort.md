# 堆排序
#### 一部分定理
1、n个元素的堆，叶节点下标为[⌊n/2⌋+1,n]  
2、n个元素的堆，至多有⌈n/2^(h+1)⌉个高度为h的结点     
3、最坏情况下，堆排序的时间复杂度为Ω(nlgn)   
4、所有元素都不同的情况下，堆排序的时间复杂度为Ω(nlgn)
###### 用到的一些函数
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
## 维护最大堆性质
###### 保证所有子节点 ≤ 父节点，提供两种方法
#### 1、递归方法
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

$arr = [16,4,10,14,7,9,3,2,8,1];
print_r(max_heapify_recursive($arr, 1));
```
#### 2、循环方法
```php
/**
 * 维持最大堆的性质（循环）
 * @param array $arr 堆
 * @param int $i 节点下标
 * @return mixed
 */
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

$arr = [16,4,10,14,7,9,3,2,8,1];
print_r(max_heapify_circle($arr, 1));
```
***
#### 建堆
###### 自底向上的方式将数组转成最大堆，用到了上面维持最大堆的方法
```php
/**
 * 建堆，自底向上的方式将数组转成最大堆
 * @param $arr
 * @return mixed
 */
function build_max_heap($arr){
    $count = count($arr);
    for($i = intval(($count - 1) / 2);$i >= 0;--$i){
        $arr = max_heapify_recursive($arr, $i);
    }
    return $arr;
}

$arr = [4,1,3,2,16,9,10,14,8,7];
print_r(build_max_heap($arr));
```
***
#### 堆排序
###### 用到了上面维持最大堆性质的方法
```php
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

$arr = [4,1,3,2,16,9,10,14,8,7];
print_r(heap_sort($arr));
```

